<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
header('Content-Type: application/json');

require_once 'php/db.php';
require_once 'php/auth.php';

function fail_json(string $message, int $code = 400): void {
    http_response_code($code);
    echo json_encode(['success' => false, 'error' => $message]);
    exit();
}

function article_owner_id(PDO $db, string $articleId): ?int {
    if (preg_match('/^submission-(\d+)$/', $articleId, $m)) {
        $stmt = $db->prepare('SELECT author_id FROM article_submissions WHERE id = ? LIMIT 1');
        $stmt->execute([(int)$m[1]]);
        $ownerId = $stmt->fetchColumn();
        return $ownerId ? (int)$ownerId : null;
    }
    return null;
}

function remove_notification(PDO $db, int $recipientId, int $actorId, string $type, ?string $articleId = null, ?int $commentId = null): void {
    $stmt = $db->prepare('DELETE FROM notifications
        WHERE recipient_user_id = ?
          AND actor_user_id = ?
          AND type = ?
          AND ((article_id IS NULL AND ? IS NULL) OR article_id = ?)
          AND ((comment_id IS NULL AND ? IS NULL) OR comment_id = ?)');
    $stmt->execute([$recipientId, $actorId, $type, $articleId, $articleId, $commentId, $commentId]);
}

function create_notification(PDO $db, int $recipientId, int $actorId, string $type, ?string $articleId = null, ?int $commentId = null, ?int $parentCommentId = null, ?string $reaction = null): void {
    if ($recipientId === $actorId) {
        return;
    }
    $stmt = $db->prepare('INSERT INTO notifications
        (recipient_user_id, actor_user_id, type, article_id, comment_id, parent_comment_id, reaction)
        VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$recipientId, $actorId, $type, $articleId, $commentId, $parentCommentId, $reaction]);
}

try {
    $db = getDB();

    $rawInput = file_get_contents('php://input');
    $data = json_decode($rawInput, true) ?? [];

    $action = $_GET['action'] ?? ($data['action'] ?? '');
    $article_id = $_GET['article_id'] ?? ($data['article_id'] ?? '');

    if (!$article_id) {
        fail_json('Article ID is required.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'get_data') {
        $stmt = $db->prepare('SELECT reaction, COUNT(*) AS count FROM reactions WHERE article_id = ? GROUP BY reaction');
        $stmt->execute([$article_id]);
        $reaction_counts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        $my_reaction = null;
        $my_likes = [];
        if (isLoggedIn()) {
            $stmt = $db->prepare('SELECT reaction FROM reactions WHERE article_id = ? AND user_id = ? LIMIT 1');
            $stmt->execute([$article_id, $_SESSION['user_id']]);
            $my_reaction = $stmt->fetchColumn() ?: null;

            $stmt = $db->prepare('SELECT cl.comment_id
                FROM comment_likes cl
                JOIN comments c ON c.id = cl.comment_id
                WHERE cl.user_id = ? AND c.article_id = ?');
            $stmt->execute([$_SESSION['user_id'], $article_id]);
            $my_likes = array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
        }

        $stmt = $db->prepare('SELECT c.id, c.parent_id, c.user_id, c.body AS text, c.likes, c.created_at, u.name, u.avatar_color
            FROM comments c
            JOIN users u ON u.id = c.user_id
            WHERE c.article_id = ?
            ORDER BY c.created_at ASC, c.id ASC');
        $stmt->execute([$article_id]);
        $comments = $stmt->fetchAll();

        echo json_encode([
            'success' => true,
            'reactions' => $reaction_counts,
            'myReaction' => $my_reaction,
            'comments' => $comments,
            'myLikes' => $my_likes,
            'isLoggedIn' => isLoggedIn(),
        ]);
        exit();
    }

    if (!isLoggedIn()) {
        echo json_encode(['success' => false, 'error' => 'You must be logged in.', 'notLoggedIn' => true]);
        exit();
    }

    $user_id = (int)$_SESSION['user_id'];

    $stmt = $db->prepare('SELECT id, role FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([$user_id]);
    $sessionUser = $stmt->fetch();
    if (!$sessionUser) {
        session_destroy();
        fail_json("Your session expired. Please log in again.", 401);
    }
    $sessionRole = $sessionUser['role'];

    if ($action === 'toggle_reaction') {
        $reaction = trim((string)($data['reaction'] ?? ''));
        $valid = ['happy', 'sad', 'surprised', 'angry'];
        if (!in_array($reaction, $valid, true)) {
            fail_json('Invalid reaction.');
        }

        $stmt = $db->prepare('SELECT id, reaction FROM reactions WHERE article_id = ? AND user_id = ? LIMIT 1');
        $stmt->execute([$article_id, $user_id]);
        $existing = $stmt->fetch();

        $ownerId = article_owner_id($db, $article_id);
        if ($ownerId) {
            remove_notification($db, $ownerId, $user_id, 'article_reaction', $article_id, null);
        }

        if ($existing && $existing['reaction'] === $reaction) {
            $db->prepare('DELETE FROM reactions WHERE id = ?')->execute([(int)$existing['id']]);
            echo json_encode(['success' => true, 'active' => false]);
            exit();
        }

        if ($existing) {
            $db->prepare('UPDATE reactions SET reaction = ?, created_at = NOW() WHERE id = ?')->execute([$reaction, (int)$existing['id']]);
        } else {
            $db->prepare('INSERT INTO reactions (user_id, article_id, reaction) VALUES (?, ?, ?)')->execute([$user_id, $article_id, $reaction]);
        }

        if ($ownerId && $ownerId !== $user_id) {
            create_notification($db, $ownerId, $user_id, 'article_reaction', $article_id, null, null, $reaction);
        }

        echo json_encode(['success' => true, 'active' => true]);
        exit();
    }

    if ($action === 'add_comment') {
        $body = trim((string)($data['body'] ?? ''));
        $parent_id = (int)($data['parent_id'] ?? 0);
        $parent_id = $parent_id > 0 ? $parent_id : null;

        if ($body === '') {
            fail_json('Comment cannot be empty.');
        }
        if (mb_strlen($body) > 500) {
            fail_json('Comment is too long. Max 500 characters.');
        }

        $parent = null;
        if ($parent_id !== null) {
            $stmt = $db->prepare('SELECT id, user_id, parent_id FROM comments WHERE id = ? AND article_id = ? LIMIT 1');
            $stmt->execute([$parent_id, $article_id]);
            $parent = $stmt->fetch();
            if (!$parent) {
                fail_json('The comment you are replying to no longer exists.');
            }
            if (!empty($parent['parent_id'])) {
                fail_json('Replies can only be posted under a main comment.');
            }
        }

        $stmt = $db->prepare('INSERT INTO comments (user_id, article_id, parent_id, body) VALUES (?, ?, ?, ?)');
        $stmt->execute([$user_id, $article_id, $parent_id, htmlspecialchars($body, ENT_QUOTES, 'UTF-8')]);
        $newCommentId = (int)$db->lastInsertId();

        if ($parent && (int)$parent['user_id'] !== $user_id) {
            create_notification($db, (int)$parent['user_id'], $user_id, 'comment_reply', $article_id, $newCommentId, (int)$parent['id'], null);
        }

        if ($parent_id === null) {
            $articleOwnerId = article_owner_id($db, $article_id);
            if ($articleOwnerId && $articleOwnerId !== $user_id) {
                remove_notification($db, $articleOwnerId, $user_id, 'article_comment', $article_id, $newCommentId);
                create_notification($db, $articleOwnerId, $user_id, 'article_comment', $article_id, $newCommentId, null, null);
            }
        }

        echo json_encode(['success' => true, 'comment_id' => $newCommentId]);
        exit();
    }

    if ($action === 'toggle_like') {
        $comment_id = (int)($data['comment_id'] ?? 0);
        if ($comment_id <= 0) {
            fail_json('Comment ID is required.');
        }

        $stmt = $db->prepare('SELECT id, user_id FROM comments WHERE id = ? AND article_id = ? LIMIT 1');
        $stmt->execute([$comment_id, $article_id]);
        $comment = $stmt->fetch();
        if (!$comment) {
            fail_json('Comment not found.');
        }
        $ownerId = (int)$comment['user_id'];

        $stmt = $db->prepare('SELECT 1 FROM comment_likes WHERE user_id = ? AND comment_id = ?');
        $stmt->execute([$user_id, $comment_id]);
        $hasLike = (bool)$stmt->fetchColumn();

        if ($hasLike) {
            $db->prepare('DELETE FROM comment_likes WHERE user_id = ? AND comment_id = ?')->execute([$user_id, $comment_id]);
            $db->prepare('UPDATE comments SET likes = GREATEST(likes - 1, 0) WHERE id = ?')->execute([$comment_id]);
            if ($ownerId !== $user_id) {
                remove_notification($db, $ownerId, $user_id, 'comment_like', $article_id, $comment_id);
            }
            echo json_encode(['success' => true, 'liked' => false]);
            exit();
        }

        $db->prepare('INSERT INTO comment_likes (user_id, comment_id) VALUES (?, ?)')->execute([$user_id, $comment_id]);
        $db->prepare('UPDATE comments SET likes = likes + 1 WHERE id = ?')->execute([$comment_id]);
        if ($ownerId !== $user_id) {
            remove_notification($db, $ownerId, $user_id, 'comment_like', $article_id, $comment_id);
            create_notification($db, $ownerId, $user_id, 'comment_like', $article_id, $comment_id, null, null);
        }

        echo json_encode(['success' => true, 'liked' => true]);
        exit();
    }

    if ($action === 'delete_comment') {
        $comment_id = (int)($data['comment_id'] ?? 0);
        if ($comment_id <= 0) {
            fail_json('Comment ID is required.');
        }

        $stmt = $db->prepare('SELECT id, user_id, parent_id FROM comments WHERE id = ? AND article_id = ? LIMIT 1');
        $stmt->execute([$comment_id, $article_id]);
        $comment = $stmt->fetch();
        if (!$comment) {
            fail_json('Comment not found.');
        }

        $isOwner = ((int)$comment['user_id'] === $user_id);
        $isAdmin = ($sessionRole === 'admin');
        if (!$isOwner && !$isAdmin) {
            fail_json('You can only delete your own comments.');
        }

        $childStmt = $db->prepare('SELECT id FROM comments WHERE id = ? OR parent_id = ?');
        $childStmt->execute([$comment_id, $comment_id]);
        $ids = array_map('intval', $childStmt->fetchAll(PDO::FETCH_COLUMN));

        if ($ids) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $db->prepare("DELETE FROM notifications WHERE comment_id IN ($placeholders) OR parent_comment_id IN ($placeholders)")
               ->execute(array_merge($ids, $ids));
        }

        $db->prepare('DELETE FROM comments WHERE id = ?')->execute([$comment_id]);

        echo json_encode(['success' => true, 'deleted_id' => $comment_id]);
        exit();
    }

    fail_json('Unsupported action.');
} catch (Throwable $e) {
    fail_json('Error: ' . $e->getMessage(), 500);
}
?>

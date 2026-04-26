<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
header('Content-Type: application/json');

require_once 'php/php/db.php';
require_once 'php/php/auth.php';

function article_url(string $articleId, ?int $commentId = null): string {
    if (preg_match('/^submission-(\d+)$/', $articleId, $m)) {
        $url = 'view-article.php?id=' . (int)$m[1];
    } else {
        $url = $articleId . '.php';
    }
    if ($commentId) {
        $url .= '#comment-' . (int)$commentId;
    }
    return $url;
}

function short_time(string $dateString): string {
    $ts = strtotime($dateString);
    if (!$ts) return '';
    $diff = time() - $ts;
    if ($diff < 60) return 'Just now';
    if ($diff < 3600) return floor($diff / 60) . 'm ago';
    if ($diff < 86400) return floor($diff / 3600) . 'h ago';
    if ($diff < 604800) return floor($diff / 86400) . 'd ago';
    return date('M j', $ts);
}

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'notLoggedIn' => true, 'notifications' => [], 'unread' => 0]);
    exit();
}

try {
    $db = getDB();
    $userId = (int)$_SESSION['user_id'];
    $action = $_GET['action'] ?? $_POST['action'] ?? 'list';

    if ($action === 'mark_all_read' && $_SERVER['REQUEST_METHOD'] !== 'GET') {
        $stmt = $db->prepare('UPDATE notifications SET is_read = 1 WHERE recipient_user_id = ? AND is_read = 0');
        $stmt->execute([$userId]);
        echo json_encode(['success' => true]);
        exit();
    }

    $stmt = $db->prepare('SELECT n.*, u.name AS actor_name, u.avatar_color AS actor_avatar
        FROM notifications n
        JOIN users u ON u.id = n.actor_user_id
        WHERE n.recipient_user_id = ?
        ORDER BY n.created_at DESC, n.id DESC
        LIMIT 25');
    $stmt->execute([$userId]);
    $rows = $stmt->fetchAll();

    $unreadStmt = $db->prepare('SELECT COUNT(*) FROM notifications WHERE recipient_user_id = ? AND is_read = 0');
    $unreadStmt->execute([$userId]);
    $unread = (int)$unreadStmt->fetchColumn();

    $notifications = [];
    foreach ($rows as $row) {
        $commentAnchorId = null;
        $message = '';
        switch ($row['type']) {
            case 'comment_reply':
                $commentAnchorId = (int)($row['comment_id'] ?: $row['parent_comment_id']);
                $message = $row['actor_name'] . ' replied to your comment.';
                break;
            case 'comment_like':
                $commentAnchorId = (int)$row['comment_id'];
                $message = $row['actor_name'] . ' liked your comment.';
                break;
            case 'article_comment':
                $commentAnchorId = (int)$row['comment_id'];
                $message = $row['actor_name'] . ' commented on your article.';
                break;
            case 'article_reaction':
                $reactionMap = [
                    'happy' => 'reacted 😊 to your article.',
                    'sad' => 'reacted 😢 to your article.',
                    'surprised' => 'reacted 😮 to your article.',
                    'angry' => 'reacted 😠 to your article.',
                ];
                $message = $row['actor_name'] . ' ' . ($reactionMap[$row['reaction']] ?? 'reacted to your article.');
                break;
            default:
                $message = $row['actor_name'] . ' sent you a notification.';
        }

        $notifications[] = [
            'id' => (int)$row['id'],
            'type' => $row['type'],
            'message' => $message,
            'actor_name' => $row['actor_name'],
            'actor_avatar' => $row['actor_avatar'],
            'is_read' => (bool)$row['is_read'],
            'created_at' => $row['created_at'],
            'time_label' => short_time($row['created_at']),
            'url' => article_url((string)$row['article_id'], $commentAnchorId),
        ];
    }

    echo json_encode([
        'success' => true,
        'notifications' => $notifications,
        'unread' => $unread,
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>

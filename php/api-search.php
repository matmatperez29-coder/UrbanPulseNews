<?php
// php/php/api-search.php — Returns approved submitted articles as JSON for js/search.js
require_once __DIR__ . '/php/db.php';
header('Content-Type: application/json');
header('Cache-Control: max-age=30');

try {
    $db   = getDB();
    $scope = strtolower(trim((string)($_GET['scope'] ?? 'all')));
    $allowedScopes = ['all', 'technology', 'sports', 'entertainment', 'worldnews'];
    if (!in_array($scope, $allowedScopes, true)) {
        $scope = 'all';
    }

    $sql = "
        SELECT s.id, s.title, s.category, s.summary, u.name AS author_name
        FROM article_submissions s
        JOIN users u ON s.author_id = u.id
        WHERE s.status = 'approved'
    ";
    $params = [];
    if ($scope !== 'all') {
        $sql .= ' AND s.category = ?';
        $params[] = $scope;
    }
    $sql .= ' ORDER BY s.submitted_at DESC LIMIT 100';

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $rows    = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = [];
    foreach ($rows as $r) {
        $results[] = [
            'title' => $r['title'],
            'url'   => 'view-article.php?id=' . $r['id'],
            'cat'   => $r['category'],
            'kw'    => $r['author_name'] . ' ' . $r['category'] . ' ' . $r['title'] . ' ' . $r['summary'],
            'desc'  => $r['summary'],
        ];
    }
    echo json_encode(['success' => true, 'articles' => $results]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'articles' => [], 'error' => $e->getMessage()]);
}
<?php
// Grab the variables you just put into Railway
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$port = "5432";

try {
    // This is the magic line! Notice the 'pgsql:' prefix instead of 'mysql:'
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (\PDOException $e) {
    // If it crashes, this will actually tell us WHY instead of giving a blank 500 error
    die("Database connection failed: " . $e->getMessage());
}
?>
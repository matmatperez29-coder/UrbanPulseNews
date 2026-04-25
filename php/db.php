<?php
function getDB() {
    static $pdo = null;
    
    if ($pdo === null) {
        // Vercel handles env variables differently depending on the build
        $host = $_SERVER['DB_HOST'] ?? $_ENV['DB_HOST'] ?? getenv('DB_HOST');
        $password = $_SERVER['DB_PASSWORD'] ?? $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD');
        $user = $_SERVER['DB_USER'] ?? $_ENV['DB_USER'] ?? getenv('DB_USER') ?: 'postgres';
        $dbname = $_SERVER['DB_NAME'] ?? $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: 'postgres';
        $port = '5432';

        // Check if Vercel is actually seeing the variables
        if (!$host || !$password) {
            die("Error: Vercel is not reading your DB_HOST or DB_PASSWORD environment variables.");
        }

        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;sslmode=require";
            $pdo = new PDO($dsn, $password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            // Print the exact Supabase error so we can fix it!
            die("Database Connection Failed: " . $e->getMessage());
        }
    }
    
    return $pdo;
}
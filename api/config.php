<?php
// Supabase PostgreSQL Database configuration
$dbConnected = false;
$conn = null;

$dbUrl = getenv('DATABASE_URL');

if ($dbUrl) {
    // Parse the DATABASE_URL provided by Vercel/Supabase
    $dbopts = parse_url($dbUrl);
    $host = $dbopts["host"] ?? '';
    $port = $dbopts["port"] ?? '5432';
    $user = $dbopts["user"] ?? '';
    $pass = urldecode($dbopts["pass"] ?? '');
    $dbname = ltrim($dbopts["path"] ?? '', '/');
} else {
    // Direct connection for local testing
    $host = 'db.zwylsxvmhjjvchkeqhiq.supabase.co';
    $port = '5432';
    $dbname = 'postgres';
    $user = 'postgres';
    $pass = 'Inder@Cafe555';
}

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // Create PDO connection
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    $dbConnected = true;
} catch (PDOException $e) {
    $dbConnected = false;
}
?>

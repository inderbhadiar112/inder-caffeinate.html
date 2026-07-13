<?php
// Supabase PostgreSQL Database configuration
$dbUrl = getenv('DATABASE_URL');

if ($dbUrl) {
    // Parse the DATABASE_URL provided by Vercel/Supabase
    $dbopts = parse_url($dbUrl);
    $host = $dbopts["host"];
    $port = $dbopts["port"];
    $user = $dbopts["user"];
    $pass = urldecode($dbopts["pass"]); // Decode special characters if url-encoded
    $dbname = ltrim($dbopts["path"], '/');
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
} catch (PDOException $e) {
    die(json_encode(["status" => "error", "message" => "Database connection failed. Please check your credentials."]));
}
?>

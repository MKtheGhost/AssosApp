<?php
// Get the DATABASE_URL from Heroku config
// $databaseUrl = getenv('DATABASE_URL');

// // Check if DATABASE_URL is set
// if (!$databaseUrl) {
//     die("Error: DATABASE_URL not found.\n");
// }

// // Parse the DATABASE_URL into its components
// $url = parse_url($databaseUrl);

// // Check if the URL has the necessary components
// if (!isset($url["host"], $url["user"], $url["pass"], $url["path"])) {
//     die("Error: Unable to parse DATABASE_URL. Missing components.\n");
// }

// Extract the connection parameters
// DATABASE_URL variable does not exist in local environment so coded here instead
$host = 'c7u1tn6bvvsodf.cluster-czz5s0kz4scl.eu-west-1.rds.amazonaws.com';
$username ='u61jlgoi65rvmm';
$password = 'p6e019cefd4ee5d6ea4fe45de6acf69946fe41f6dbdc9f8e7099b67f8d04cbbda';
$dbname = ltrim('d6p9kqnbbnnd9h', '/');  // Remove leading '/' from database name
$port = isset($url["port"]) ? $url["port"] : 5432; // Default PostgreSQL port is 5432

// Print connection details for debugging (comment out in production)
//echo "Connecting to database at $host on port $port\n";

// Set the connection string for PDO with SSL enabled
$connectionString = "pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password;sslmode=require";

// Establish the connection using PDO with SSL enabled
try {
    // Attempt to connect to the database using PDO
    $pdo = new PDO($connectionString);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php
$host = 'c7u1tn6bvvsodf.cluster-czz5s0kz4scl.eu-west-1.rds.amazonaws.com';
$dbname = ltrim('d6p9kqnbbnnd9h', '/');
$user = 'u61jlgoi65rvmm';
$password = 'p6e019cefd4ee5d6ea4fe45de6acf69946fe41f6dbdc9f8e7099b67f8d04cbbda';
$port = 5432; // ou autre si nécessaire

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur de connexion à la base de données."]);
    exit;
}

?>

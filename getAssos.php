<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once "./DBConnect/db_connect.php";

if ($pdo) {
    echo "pdo initialized";
    $stmt = $pdo->query("SELECT * FROM assos;");
    $assos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($assos);
    echo json_encode($assos);
} else {
    echo 'pdo not initialized';
}

include_once "./DBConnect/db_close.php";
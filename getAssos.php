<?php
session_start();
header("Content-Type: application/json");

include_once './DBConnect/db_connect.php';

$sql = "SELECT * FROM assos";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$assos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($assos);

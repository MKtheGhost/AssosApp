<?php
session_start();
header("Content-Type: application/json");

include_once './DBConnect/db_connect.php';

$sql = "SELECT * FROM don";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$don = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo=null;

echo json_encode($don);

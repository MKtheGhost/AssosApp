<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(["error" => "Non autorisé"]);
    exit;
}

include_once './DBConnect/db_connect.php';

$userId = $_SESSION['user_id'];

$sql = "SELECT user_firstname, user_name, user_address, user_city, user_zipcode, user_mail, user_password FROM users WHERE user_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $userId);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user);

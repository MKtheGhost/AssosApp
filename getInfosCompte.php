<?php
session_start();
header("Content-Type: application/json");

include_once './DBConnect/db_connect.php';

$userId = $_POST['user_id'];

$sql = "SELECT user_firstname, user_name, user_address, user_city, user_zipcode, user_mail, newsletter, currency FROM users WHERE user_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $userId);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($user);

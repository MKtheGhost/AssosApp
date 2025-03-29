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

// Récupérer les données postées
$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    echo json_encode(["error" => "Aucune donnée reçue."]);
    exit;
}

// Préparation de la requête
$sql = "UPDATE users SET 
    user_firstname = :firstname, 
    user_name = :lastname, 
    user_address = :address, 
    user_city = :city, 
    user_zipcode = :zipcode, 
    user_mail = :email,
    newsletter = :newsletter";
    

// On ne modifie le mot de passe que s’il est renseigné
if (!empty($data->password)) {
    $sql .= ", user_password = :password";
}

$sql .= " WHERE user_id = :user_id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':firstname', $data->firstname);
$stmt->bindParam(':lastname', $data->lastname);
$stmt->bindParam(':address', $data->address);
$stmt->bindParam(':city', $data->city);
$stmt->bindParam(':zipcode', $data->zipcode);
$stmt->bindParam(':email', $data->email);

$newletter = (bool)$data->newletter;
$stmt->bindValue(':newletter', $newletter, PDO::PARAM_BOOL);

if (!empty($data->password)) {
    $hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword);
}

$stmt->bindParam(':user_id', $userId);

if ($stmt->execute()) {
    echo json_encode(["message" => "Modifications enregistrées ✅"]);
} else {
    echo json_encode(["error" => "Erreur lors de la mise à jour"]);
}

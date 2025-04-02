<?php

session_start();
header("Content-Type: application/json");


include_once './DBConnect/db_connect.php';

$userId = $_GET['user_id'];


// Récupérer les données postées
$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    $pdo=null;
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
    newsletter = :newsletter,
    currency = :currency";

    

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

$newsletter = !empty($data->newsletter) ? 1 : 0;
$stmt->bindValue(':newsletter', $newsletter, PDO::PARAM_INT);

$stmt->bindParam(':currency', $data->currency);

if (!empty($data->password)) {
    $hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword);
}

$stmt->bindParam(':user_id', $userId);

if ($stmt->execute()) {
    $pdo=null;
    echo json_encode(["message" => "Modifications enregistrées ✅"]);
} else {
    $pdo = null;
    echo json_encode(["error" => "Erreur lors de la mise à jour"]);
}

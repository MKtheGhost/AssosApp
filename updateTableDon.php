<?php

header("Content-Type: application/json");

$userId = $_GET['user_id'] ?? null;

if ($userId == null) {
    http_response_code(403);
    echo json_encode(["error" => "Non autorisé"]);
    exit;
}

include_once './DBConnect/db_connect.php';


// Récupérer les données postées
$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    echo json_encode(["error" => "Aucune donnée reçue."]);
    exit;
}

// Sécurisation des données reçues
$montant_don = $data->montant_don ?? null;
$recurrence = $data->recurrence ?? 0;
$id_user = $userId;
$id_assos = $data->id_assos ?? null;
$date_don = null;
$recurrence_interval = $data->reccurence_interval ?? null;
$currency = $data->currency;

if (!$montant_don || !$id_user || !$id_assos) {
    http_response_code(400);
    $pdo = null;
    echo json_encode(["error" => "Données manquantes pour l'enregistrement."]);
    exit;
}

try {
    $sql = "INSERT INTO don (montant_don, recurrence, id_user, id_assos, date_don, recurrence_interval, currency)
            VALUES (:montant_don, :recurrence, :id_user, :id_assos, :date_don, :recurrence_interval, :currency)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':montant_don', $montant_don);
    $stmt->bindParam(':recurrence', $recurrence);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_assos', $id_assos);
    $stmt->bindParam(":date_don", $date_don);
    $stmt->bindParam(':recurrence_interval', $recurrence_interval);
    $stmt->bindParam(':currency', $currency);

    $stmt->execute();

    $pdo = null;
    echo json_encode(["success" => true, "message" => "Don enregistré avec succès."]);
} catch (PDOException $e) {
    http_response_code(500);
    $pdo = null;
    echo json_encode(["error" => "Erreur lors de l'enregistrement : " . $e->getMessage()]);
}

<?php
session_start();
header("Content-Type: application/json");

include_once './DBConnect/db_connect.php';

// get an assos by it's id
if (isset($_GET["asso_id"])) {
    $sql = "SELECT id, nom, description, image  FROM assos WHERE id_assos = :id_assos";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_assos', $_GET["asso_id"]);
    $stmt->execute();
    $assos = $stmt->fetch(PDO::FETCH_ASSOC);

} else {
    $sql = "SELECT * FROM assos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $assos = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

$pdo=null;

echo json_encode($assos);

<?php
session_start();
header("Content-Type: application/json");

include_once './DBConnect/db_connect.php';

// get don unique that was done by registered users
if (isset($_GET["user_id"]) && $_GET["recurrence"] == 0) {
    $sql = "SELECT id_don, montant_don, recurrence ,id_user, id_assos, date_don, currency  FROM don WHERE id_user = :id_user AND recurrence = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_user', $_GET["user_id"]);
    $stmt->execute();
    $don = $stmt->fetchAll(PDO::FETCH_ASSOC);

// get don recurrent
} else if (isset($_GET["user_id"]) && $_GET["recurrence"] == 1) {
    $sql = "SELECT id_don, montant_don, recurrence ,id_user, id_assos, date_don,  currency  FROM don WHERE id_user = :id_user AND recurrence = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_user', $_GET["user_id"]);
    $stmt->execute();
    $don = $stmt->fetchAll(PDO::FETCH_ASSOC);

// get all don
}else {
    $sql = "SELECT * FROM don";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $don = $stmt->fetchAll(PDO::FETCH_ASSOC);

}


$pdo=null;

echo json_encode($don);

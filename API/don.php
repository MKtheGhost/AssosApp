<?php

header("Content-Type: application/json");
include_once './../DBConnect/db_connect.php'; // Include the database connection

// Get the HTTP method used (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Fetch the input data from request
$data = json_decode(file_get_contents("php://input"));

// Handle API requests based on HTTP method
switch ($method) {
    case 'GET':
        getDon();
        break;
    case 'POST':
        insertDon($data);
        break;
    case 'PUT':
        updateDon($data);
        break;
    case 'DELETE':
        deleteDon($data);
        break;
    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

include_once './../DBConnect/db_close.php'; // Include the database close


// Function to retrieve all donations (don)
function getDon() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM don");
    $don = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($don);
}

// Function to insert a new donation (don)
function insertDon($data) {
    global $pdo;

    if (isset($data->montant_don) && isset($data->recurrence) && isset($data->id_user) && isset($data->id_assos)) {
        $sql = "INSERT INTO don (montant_don, recurrence, id_user, id_assos) VALUES (:montant_don, :recurrence, :id_user, :id_assos)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':montant_don', $data->montant_don);
        $stmt->bindParam(':recurrence', $data->recurrence);
        $stmt->bindParam(':id_user', $data->id_user);
        $stmt->bindParam(':id_assos', $data->id_assos);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Donation inserted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to insert donation"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

// Function to update a donation (don)
function updateDon($data) {
    global $pdo;

    if (isset($data->id_don) && isset($data->montant_don) && isset($data->recurrence) && isset($data->id_user) && isset($data->id_assos)) {
        $sql = "UPDATE don SET montant_don = :montant_don, recurrence = :recurrence, id_user = :id_user, id_assos = :id_assos WHERE id_don = :id_don";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_don', $data->id_don);
        $stmt->bindParam(':montant_don', $data->montant_don);
        $stmt->bindParam(':recurrence', $data->recurrence);
        $stmt->bindParam(':id_user', $data->id_user);
        $stmt->bindParam(':id_assos', $data->id_assos);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Donation updated successfully"]);
        } else {
            echo json_encode(["message" => "Failed to update donation"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

// Function to delete a donation (don)
function deleteDon($data) {
    global $pdo;

    if (isset($data->id_don)) {
        $sql = "DELETE FROM don WHERE id_don = :id_don";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_don', $data->id_don);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Donation deleted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to delete donation"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

?>

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
        getAssos();
        break;
    case 'POST':
        insertAssos($data);
        break;
    case 'PUT':
        updateAssos($data);
        break;
    case 'DELETE':
        deleteAssos($data);
        break;
    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

include_once './../DBConnect/db_close.php';

// Function to retrieve all assos
function getAssos() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM assos");
    $assos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($assos);
}

// Function to insert a new association (assos)
function insertAssos($data) {
    global $pdo;

    if (isset($data->nom_assos) && isset($data->description)) {
        $sql = "INSERT INTO assos (nom_assos, description) VALUES (:nom_assos, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom_assos', $data->nom_assos);
        $stmt->bindParam(':description', $data->description);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Association inserted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to insert association"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

// Function to update an association (assos)
function updateAssos($data) {
    global $pdo;

    if (isset($data->id_assos) && isset($data->nom_assos) && isset($data->description)) {
        $sql = "UPDATE assos SET nom_assos = :nom_assos, description = :description WHERE id_assos = :id_assos";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_assos', $data->id_assos);
        $stmt->bindParam(':nom_assos', $data->nom_assos);
        $stmt->bindParam(':description', $data->description);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Association updated successfully"]);
        } else {
            echo json_encode(["message" => "Failed to update association"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

// Function to delete an association (assos)
function deleteAssos($data) {
    global $pdo;

    if (isset($data->id_assos)) {
        $sql = "DELETE FROM assos WHERE id_assos = :id_assos";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_assos', $data->id_assos);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Association deleted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to delete association"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

?>

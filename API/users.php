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
        getUsers();
        break;
    case 'POST':
        insertUser($data);
        break;
    case 'PUT':
        updateUser($data);
        break;
    case 'DELETE':
        deleteUser($data);
        break;
    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

// close connection
include_once './../DBConnect/db_close.php';

// Function to retrieve all users
function getUsers() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
}

// Function to insert a new user
function insertUser($data) {
    global $pdo;

    if (isset($data->user_login) && isset($data->user_password) && isset($data->user_grade)) {
        $sql = "INSERT INTO users (user_login, user_password, user_grade) VALUES (:user_login, :user_password, :user_grade)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_login', $data->user_login);
        $stmt->bindParam(':user_password', $data->user_password);
        $stmt->bindParam(':user_grade', $data->user_grade);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User inserted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to insert user"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

// Function to update an existing user
function updateUser($data) {
    global $pdo;

    if (isset($data->user_id) && isset($data->user_login) && isset($data->user_password) && isset($data->user_grade)) {
        $sql = "UPDATE users SET user_login = :user_login, user_password = :user_password, user_grade = :user_grade WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $data->user_id);
        $stmt->bindParam(':user_login', $data->user_login);
        $stmt->bindParam(':user_password', $data->user_password);
        $stmt->bindParam(':user_grade', $data->user_grade);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            echo json_encode(["message" => "Failed to update user"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

// Function to delete a user
function deleteUser($data) {
    global $pdo;

    if (isset($data->user_id)) {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $data->user_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to delete user"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }
}

?>

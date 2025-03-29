<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include_once './../DBConnect/db_connect.php'; // Include the database connection

// Get the HTTP method used (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Fetch the input data from request
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

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

    // close connection
    include_once './../DBConnect/db_close.php';
}

// Function to insert a new user
function insertUser($data) {
    global $pdo;

    if (
        isset($data->user_password) &&
        isset($data->user_firstName) && isset($data->user_name) && isset($data->user_address) &&
        isset($data->user_mail) && isset($data->user_city) && isset($data->user_zipcode)
    ) {
        $sql = "INSERT INTO users 
        (user_password, user_grade, user_firstName, user_name, user_address, user_mail, user_city, user_zipcode)
        VALUES 
        (:user_password, :user_grade, :user_firstName, :user_name, :user_address, :user_mail, :user_city, :user_zipcode)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_password', $data->user_password);
        $stmt->bindParam(':user_grade', $data->user_grade);
        $stmt->bindParam(':user_firstName', $data->user_firstName);
        $stmt->bindParam(':user_name', $data->user_name);
        $stmt->bindParam(':user_address', $data->user_address);
        $stmt->bindParam(':user_mail', $data->user_mail);
        $stmt->bindParam(':user_city', $data->user_city);
        $stmt->bindParam(':user_zipcode', $data->user_zipcode);

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

    if (
        isset($data->user_password) && isset($data->user_firstName) && isset($data->user_name) && isset($data->user_address) &&
        isset($data->user_mail) && isset($data->user_city) && isset($data->user_zipcode) && isset($data->newsletter)
    ) {
        $sql = "UPDATE users SET user_password = :user_password, user_grade = :user_grade WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $data->user_id);
        $stmt->bindParam(':user_password', $data->user_password);
        $stmt->bindParam(':user_grade', $data->user_grade);
        $stmt->bindParam(':user_login', $data->user_login);
        $stmt->bindParam(':user_password', $data->user_password);
        $stmt->bindParam(':user_grade', $data->user_grade);
        $stmt->bindParam(':user_firstName', $data->user_firstName);
        $stmt->bindParam(':user_name', $data->user_name);
        $stmt->bindParam(':user_address', $data->user_address);
        $stmt->bindParam(':user_mail', $data->user_mail);
        $stmt->bindParam(':user_city', $data->user_city);
        $stmt->bindParam(':user_zipcode', $data->user_zipcode);
        $stmt->bindParam(':newsletter', $data->newsletter);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            echo json_encode(["message" => "Failed to update user"]);
        }
    } else {
        echo json_encode(["message" => "Missing parameters"]);
    }

    // close connection
    include_once './../DBConnect/db_close.php';
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

    // close connection
    include_once './../DBConnect/db_close.php';
}

?>

<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lms';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $mysqli->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);
$username = $mysqli->real_escape_string($data['username']);

$query = "SELECT first_name, last_name, email FROM users WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(['status' => 'success', 'user' => $user]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

$stmt->close();
$mysqli->close();
?>

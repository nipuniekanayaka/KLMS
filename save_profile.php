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
$first_name = $mysqli->real_escape_string($data['first_name']);
$last_name = $mysqli->real_escape_string($data['last_name']);

$query = "UPDATE users SET first_name = ?, last_name = ? WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('sss', $first_name, $last_name, $username);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
}

$stmt->close();
$mysqli->close();
?>

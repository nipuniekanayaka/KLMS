<?php
// Database connection details
$host = 'localhost';  // Replace with your database host
$user = 'root';       // Replace with your database username
$password = '';       // Replace with your database password
$database = 'lms';    // Replace with your database name

// Create a new connection
$mysqli = new mysqli($host, $user, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die(json_encode(array('status' => 'error', 'message' => 'Connection failed: ' . $mysqli->connect_error)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $first_name = $mysqli->real_escape_string($_POST['first_name']);
    $last_name = $mysqli->real_escape_string($_POST['last_name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validate password confirmation
    if ($password !== $confirm_password) {
        echo json_encode(array('status' => 'error', 'message' => 'Passwords do not match.'));
        exit();
    }

    // Hash the password for storage
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");

    // Check if preparation was successful
    if ($stmt === false) {
        echo json_encode(array('status' => 'error', 'message' => 'Prepare failed: ' . $mysqli->error));
        exit();
    }

    // Bind parameters
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'Registration successful.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $stmt->error));
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();
?>

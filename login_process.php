<?php
// Start session
session_start();

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
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $mysqli->prepare("SELECT id, password, email FROM users WHERE email = ?");

    // Check if preparation was successful
    if ($stmt === false) {
        echo json_encode(array('status' => 'error', 'message' => 'Prepare failed: ' . $mysqli->error));
        exit();
    }

    // Bind parameters
    $stmt->bind_param("s", $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Store the result
        $stmt->store_result();

        // Check if user exists
        if ($stmt->num_rows > 0) {
            // Bind result variables
            $stmt->bind_result($id, $hashed_password, $email);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Store username in session
                $_SESSION['username'] = $email;  // Assuming email is used as the username
                echo json_encode(array('status' => 'success', 'message' => 'Login successful.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid password.'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'User not found.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $stmt->error));
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();
?>

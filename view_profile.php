<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT first_name, last_name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if (!$user) {
        echo "No user found with the provided ID.";
        exit;
    }
} else {
    echo "Failed to prepare SQL statement.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Growing Together - View Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <nav class="sidebar">
            <div class="logo">
                <h2>Growing Together</h2>
            </div>
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="view_profile.php" class="active"><i class="fas fa-user"></i> View Profile</a></li>
                <li><a href="edit_profile.php"><i class="fas fa-edit"></i> Edit Profile</a></li>
                <li><a href="change_password.php"><i class="fas fa-key"></i> Change Password</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <header>
                <h1>My Profile</h1>
            </header>
            <section class="profile-details">
                <h2>Profile Information</h2>
                <table>
                    <tr>
                        <th>First Name:</th>
                        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                </table>
            </section>
        </div>
    </div>
</body>
</html>

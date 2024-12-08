<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Growing Together - Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dboard_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="images/favicon.png"/>

    <style>
        body {
            position: relative;
            overflow-x: hidden;
            background-color: #CFD8DC; /* Match existing background color */
        }

        .sidebar {
            height: 100vh; /* Full-height sidebar */
            background: #1a1a1a; /* Dark background for sidebar */
            padding-top: 20px; /* Padding at the top */
        }

        .sidebar .nav-link {
            color: #ddd; /* Light text color */
            padding: 10px 15px; /* Padding for links */
        }

        .sidebar .nav-link:hover {
            color: #fff; /* Change color on hover */
            background-color: transparent; /* Match existing hover effect */
        }

        .sidebar .nav-link.active {
            color: #ec1b5a; /* Active link color */
        }

        .sidebar-brand {
            text-align: center;
            color: #fff; /* White text for brand */
            margin-bottom: 20px; /* Margin below brand */
        }

        .module-card {
            cursor: pointer; /* Indicate clickable module cards */
            padding: 20px;
            border: 1px solid #ccc; /* Card border */
            border-radius: 5px; /* Rounded corners for cards */
            transition: background-color 0.3s; /* Smooth background transition */
        }

        .module-card:hover {
            background-color: #f0f0f0; /* Light gray on hover */
        }
    </style>
</head>
<body>
    <div id="wrapper" class="d-flex">
        <nav class="sidebar">
            <div class="sidebar-brand">
                <h2>KLMS</h2>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="creative_corner.php"><i class="fas fa-paint-brush"></i> Creative Corner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-heartbeat"></i> Healthy Habits Hub</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-language"></i> Multilingual Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-leaf"></i> Environmental Awareness Initiative</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-tree"></i> Virtual Nature Nook</a>
                </li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($username); ?>!</h1>
                <div class="header-icons">
                    <i class="fas fa-bell bell-icon" onclick="toggleDropdown('notification-dropdown')"></i>
                    <div id="notification-dropdown" class="dropdown-content">
                        <h2>Notifications</h2>
                        <div class="notification">
                            <p>New activities available in the Creative Corner!</p>
                            <button class="close-btn" onclick="closeNotification(event)">&times;</button>
                        </div>
                        <div class="notification">
                            <p>Don’t forget to check out the latest healthy recipes in the Healthy Habits Hub.</p>
                            <button class="close-btn" onclick="closeNotification(event)">&times;</button>
                        </div>
                    </div>
                    <div class="account-dropdown">
                        <div class="account-icon" onclick="toggleDropdown('account-dropdown-content')">
                            <i class="fas fa-user"></i>
                        </div>
                        <div id="account-dropdown-content" class="dropdown-content">
                            <ul>
                                <li><a href="view_profile.php"><i class="fas fa-user"></i> View Profile</a></li>
                                <li><a href="#" onclick="editProfile('<?php echo htmlspecialchars($username); ?>')"><i class="fas fa-edit"></i> Edit Profile</a></li>
                                <li><a href="#"><i class="fas fa-key"></i> Change Password</a></li>
                                <li><a href="#" onclick="confirmLogout(event)"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <section class="module-overview">
                <div class="module-card" onclick="window.location.href='creative_corner.php'">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Creative Corner</h3>
                </div>

                <div class="module-card" onclick="window.location.href='healthy_habits.php'">
                    <i class="fas fa-heartbeat"></i>
                    <h3>Healthy Habits Hub</h3>
                </div>

                <div class="module-card" onclick="window.location.href='flashcards Game.php'">
                    <i class="fas fa-language"></i>
                    <h3>Multilingual Support</h3>
                </div>

                <div class="module-card" onclick="window.location.href='environmental_awareness_initiative.php'">
                    <i class="fas fa-leaf"></i>
                    <h3>Environmental Awareness Initiative</h3>
                </div>

                <div class="module-card"onclick="window.location.href='virtual_nature.php'">
                    <i class="fas fa-tree"></i>
                    <h3>Virtual Nature Nook</h3>
                </div>
            </section>

            <section class="help-support">
                <h2>Help & Support</h2>
                <p>If you need any assistance, please visit our <a href="#">Help Center</a> or contact our support team.</p>
            </section>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

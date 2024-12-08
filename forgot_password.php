<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Include Composer's autoloader

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $mysqli = new mysqli('localhost', 'root', '', 'lms');

    // Check connection
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    $email = $mysqli->real_escape_string($_POST['email']);

    // Check if email exists
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a reset token
        $token = bin2hex(random_bytes(20)); // Generate a random token

        // Set the current time to Sri Lanka time and add 1 hour for expiry
        $datetime = new DateTime("now", new DateTimeZone('Asia/Colombo'));
        $datetime->add(new DateInterval('PT1H')); // Add 1 hour
        $expiry = $datetime->format('Y-m-d H:i:s'); // Format as a string for MySQL

        // Insert token into database
        $stmt = $mysqli->prepare("INSERT INTO password_resets (email, token, expiry) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expiry);
        $stmt->execute();

        // Send email with reset link using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'apogee.users.orbitsl.net'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply.hris@apogee.lk'; // Your email address
            $mail->Password = '96P763RumQ'; // Your email password (or app password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('noreply.hris@apogee.lk', 'Kindergarten'); // Sender
            $mail->addAddress($email); // Recipient email

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Password Reset Request';

            // Reset link and body content
            $reset_link = "http://localhost/lms/reset_password.php?token=$token"; // Update your domain
            $mail->Body = "
                <html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                color: #333;
                                line-height: 1.6;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                border: 1px solid #e1e1e1;
                                border-radius: 5px;
                                background-color: #f9f9f9;
                            }
                            .header {
                                background-color: #007BFF;
                                color: white;
                                padding: 10px;
                                text-align: center;
                                border-radius: 5px 5px 0 0;
                            }
                            .footer {
                                text-align: center;
                                font-size: 0.9em;
                                color: #777;
                            }
                            a {
                                color: #007BFF;
                                text-decoration: none;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <div class='header'>
                                <h2>Password Reset Request</h2>
                            </div>
                            <p>Dear User,</p>
                            <p>We received a request to reset your password. Click the link below to create a new password:</p>
                            <p><a href='$reset_link'>$reset_link</a></p>
                            <p>If you did not request a password reset, please ignore this email.</p>
                            <p>Thank you,</p>
                            <p>Your Team</p>
                            <div class='footer'>
                                <p>&copy; " . date('Y') . " Kindergarten. All rights reserved.</p>
                            </div>
                        </div>
                    </body>
                </html>
            ";

            // Send email
            $mail->send();
            echo "<script>alert('Reset link has been sent to your email.');</script>";
            echo "<script>document.getElementById('email').value = '';</script>"; // Clear input field

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('Email not found.');</script>";
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #e9f5ff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Your Password?</h2>
        <form method="POST">
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Send Reset Link</button>
        </form>
        <div class="footer">
            <a href="login.html">Return to Login</a>
        </div>
    </div>
</body>
</html>

<?php
// contact.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Growing Together</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
        }

        /* Hero Header Style */
        header {
            position: relative;
            background: url('images/contact-hero.jpg') no-repeat center center/cover;
            color: #fff;
            text-align: center;
            padding: 100px 20px;
            height: 400px;
            background-attachment: fixed;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        header h1 {
            font-size: 3.5em;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 0;
            z-index: 2;
            animation: fadeInDown 2s ease-in-out;
        }

        header p {
            font-size: 1.4em;
            margin-top: 20px;
            z-index: 2;
            opacity: 0;
            animation: fadeInUp 2s 1s forwards ease-in-out;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Contact Form Section */
        .contact-section {
            padding: 50px 20px;
            background: #fff;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .contact-section h2 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 40px;
            color: #333;
        }

        .contact-form {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out;
        }

        .contact-form:hover {
            transform: scale(1.05);
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
            margin-top: 5px;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .btn {
            background: #ffcc00;
            color: #fff;
            border: none;
            padding: 15px 25px;
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #ff9900;
        }

        .social-icons {
            margin-top: 40px;
        }

        .social-icons a {
            color: #ffcc00;
            font-size: 1.8em;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #ff9900;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>

    <header>
        <div>
            <h1>Contact Us</h1>
            <p>We're here to help! Drop us a message and we'll get back to you soon.</p>
        </div>
    </header>

    <section class="contact-section">
        <h2>Send Us A Message</h2>
        <div class="contact-form">
            <form action="contact_process.php" method="post">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
        
        <!-- Social Media Icons (optional) -->
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </section>

    <footer>
        <div>
            <p>&copy; 2024 Growing Together. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>

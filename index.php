<?php
// about.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Growing Together</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Academy Logo">
        </div>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="#modules">Modules</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="stu_reg/login.php">Student Registration</a></li>
                </ul>
            </nav>
        </div>
        <div class="auth-buttons">
            <a href="login.php">
                <button class="login-btn">Log In</button>
            </a>
            <a href="signup.php">
                <button class="signup-btn">Sign Up</button>
            </a>
        </div>
    </header>
    
    <section class="hero">
        <div class="animated-icons">
            <i class="fas fa-book"></i>
            <i class="fas fa-puzzle-piece"></i>
            <i class="fas fa-apple-alt"></i>
            <i class="fas fa-robot"></i>
            <i class="fas fa-paw"></i>
        </div>
        <div class="container">
            <h2>Fostering Creativity and Learning in Kindergarten</h2>
            <p>Empowering students for success through holistic development.</p>
        </div>
    </section>
    
    <section id="modules" class="modules">
        <div class="container">
            <h2>Our Modules</h2>
            <div class="module-grid">
                <a href="#modules" class="module">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Creative Corner</h3>
                    <p>Promote self-expression through artistic, musical, and literary activities.</p>
                </a>
                <a href="#modules" class="module">
                    <i class="fas fa-heartbeat"></i>
                    <h3>Healthy Habits Hub</h3>
                    <p>Resources for healthy habits, nutrition, and interactive exercise challenges.</p>
                </a>
                <a href="#modules" class="module">
                    <i class="fas fa-language"></i>
                    <h3>Multilingual Support</h3>
                    <p>Language learning resources and translation services.</p>
                </a>
                <a href="#modules" class="module">
                    <i class="fas fa-leaf"></i>
                    <h3>Environmental Awareness Initiative</h3>
                    <p>Fostering environmental responsibility through engaging projects.</p>
                </a>
                <a href="#modules" class="module">
                    <i class="fas fa-tree"></i>
                    <h3>Virtual Nature Nook</h3>
                    <p>Bringing nature into the digital realm through virtual exploration.</p>
                </a>
            </div>
        </div>
    </section>
    
    <footer>
        <p>© 2024 Growing Together. All rights reserved.</p>
        <ul>
            <li><a href="about.html">About</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Condition</a></li>
        </ul>
    </footer>
</body>
</html>

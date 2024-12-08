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
    <title>Creative Corner - Growing Together</title>
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.12/lottie.min.js"></script>
    <style>
        /* Styles for the game */
        .game-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            background-color: #f9f9f9;
            display: none; /* Initially hidden */
        }
        canvas {
            border: 2px solid #000;
            cursor: pointer;
        }
        .color-picker, .reset-button {
            margin-top: 10px;
        }
        button {
            padding: 10px 15px;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        /* Style for the congratulations message */
        #congratulations {
            display: none;
            padding: 10px;
            background-color: #4CAF50; /* Green background */
            color: white;
            font-size: 24px;
            text-align: center;
            margin-top: 20px;
            border-radius: 5px;
            position: absolute; /* Position it at the top */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000; /* Ensure it appears above other content */
        }

        /* Confetti container */
        #confetti {
            width: 100%;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            pointer-events: none;
            z-index: 9999; /* Highest to ensure visibility */
        }

        /* Game selector buttons */
        .game-selection {
            text-align: center;
            margin-top: 20px;
        }

        .game-selection button {
            background-color: #008CBA; /* Blue */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }

        .game-selection button:hover {
            background-color: #005f73; /* Darker blue */
        }

        /* Styles for shape matching game */
        .shape-matching-game {
            display: none; /* Initially hidden */
            text-align: center;
        }

        .shape-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .shape {
            width: 50px;
            height: 50px;
            margin: 10px;
            cursor: pointer;
            display: inline-block;
            position: relative;
        }

        /* Slot styles */
        .slot {
            width: 50px;
            height: 50px;
            margin: 10px;
            display: inline-block;
            position: relative;
            overflow: hidden; /* Hide overflow for non-matching shapes */
        }

        /* Circle slot */
        .circle-slot {
            border: 2px dashed #ccc;
            border-radius: 50%; /* Make circular slot */
            background-color: transparent;
        }

        /* Square slot */
        .square-slot {
            border: 2px dashed #ccc;
            background-color: transparent;
        }

        /* Triangle slot */
        .triangle-slot {
            border: 2px dashed #ccc;
            background-color: transparent;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%); /* Triangle shape */
        }

        body {
            background-color: bisque;
            overflow: hidden;
        }

        #centerText {
            font-family: 'Rock Salt', cursive;
            font-size: xx-large;
        }

        #square {
            width: 100px;
            height: 100px;
            background: red;
        }

        #circle {
            width: 100px;
            height: 100px;
            background: blue;
            border-radius: 50px;
        }

        #triangle-up {
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 100px solid green;
        }

        #pacman {
            width: 0px;
            height: 0px;
            border-right: 60px solid transparent;
            border-top: 60px solid yellow;
            border-left: 60px solid yellow;
            border-bottom: 60px solid yellow;
            border-top-left-radius: 60px;
            border-top-right-radius: 60px;
            border-bottom-left-radius: 60px;
            border-bottom-right-radius: 60px;
        }

        #squareinside {
            width: 100px;
            height: 100px;
            background: gray;
        }

        #circleinside {
            width: 100px;
            height: 100px;
            background: gray;
            border-radius: 50px;
        }

        #triangle-upinside {
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 100px solid gray;
        }

        #pacmaninside {
            width: 0px;
            height: 0px;
            border-right: 60px solid transparent;
            border-top: 60px solid gray;
            border-left: 60px solid gray;
            border-bottom: 60px solid gray;
            border-top-left-radius: 60px;
            border-top-right-radius: 60px;
            border-bottom-left-radius: 60px;
            border-bottom-right-radius: 60px;
        }

    </style>
</head>
<body>
    <div id="congratulations">Congratulations! You've colored the rainbow!</div>
    <div id="confetti"></div>

    
    <div class="main-content">
        <header>
            <h1>Welcome to the Creative Corner, <?php echo htmlspecialchars($username); ?>!</h1>
        </header>
        <section>
            <p>Select a game to play:</p>
            <!-- Game selection buttons -->
            <div class="game-selection">
                <button onclick="openGame('rainbow')">Play Color the Rainbow</button>
                <button onclick="openGame('shapeMatching')">Play Shape Matching Game</button>
            </div>
            
            <!-- Rainbow game container (Initially hidden) -->
            <div id="rainbowGame" class="game-container">
                <h2>Color the Rainbow Game</h2>
                <canvas id="rainbowCanvas" width="600" height="400"></canvas>
                <div class="color-picker">
                    <label for="colorSelect">Choose a color:</label>
                    <input type="color" id="colorSelect" value="#ff0000" />
                </div>
                <div class="reset-button">
                    <button id="resetBtn">Reset Rainbow</button>
                </div>
            </div>

            <!-- Shape Matching Game -->
            <div id="shapeMatching" class="shape-matching-game">
                <h2>Shape Matching Game</h2>
                <div style="width:100%; height:25%; z-index:1;">
                    <div id="square" class="selectable" style="float:left;"></div>
                    <div id="pacmaninside" style="float:right;" class="destination"></div>
                </div>

                <div style="width:100%; height:25%; z-index:2;">
                    <div id="circle" class="selectable" style="float:left;"></div>
                    <div id="triangle-upinside" style="float:right;" class="destination"></div>
                </div>

                <div style="width:100%; height:25%; z-index:3;">
                    <div id="triangle-up" class="selectable" style="float:left;"></div>
                    <div id="circleinside" style="float:right;" class="destination"></div>
                </div>

                <div style="width:100%; height:25%; z-index:4;">
                    <div id="pacman" class="selectable" style="float:left;"></div>
                    <div id="squareinside" style="float:right;" class="destination"></div>
                </div>

                <div id="centerText" style="width:100%; height:100%; z-index:0;" align="center">
                    Match the Shapes!
                </div>
            </div>
            <!-- End Shape Matching Game -->

            <script>
                // Show the selected game and hide others
                function openGame(gameId) {
                    const games = document.getElementsByClassName("game-container");
                    for (let game of games) {
                        game.style.display = "none"; // Hide all games
                    }
                    // Correctly reference the game by its ID
                    const selectedGame = gameId === 'rainbow' ? "rainbowGame" : "shapeMatching"; 
                    document.getElementById(selectedGame).style.display = "block"; // Show the selected game
                }

                // Rainbow Game Logic
                const canvas = document.getElementById("rainbowCanvas");
                const ctx = canvas.getContext("2d");
                let selectedColor = document.getElementById("colorSelect").value;
                let sectionsColored = new Array(7).fill(false); // 7 sections for the rainbow

                // Initial drawing of the rainbow in gray (default color)
                function drawRainbow() {
                    const centerX = canvas.width / 2;
                    const centerY = canvas.height - 20;
                    const radius = 220; // Adjusted radius for 7 sections
                    const lineWidth = 30; // Adjusted width for 7 sections
                    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas

                    // Draw seven gray (or neutral) sections for the rainbow
                    for (let i = 0; i < 7; i++) {
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, radius - (lineWidth * i), Math.PI, 0, false);
                        ctx.lineWidth = lineWidth;
                        ctx.strokeStyle = sectionsColored[i] ? sectionsColored[i] : '#cccccc'; // Use colored section or gray
                        ctx.stroke();
                    }
                }

                // Function to color the rainbow section
                function colorSection(event) {
                    const rect = canvas.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    const centerX = canvas.width / 2;
                    const centerY = canvas.height - 20;
                    const radius = 220;

                    // Check which section is clicked
                    for (let i = 0; i < 7; i++) {
                        const startRadius = radius - (30 * (i + 1)); // Adjusted for 7 sections
                        const endRadius = radius - (30 * i); // Adjusted for 7 sections

                        const distance = Math.sqrt((x - centerX) ** 2 + (y - centerY) ** 2);
                        if (distance >= startRadius && distance <= endRadius && !sectionsColored[i]) {
                            sectionsColored[i] = selectedColor; // Save the selected color for the section
                            drawRainbow(); // Redraw the rainbow with the new color
                            checkWinCondition(); // Check for win condition
                            break;
                        }
                    }
                }

                // Function to check if the player has colored all sections
                function checkWinCondition() {
                    if (sectionsColored.every(Boolean)) {
                        showCongratulations();
                        playConfetti(); // Play confetti animation
                    }
                }

                // Function to display the congratulations message
                function showCongratulations() {
                    const congratsMessage = document.getElementById("congratulations");
                    congratsMessage.style.display = "block"; // Show the message
                    setTimeout(() => {
                        congratsMessage.style.display = "none"; // Hide after 3 seconds
                    }, 3000);
                }

                // Reset function to clear the rainbow colors and redraw in gray
                function resetRainbow() {
                    sectionsColored = new Array(7).fill(false); // Reset the sections array
                    drawRainbow(); // Redraw the rainbow in gray
                }

                // Play confetti animation using Lottie
                function playConfetti() {
                    const confettiContainer = document.getElementById("confetti");
                    confettiContainer.style.display = "block"; // Show confetti
                    lottie.loadAnimation({
                        container: confettiContainer, // ID of the element
                        renderer: 'svg',
                        loop: false,
                        autoplay: true,
                        path: 'public/animations/Animation - 1729081077354.json' // Correct path to your JSON file
                    });
                    setTimeout(() => {
                        confettiContainer.style.display = "none"; // Hide confetti after the animation finishes
                    }, 5000); // Adjust timing if needed
                }

                // Event listeners for Rainbow Game
                canvas.addEventListener("click", colorSection);
                document.getElementById("colorSelect").addEventListener("input", (event) => {
                    selectedColor = event.target.value;
                });
                document.getElementById("resetBtn").addEventListener("click", resetRainbow);

                // Initial drawing of the rainbow
                drawRainbow();

                // Shape Matching Game Logic
                $(document).ready(function () {
                    $(".selectable").draggable({
                        addClasses: false,
                        snap: true,
                        scroll: false
                    });

                    $(".destination").droppable({
                        drop: function (event, ui) {
                            var selectedShape = ui.draggable.attr("id");
                            var dropZone = $(this).attr("id");
                            dropZone = dropZone.replace("inside", "");
                            if (selectedShape == dropZone) {
                                $("#" + selectedShape).draggable("disable");
                                checkShapeStatus();
                            } else {
                                alert("Wrong choice!");
                            }
                        }
                    });
                });

                function checkShapeStatus() {
                    var counter = 0;
                    $(".selectable").each(function () {
                        var $thisId = $(this);
                        var booleanValue = $thisId.draggable('option', 'disabled');
                        if (booleanValue) {
                            counter = counter + 1;
                        }
                    });
                    if (counter === 4) {
                        $("#centerText").text('You win!');
                        $("#centerText").fadeIn(1000).fadeOut(1000).fadeIn(1000).fadeOut(1000).fadeIn(1000);
                    }
                }
            </script>
        </section>
    </div>
</body>
</html>

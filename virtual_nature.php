<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Nature Nook</title>
    <style>
        /* Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            text-align: center;
            color: #2c3e50;
        }

        h1 {
            color: #1abc9c;
        }

        /* Map Styling */
        .map-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .map-item {
            width: 150px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .map-item:hover {
            transform: scale(1.05);
            background: #f1f1f1;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            color: #e74c3c;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Virtual Nature Nook</h1>
    <p>Explore different nature zones and learn about the environment!</p>

    <!-- Map Container -->
    <div class="map-container">
        <div class="map-item" onclick="openZone('forest')">
            <h3>Forest</h3>
        </div>
        <div class="map-item" onclick="openZone('ocean')">
            <h3>Ocean</h3>
        </div>
        <div class="map-item" onclick="openZone('desert')">
            <h3>Desert</h3>
        </div>
    </div>

    <!-- Modal for displaying content -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">✖</span>
            <h2 id="zone-title"></h2>
            <p id="zone-description"></p>
            <button onclick="playSound()">Hear Nature Sounds</button>
        </div>
    </div>

    <script>
        // Zone information
        const zones = {
            forest: {
                title: "Forest",
                description: "Welcome to the forest! The forest is home to many animals like birds, squirrels, and deer. Trees provide shelter and food.",
                sound: new Audio('forest-sound.mp3') // Replace with actual sound file path
            },
            ocean: {
                title: "Ocean",
                description: "Welcome to the ocean! The ocean is filled with fascinating creatures like fish, dolphins, and sea turtles. The waves are peaceful and calm.",
                sound: new Audio('ocean-75393.mp3') // Replace with actual sound file path
            },
            desert: {
                title: "Desert",
                description: "Welcome to the desert! The desert is home to cacti, camels, and various reptiles. It is hot during the day and cool at night.",
                sound: new Audio('desert-sound.mp3') // Replace with actual sound file path
            }
        };

        let currentSound;

        // Open the modal with zone content
        function openZone(zone) {
            const modal = document.getElementById('modal');
            const zoneData = zones[zone];
            document.getElementById('zone-title').textContent = zoneData.title;
            document.getElementById('zone-description').textContent = zoneData.description;
            modal.style.display = 'flex';

            // Set the current sound
            currentSound = zoneData.sound;
        }

        // Close the modal
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
            if (currentSound) currentSound.pause();
        }

        // Play nature sound
        function playSound() {
            if (currentSound) {
                currentSound.currentTime = 0; // Reset sound to the beginning
                currentSound.play();
            }
        }

        // Close modal when clicking outside content
        window.onclick = function(event) {
            const modal = document.getElementById('modal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>

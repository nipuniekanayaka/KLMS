<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Storybooks - Nature and Conservation</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            padding: 30px;
            background: linear-gradient(135deg, #76c7c0, #ffe066);
            color: #333;
        }

        /* Main container styling */
        .main-container {
            max-width: 900px;
            padding: 20px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Section title styling */
        h1, h2 {
            color: #76c7c0;
            margin-bottom: 20px;
        }

        /* Story grid */
        .story-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        /* Story item box styling */
        .story-item {
            flex: 1 1 250px;
            max-width: 250px;
            padding: 20px;
            background: #fefefe;
            border: 2px solid #ffe066;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .story-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Story item title */
        .story-item h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #76c7c0;
        }

        /* Story button */
        .story-item button {
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            background-color: #76c7c0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .story-item button:hover {
            background-color: #54a8a2;
        }

        /* Modal styling */
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
            z-index: 1000;
        }

        .modal-content {
            width: 90%;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: left;
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

        /* Story text styling */
        #story-content {
            font-size: 16px;
            line-height: 1.6;
            margin-top: 10px;
        }

        /* Question and answer styling */
        .question-section {
            margin-top: 20px;
        }

        .question-section button {
            padding: 8px 12px;
            margin-top: 10px;
            font-size: 14px;
            color: #fff;
            background-color: #76c7c0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .question-section button:hover {
            background-color: #54a8a2;
        }

        .congratulations-message {
            color: #4CAF50;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Interactive Storybooks - Nature and Conservation</h1>

        <section>
            <h2>Select a Story</h2>
            <div class="story-grid">
                <div class="story-item">
                    <h3>The Little Seed's Journey</h3>
                    <button onclick="showStory('The Little Seed\'s Journey')">Read Story</button>
                </div>
                <div class="story-item">
                    <h3>The Recycling Adventure</h3>
                    <button onclick="showStory('The Recycling Adventure')">Read Story</button>
                </div>
                <div class="story-item">
                    <h3>Water's Great Adventure</h3>
                    <button onclick="showStory('Water\'s Great Adventure')">Read Story</button>
                </div>
                <div class="story-item">
                    <h3>Forest Friends Save the Day</h3>
                    <button onclick="showStory('Forest Friends Save the Day')">Read Story</button>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for displaying story content and question -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">✖</span>
            <h2 id="story-title"></h2>
            <div id="story-content"></div>
            <div class="question-section">
                <p id="question"></p>
                <button onclick="checkAnswer()">Answer</button>
                <p id="congratulations-message" class="congratulations-message"></p>
            </div>
        </div>
    </div>

    <script>
        // Pre-defined story content and questions
        const stories = {
            "The Little Seed's Journey": {
                text: `
                    Once upon a time, a tiny seed fell to the ground. With sunlight, water, and a little bit of care,
                    it began to grow into a beautiful tree. The little seed learned about the importance of patience,
                    growth, and giving back to nature as it spread its branches wide.
                `,
                question: "What helped the little seed grow into a tree?",
                correctAnswer: "sunlight and water"
            },
            "The Recycling Adventure": {
                text: `
                    Lucy and Leo, the recycling superheroes, go on an adventure to collect plastic bottles, cans,
                    and paper around their neighborhood. They show their friends how recycling helps the planet
                    and keeps it clean.
                `,
                question: "What did Lucy and Leo collect to recycle?",
                correctAnswer: "plastic bottles, cans, and paper"
            },
            "Water's Great Adventure": {
                text: `
                    Drop, the water droplet, goes on an exciting journey through the water cycle, traveling from
                    rivers to clouds and back again! Along the way, Drop learns about conservation and the importance
                    of keeping water clean.
                `,
                question: "What does Drop the water droplet learn about?",
                correctAnswer: "conservation"
            },
            "Forest Friends Save the Day": {
                text: `
                    A group of forest animals notice that litter is piling up in their home. They work together to
                    clean up the forest and spread the message about the importance of keeping nature beautiful
                    and litter-free.
                `,
                question: "What do the forest friends clean up?",
                correctAnswer: "litter"
            }
        };

        function showStory(title) {
            const story = stories[title];
            document.getElementById('story-title').textContent = title;
            document.getElementById('story-content').innerText = story.text;
            document.getElementById('question').textContent = story.question;
            document.getElementById('congratulations-message').textContent = "";
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function checkAnswer() {
            const title = document.getElementById('story-title').textContent;
            const answer = prompt("Type your answer here:");
            const correctAnswer = stories[title].correctAnswer;

            if (answer.toLowerCase() === correctAnswer) {
                document.getElementById('congratulations-message').textContent = "Congratulations! You got it right!";
            } else {
                document.getElementById('congratulations-message').textContent = "Try again!";
            }
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('modal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>

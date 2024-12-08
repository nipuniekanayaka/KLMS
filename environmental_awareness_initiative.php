<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature and Conservation Learning</title>
    <style>
        /* Basic Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            margin-bottom: 20px;
        }

        h1, h2 {
            background-image: linear-gradient(135deg, #6699ff, #cc99ff);
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 20px;
        }

        .nav-button {
            padding: 10px 15px;
            color: #fff;
            background-color: #76c7c0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 10px;
        }

        .nav-button:hover { background-color: #54a8a2; }

        .story-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            display: none;
        }

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

        .story-item:hover { transform: translateY(-5px); box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); }

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

        .close-btn { position: absolute; top: 10px; right: 15px; font-size: 20px; color: #e74c3c; cursor: pointer; }

        .quiz-container, .progress-container {
            max-width: 350px;
            padding: 20px;
            margin: 10px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
            display: none;
        }

        .quiz-button {
            width: 80%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            color: #fff;
            background: #56ab2f;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .quiz-button:hover { background: #4c992c; }

        #answer-input {
            width: 80%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .submit-button {
            width: 40%;
            padding: 10px;
            margin-top: 10px;
            color: #fff;
            background-color: #76c7c0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-button:hover { background-color: #54a8a2; }

        #correct-answer { font-size: 16px; margin-top: 10px; color: #e74c3c; display: none; }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Nature and Conservation Learning</h1>
        <button class="nav-button" onclick="showStories()">Interactive Storybooks</button>
        <button class="nav-button" onclick="showQuiz()">Environmental Quiz</button>
    </div>

    <!-- Interactive Storybooks Section -->
    <section class="story-grid" id="story-section">
        <h2>Select a Story</h2>
        <div class="story-item">
            <h3>The Little Seed's Journey</h3>
            <button class="nav-button" onclick="showStory('The Little Seed\'s Journey')">Read Me</button>
        </div>
        <div class="story-item">
            <h3>The Recycling Adventure</h3>
            <button class="nav-button" onclick="showStory('The Recycling Adventure')">Read Me</button>
        </div>
	<div class="story-item">
            <h3>Water's Great Adventure</h3>
            <button class="nav-button" onclick="showStory('Water\'s Great Adventure')">Read Me</button>
        </div>
	<div class="story-item">
            <h3>Forest Friends Save the Day</h3>
            <button class="nav-button" onclick="showStory('Forest Friends Save the Day')">Read Me</button>
        </div>
    </section>

    <!-- Modal for displaying story content and question -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">✖</span>
            <h2 id="story-title"></h2>
            <div id="story-content"></div>
            <p id="story-question"></p>
            <input type="text" id="answer-input" placeholder="Type your answer here..." />
            <button class="submit-button" onclick="checkTypedAnswer()">Submit Answer</button>
            <p id="correct-answer"></p>
        </div>
    </div>

    <!-- Quiz Container -->
    <div class="quiz-container" id="quiz-container">
        <h1 class="quiz-title">Environmental Quiz</h1>
        <h2 id="quiz-question"></h2> <!-- Unique ID for quiz question -->
        <button class="quiz-button" id="option1" onclick="checkAnswer(0)">Option 1</button>
        <button class="quiz-button" id="option2" onclick="checkAnswer(1)">Option 2</button>
        <p id="result"></p>
        <p id="points">Points: 0</p>
        <p id="badge">Badge: None</p>
    </div>

    <script>
        const stories = {
            "The Little Seed's Journey": {
                text: "Once upon a time, a little seed dreamed of becoming a big tree. It started its journey through the soil, facing challenges like rock and weeds ",
                question: "What did the little seed want to become?",
                correctAnswer: "a big tree"
            },
            "The Recycling Adventure": {
                text: "Lucy and Leo went on a mission to clean up their neighborhood...",
                question: "What did Lucy and Leo collect on their adventure?",
                correctAnswer: "bottles, papers, and cans"
            },
	    "Water's Great Adventure": {
                text: `
                    Water travels through rivers and oceans, helping plants and animals along the way. One day, it
                    met a thirsty flower and decided to help it grow. The flower bloomed brightly, thanks to water's
                    journey through nature.
                `,
                question: "Who did water help on its journey?",
                correctAnswer: "a thirsty flower"
            },
	    "Forest Friends Save the Day": {
                text: `
                    When a fire broke out in the forest, all the animals came together. They used teamwork to put
                    out the flames and protect their home. The forest learned that with friendship and teamwork, they
                    could overcome any challenge.
                `,
                question: "What did the animals use to save the forest?",
                correctAnswer: "teamwork"
            }
        };

        const questions = [
            { question: "Which of the following is a renewable resource?", options: ["Coal", "Solar Energy"], answer: 1 },
            { question: "What is the main greenhouse gas?", options: ["Oxygen", "Carbon Dioxide"], answer: 1 }
        ];

        let currentStory;
        let points = 0;
        let currentQuestionIndex;

        function showStories() {
            document.getElementById('story-section').style.display = 'flex';
            document.getElementById('quiz-container').style.display = 'none';
        }

        function showStory(story) {
            currentStory = story;
            document.getElementById('story-title').innerText = story;
            document.getElementById('story-content').innerText = stories[story].text;
            document.getElementById('story-question').innerText = stories[story].question;
            document.getElementById('modal').style.display = 'flex';
            document.getElementById('correct-answer').style.display = 'none';
            document.getElementById('answer-input').value = '';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function showQuiz() {
            document.getElementById('story-section').style.display = 'none';
            document.getElementById('quiz-container').style.display = 'block';
            loadQuestion();
        }

        function loadQuestion() {
            currentQuestionIndex = Math.floor(Math.random() * questions.length);
            const currentQuestion = questions[currentQuestionIndex];
            document.getElementById('quiz-question').innerText = currentQuestion.question;
            document.getElementById('option1').innerText = currentQuestion.options[0];
            document.getElementById('option2').innerText = currentQuestion.options[1];
            document.getElementById('option1').dataset.answer = currentQuestion.answer === 0 ? 'true' : 'false';
            document.getElementById('option2').dataset.answer = currentQuestion.answer === 1 ? 'true' : 'false';
        }

        function checkAnswer(option) {
            const selectedAnswer = option === 0 ? 'option1' : 'option2';
            const isCorrect = document.getElementById(selectedAnswer).dataset.answer === 'true';
            document.getElementById('result').innerText = isCorrect ? 'Correct!' : 'Try again!';
            if (isCorrect) { points++; }
            document.getElementById('points').innerText = `Points: ${points}`;
        }

        function checkTypedAnswer() {
            const userAnswer = document.getElementById('answer-input').value.toLowerCase();
            const correctAnswer = stories[currentStory].correctAnswer.toLowerCase();
            if (userAnswer === correctAnswer) {
                document.getElementById('correct-answer').innerText = "Correct answer!";
                points++;
            } else {
                document.getElementById('correct-answer').innerText = `Correct answer is: ${correctAnswer}`;
            }
            document.getElementById('correct-answer').style.display = 'block';
            document.getElementById('points').innerText = `Points: ${points}`;
        }
    </script>
</body>
</html>

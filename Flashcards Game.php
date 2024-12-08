<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multilingual Memory Game for Kids</title>
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #4CAF50;
        }
        .game-info {
            font-size: 18px;
            margin: 10px 0;
        }
        .language-selector select, .reset-btn {
            font-size: 18px;
            padding: 8px;
            border-radius: 5px;
            margin: 5px;
        }
        .game-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .flashcard {
            border: 2px solid #ccc;
            width: 100px;
            height: 100px;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 10px;
            background-color: #fff;
            transition: background-color 0.3s;
            color: #333;
            text-align: center;
        }
        .flashcard.hidden {
            background-color: #eee;
            color: transparent;
        }
        .flashcard.correct {
            background-color: #a5d6a7;
            color: white;
        }
        #feedback, #timer, #score {
            font-size: 20px;
            margin-top: 10px;
        }
        .reset-btn:hover {
            background-color: #ff7043;
        }
    </style>
</head>
<body>

<h1>🌍 Multilingual Memory Game 🌍</h1>

<div class="game-info">
    <label for="languageSelect">Choose Language:</label>
    <select id="languageSelect" onchange="startGame()">
        <option value="en">English</option>
        <option value="es">Spanish</option>
        <option value="fr">French</option>
        <option value="de">German</option>
    </select>
</div>

<div class="game-info">
    <p id="level-info">Level: 1</p>
    <p id="score-info">Score: 0</p>
    <p id="timer">Time Left: 30s</p>
</div>

<div id="flashcards" class="game-container"></div>

<div id="feedback"></div>
<button class="reset-btn" onclick="startGame()">Restart Game 🔄</button>

<script>
    const translations = {
        en: [
            { word: 'apple', img: 'images/apple.png' },
            { word: 'banana', img: 'images/banana.png' },
            { word: 'cat', img: 'images/cat.png', }
        ],
        es: [
            { word: 'manzana', img: 'https://via.placeholder.com/100?text=Manzana' },
            { word: 'plátano', img: 'https://via.placeholder.com/100?text=Plátano' },
            { word: 'gato', img: 'https://via.placeholder.com/100?text=Gato' }
        ],
        fr: [
            { word: 'pomme', img: 'https://via.placeholder.com/100?text=Pomme' },
            { word: 'banane', img: 'https://via.placeholder.com/100?text=Banane' },
            { word: 'chat', img: 'https://via.placeholder.com/100?text=Chat' }
        ],
        de: [
            { word: 'apfel', img: 'https://via.placeholder.com/100?text=Apfel' },
            { word: 'banane', img: 'https://via.placeholder.com/100?text=Banane' },
            { word: 'katze', img: 'https://via.placeholder.com/100?text=Katze' }
        ]
    };

    let level = 1;
    let score = 0;
    let timerInterval;
    let timeLeft = 30;
    let currentLanguage = 'en';
    let selectedCards = [];
    
    function startGame() {
        clearInterval(timerInterval);
        currentLanguage = document.getElementById("languageSelect").value;
        score = 0;
        level = 1;
        loadLevel();
    }

    function loadLevel() {
        document.getElementById("level-info").innerText = `Level: ${level}`;
        document.getElementById("score-info").innerText = `Score: ${score}`;
        document.getElementById("feedback").innerText = "";
        timeLeft = 30 + (level * 10); // Increase time with levels
        document.getElementById("timer").innerText = `Time Left: ${timeLeft}s`;
        displayFlashcards();
        startTimer();
    }

    function displayFlashcards() {
        const flashcardsContainer = document.getElementById("flashcards");
        flashcardsContainer.innerHTML = "";
        selectedCards = [];
        const levelData = translations[currentLanguage].slice(0, level + 1); // Add more words per level
        const cards = [...levelData, ...levelData]; // Duplicate for pairs
        shuffle(cards);

        cards.forEach(item => {
            const flashcard = document.createElement('div');
            flashcard.classList.add('flashcard', 'hidden');
            flashcard.dataset.word = item.word;
            flashcard.innerHTML = `<img src="${item.img}" alt="${item.word}" width="80">`;
            flashcard.addEventListener('click', () => flipCard(flashcard));
            flashcardsContainer.appendChild(flashcard);
        });

        // Show cards briefly before hiding
        setTimeout(() => document.querySelectorAll('.flashcard').forEach(card => card.classList.add('hidden')), 2000);
    }

    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function flipCard(card) {
        if (selectedCards.length < 2 && !card.classList.contains('correct')) {
            card.classList.toggle('hidden');
            selectedCards.push(card);

            if (selectedCards.length === 2) {
                setTimeout(checkMatch, 500);
            }
        }
    }

    function checkMatch() {
        const [card1, card2] = selectedCards;
        if (card1.dataset.word === card2.dataset.word) {
            card1.classList.add('correct');
            card2.classList.add('correct');
            score += 10 * level; // Increase score with level multiplier
            document.getElementById("score-info").innerText = `Score: ${score}`;
            displayFeedback("Great job!", "green");
            if (document.querySelectorAll('.flashcard:not(.correct)').length === 0) {
                levelUp();
            }
        } else {
            card1.classList.add('hidden');
            card2.classList.add('hidden');
            displayFeedback("Try again!", "red");
        }
        selectedCards = [];
    }

    function displayFeedback(message, color) {
        const feedback = document.getElementById("feedback");
        feedback.textContent = message;
        feedback.style.color = color;
    }

    function levelUp() {
        clearInterval(timerInterval);
        level += 1;
        setTimeout(() => {
            document.getElementById("feedback").innerText = `Level Up! Level ${level}`;
            loadLevel();
        }, 1000);
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            timeLeft -= 1;
            document.getElementById("timer").innerText = `Time Left: ${timeLeft}s`;
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                endGame();
            }
        }, 1000);
    }

    function endGame() {
        document.getElementById("feedback").innerText = "Time's up! Game over!";
        document.querySelectorAll(".flashcard").forEach(card => card.classList.add("hidden"));
    }

    // Start the game on initial load
    startGame();
</script>

</body>
</html>

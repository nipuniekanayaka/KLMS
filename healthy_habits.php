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
  <title>Hygiene Heroes - Stay Clean, Stay Healthy!</title>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
 <style>
    body {
  font-family: 'Comic Sans MS', sans-serif;
  background-color: #f3f4ed;
  text-align: center;
  margin: 0;
  padding: 20px;
}

h1 {
  font-size: 36px;
  color: #ff6f61;
  margin-top: 20px;
  animation: bounce 2s infinite;
}

p {
  font-size: 18px;
  color: #4f4f4f;
}

.video-container {
  margin: 20px auto;
  padding: 20px;
  background-color: #fff3e0;
  border-radius: 20px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.quiz-options {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-top: 20px;
}

.quiz-btn {
  font-size: 18px;
  padding: 15px;
  background-color: #ffcc80;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: transform 0.3s, background-color 0.3s;
}

.quiz-btn:hover {
  background-color: #ffa726;
  transform: scale(1.05);
}

#feedback {
  font-size: 22px;
  margin-top: 20px;
  color: #388e3c;
  animation: fadeIn 1s;
}

.hidden {
  display: none;
}

#restart-section {
  margin-top: 20px;
}

.restart-btn {
  font-size: 20px;
  padding: 10px 20px;
  background-color: #ff8a65;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
}

.restart-btn:hover {
  background-color: #ff7043;
  transform: scale(1.1);
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-20px);
  }
  60% {
    transform: translateY(-10px);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

 </style>
</head>
<body>
  <h1>🦸‍♂️🦸‍♀️ Welcome to Hygiene Heroes! 🦸‍♂️🦸‍♀️</h1>
  <p>Watch the video below to learn how you can be a Hygiene Hero by fighting germs with good habits! 💪</p>

  <!-- Video Section -->
  <div class="video-container">
    <video id="hygiene-video" width="600" controls>
      <source src="hygiene-heroes.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>

  <!-- Quiz Section (Hidden initially) -->
  <div id="quiz-section" class="hidden">
    <h2>🧼 What can you do to stay clean and healthy? 🧼</h2>
    <div class="quiz-options">
      <button class="quiz-btn" onclick="checkAnswer('correct')">Wash your hands regularly 👍</button>
      <button class="quiz-btn" onclick="checkAnswer('incorrect')">Eat candy all day 🍬</button>
      <button class="quiz-btn" onclick="checkAnswer('incorrect')">Never brush your teeth 😬</button>
      <button class="quiz-btn" onclick="checkAnswer('correct')">Cover your mouth when you sneeze 🤧</button>
    </div>
  </div>

  <!-- Feedback Section -->
  <div id="feedback" class="hidden"></div>

  <!-- Restart Quiz Button -->
  <div id="restart-section" class="hidden">
    <button onclick="restartQuiz()" class="restart-btn">Restart Quiz 🚀</button>
  </div>

  <script>
    // Listen for when the video ends and show the quiz
document.getElementById("hygiene-video").addEventListener("ended", function() {
  document.getElementById("quiz-section").classList.remove("hidden");
});

// Handle quiz answers
function checkAnswer(answer) {
  const feedback = document.getElementById("feedback");

  if (answer === 'correct') {
    feedback.innerHTML = "🎉 Great job! You're a Hygiene Hero! 🎉";
    feedback.style.color = "#4caf50"; // Green for correct
  } else {
    feedback.innerHTML = "😅 Oops! That's not the best habit. Try again!";
    feedback.style.color = "#f44336"; // Red for incorrect
  }

  // Show feedback and restart button
  feedback.classList.remove("hidden");
  document.getElementById("restart-section").classList.remove("hidden");
}

// Restart the quiz
function restartQuiz() {
  // Hide feedback and restart button, reset quiz section
  document.getElementById("feedback").classList.add("hidden");
  document.getElementById("restart-section").classList.add("hidden");
  document.getElementById("quiz-section").classList.add("hidden");
  document.getElementById("hygiene-video").currentTime = 0; // Reset video
  document.getElementById("hygiene-video").play(); // Replay the video
}
  </script>
</body>
</html>


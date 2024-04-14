<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do Nothing Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }
        #message {
            font-size: 1.5rem;
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
        #restartButton {
            background-color: #fff;
            border: 2px solid #333;
            color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            display: none; /* Initially hide the restart button */
        }
        #restartButton:hover {
            background-color: #333;
            color: #fff;
        }
        #timer {
            font-size: 1.2rem;
            color: #333;
            margin-top: 10px;
        }
        img.fun-image {
            max-width: 400px; /* Adjusted max-width */
            border-radius: 10px;
            margin-top: 30px;
        }
        #leaderboardButton {
            background-color: #fff;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 20px;
        }
        #scoreForm {
            display: none; /* Initially hide the score submission form */
            margin-top: 20px;
        }
        #scoreForm input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #333;
            margin-right: 10px;
        }
        #scoreForm input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        #elapsedTimeDisplay {
            font-size: 1rem;
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <button id="leaderboardButton">View Leaderboard</button>
    <div id="message"></div>
    <div id="timer">00:00:00</div>
    <a href="nothing.php" id="restartButton">Restart</a>
    <div id="scoreForm">
        <form id="submitScoreForm" action="adduser.php" method="post" target="_blank">
            <input type="text" id="user_name" name="username" placeholder="Enter your username" required>
            <input type="text" id="elapsedTimeDisplay" readonly> <!-- Display elapsed time -->
            <input type="hidden" id="score" name="score">
            <input type="hidden" id="elapsedTime" name="elapsedTime"> <!-- Add hidden input for elapsedTime -->
            <input type="submit" value="Submit">
        </form>
    </div>
    <img src="https://ichef.bbci.co.uk/news/976/cpsprodpb/16620/production/_91408619_55df76d5-2245-41c1-8031-07a4da3f313f.jpg" alt="A relaxing beach scene" class="fun-image">

    <script>
        let startTime;
        let timerInterval;
        let lost = false;

        function startTimer() {
            startTime = Date.now();
            timerInterval = setInterval(updateTime, 1000);
        }

        function updateTime() {
            const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
            const hours = Math.floor(elapsedTime / 3600);
            const minutes = Math.floor((elapsedTime % 3600) / 60);
            const seconds = elapsedTime % 60;
            document.getElementById('timer').textContent = `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`;
            document.getElementById('score').value = elapsedTime;
            document.getElementById('elapsedTime').value = elapsedTime; // Update elapsedTime input value
            document.getElementById('elapsedTimeDisplay').value = `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`; // Display elapsed time
        }

        function padZero(num) {
            return num.toString().padStart(2, '0');
        }

        function lostGame() {
            if (!lost) {
                lost = true;
                clearInterval(timerInterval);
                const message = document.getElementById('message');
                const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
                message.textContent = `Sorry, you lost, you did nothing for ${elapsedTime} seconds.`;
                message.style.display = 'block';
                document.getElementById('restartButton').style.display = 'inline'; // Display the restart button
                document.getElementById('scoreForm').style.display = 'block'; // Display the score submission form
            }
        }

        function resetGame() {
            lost = false;
            clearInterval(timerInterval);
            document.getElementById('message').style.display = 'none';
            document.getElementById('message').textContent = '';
            document.getElementById('timer').textContent = '00:00:00';
            document.getElementById('restartButton').style.display = 'none'; // Hide the restart button
            document.getElementById('scoreForm').style.display = 'none'; // Hide the score submission form
            startTimer();
        }

        // Start the timer when the page loads
        startTimer();

        // Event listeners for user actions
        window.addEventListener('mousemove', lostGame);
        window.addEventListener('keydown', function(event) {
            lostGame();
        });
        window.addEventListener('click', lostGame);
        window.addEventListener('touchstart', lostGame);
        window.addEventListener('scroll', lostGame);
        window.addEventListener('blur', lostGame); // Detects when the user switches tabs or windows

        // Placeholder for leaderboard button functionality
        document.getElementById('leaderboardButton').addEventListener('click', function() {
            window.location.href = 'listleaderboard.php';
        });

        // Event listener for restart button
        document.getElementById('restartButton').addEventListener('click', resetGame);

        // No need for event listener for score submission form as the action is already defined
    </script>
</body>
</html>

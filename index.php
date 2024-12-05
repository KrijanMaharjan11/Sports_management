<?php
// include 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sports Management System</title>
    <style>
        /* CSS styles for the page */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .container2 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .sport-item {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
        }

        .sport-name {
            font-size: 18px;
            font-weight: bold;
        }

        .sport-description {
            margin-top: 5px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="header">
        <?php include 'header.php'; ?>
    </div>
    <div class="container2">
        <img src="home.jpg" alt="" width="800px" height="500px">
        <br><br>
        <div class="sport-item">
            <div class="sport-name">Football</div>
            <div class="sport-description">Football is a popular team sport played with a spherical ball between two teams of eleven players.</div>
        </div>

        <div class="sport-item">
            <div class="sport-name">Basketball</div>
            <div class="sport-description">Basketball is a team sport played on a rectangular court where two teams compete to score points by shooting a ball through the opponent's hoop.</div>
        </div>

        <div class="sport-item">
            <div class="sport-name">Tennis</div>
            <div class="sport-description">Tennis is an individual or doubles sport played on a court where players use a stringed racket to hit a ball over a net into the opponent's side of the court.</div>
        </div>

        <div class="sport-item">
            <div class="sport-name">Chess</div>
            <div class="sport-description">Chess is a strategic board game played between two players. It involves critical thinking and planning to outmaneuver and checkmate the opponent's king.</div>
        </div>

        <div class="sport-item">
            <div class="sport-name">Cricket</div>
            <div class="sport-description">Cricket is a bat-and-ball game played between two teams. It is popular in many countries and involves scoring runs and taking wickets to win the match.</div>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
<?php

include 'session.php';
require 'init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management System - Sports</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            padding: 10px;
            background-color: #757a79;
        }

        nav {
            background-color: #333;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            flex: 1;
        }

        nav ul li a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 15px;
            text-align: center;
        }

        nav ul li a:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sports Management System</h1>
    </div>

    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="admin_sports.php">Sports</a></li>
            <li><a href="admin_tournament.php">Tournaments</a></li>
            <li><a href="view_feedback.php">Feedback</a></li>
            <!-- <li><a href="#">Players</a></li> -->
            <li><a href="schedule.php">Schedule</a></li>
            <li><a href="result.php">Results</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>


</body>

</html>
<?php

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

        .content {
            padding: 20px;
            border: 2px solid black;
            width: fit-content;
            height: fit-content;
            margin-left: 27rem;
            margin-top: 30px;
        }

        .form-container {
            display: flex;
            margin-bottom: 20px;
        }

        .form-container input[type="text"] {
            padding: 10px;
            width: 200px;
            margin-right: 10px;
        }

        .form-container input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .sports-list {
            margin-bottom: 20px;
        }

        .sports-list li {
            margin-bottom: 5px;
        }

        .sports-list li:last-child {
            margin-bottom: 0;
        }

        .delete-form {
            display: flex;

        }

        .delete-form select {
            padding: 10px;
            width: 200px;
            margin-right: 10px;
        }

        .delete-form input[type="submit"] {
            padding: 10px;
            background-color: #f44336;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include 'admin_nav.php'; ?>
    </div>

    <div class="content">
        <h2>Add Sport</h2>
        <div class="form-container">
            <form action="add_sports.php" method="post">
                <input type="text" name="sport_name" placeholder="Sport Name" required>
                <input type="submit" value="Add Sport">
            </form>
        </div>

        <h2>Delete Sport</h2>
        <div class="delete-form">
            <form action="remove_sports.php" method="post">
                <select name="sport_id" required>
                    <option value="">Select Sport</option>
                    <?php
                    $query = "SELECT * FROM sports";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['s_id'] . '">' . $row['s_name'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Remove Sport" name="remove">
            </form>
        </div>

        <h2>Current Sports</h2>
        <ul class="sports-list">
            <?php
            $query = "SELECT * FROM sports";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li>' . $row['s_name'] . '</li>';
            }
            ?>
        </ul>
    </div>
</body>

</html>
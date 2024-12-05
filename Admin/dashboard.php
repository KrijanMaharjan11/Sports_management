<?php
require 'init.php';
$no_of_sports = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM sports"));
$no_of_tournament = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM tournament"));
$no_of_schedule = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM schedule"));
$no_of_result = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM result"));
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

        .container-2 {
            text-align: center;
            padding: 10px;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 5rem;
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

        .box {
            width: calc(25% - 40px);
            margin: 20px;
            padding: 20px;
            background-color: #757a79;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            color: white;
            text-decoration: none;
        }

        .box h3 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .box a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 800;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include 'admin_nav.php'; ?>
    </div>
    <div class="container-2">
        <div class="content">
            <div class="box">

                <a href="admin_sports.php">
                    <?php
                    echo '<h3>Sports:<br>  ' . $no_of_sports[0] . '</h3>';

                    ?>

            </div>
            <div class="box">
                <a href="admin_tournament.php">
                    <?php
                    echo '<h3>Tournament:<br>  ' . $no_of_tournament[0] . '</h3>';

                    ?>

            </div>
            <div class="box">
                <a href="schedule.php">
                    <?php
                    echo '<h3>Schedule:<br>  ' . $no_of_schedule[0] . '</h3>';

                    ?>

            </div>
            <div class="box">
                <a href="result.php">
                    <?php
                    echo '<h3>Result:<br>  ' . $no_of_result[0] . '</h3>';

                    ?>

            </div>
            <div class="box">
                <a href="registered_team.php">
                    <?php
                    echo '<h3>Registration list:</h3>';

                    ?>

            </div>
        </div>
    </div>
</body>

</html>
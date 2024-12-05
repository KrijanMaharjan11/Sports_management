<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
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
            <li><a href="index.php">Home</a></li>
            <li><a href="sports.php">Sports</a></li>

            <li><a href="tournament.php">Tournament</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="schedule.php">Schedule</a></li>
            <li><a href="result.php">Results</a></li>
            <?php
            session_start();
            include 'Admin/init.php';

            if (empty($_SESSION['username'])) {
                echo '<li><a href="login.php">Login</a></li>';
            } else {
                echo '<li>
                <form action="logout.php" method="POST">
                    <a href="logout.php"name="logout" >Logout</a>
                </form>
                </li>';
            }
            ?>

        </ul>
    </nav>
</body>

</html>
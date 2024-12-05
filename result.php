<?php

require 'Admin/init.php';


$sql = "SELECT * FROM result";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo "<div class='header'>";
    include 'header.php';
    echo "</div>";

    echo "<div class='container'>";

    // Start the grid container
    echo "<div class='schedule-grid'>";

    // Loop through each row and display data
    while ($row = mysqli_fetch_assoc($result)) {
        $tournamentName = $row['tournament_name'];
        $imagePath = 'Admin/uploads/' . $row['image'];

        // Start a grid item
        echo "<div class='schedule-item'>";
        echo "<h2>Tournament Name: $tournamentName</h2>";
        echo "<img src='$imagePath' alt='Schedule Image' width='600'>";
        echo "</div>";
    }

    // Close the grid container
    echo "</div>";
    echo "</div>";
} else {
    echo "No schedule data found.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management System - Schedule</title>
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

        h2 {
            color: #fff;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            justify-content: center;
        }

        .schedule-item {
            text-align: center;
            border: 2px solid black;
            height: fit-content;
        }

        .upload-form {
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .upload-form input[type="file"] {
            margin-bottom: 10px;
        }

        .upload-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
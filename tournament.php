<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournaments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container-3 {
            /* max-width: 1000px; */
            margin: 0 auto;
            padding: 20px;
        }

        .tournament-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .tournament {
            width: 250px;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 3px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card img {
            max-width: 100%;
            height: 220px;
        }

        .card-content {
            padding: 10px;
            flex-grow: 1;
        }

        .card-title {
            margin: 0;
        }

        .card-text {
            margin: 0;
            margin-bottom: 5px;
        }

        .dates {
            font-weight: bold;
        }

        .registration {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .registration a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }

        .view-details a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <!-- Header section -->
    <div class="header">
        <?php

        include 'header.php'; ?>
    </div>

    <!-- Tournament list section -->
    <div class="container-3">
        <h2>Tournaments</h2>
        <div class="tournament-row">
            <?php
            include("Admin/init.php");

            $sql = "SELECT tournament.tournament_id, tournament.name AS tournament_name, tournament.start_date, tournament.end_date, sports.s_name AS sport_name, tournament.image AS image
                    FROM tournament
                    LEFT JOIN sports ON tournament.s_id = sports.s_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $tournamentId = $row['tournament_id'];
                    $tournamentName = $row['tournament_name'];
                    $startDate = $row['start_date'];
                    $endDate = $row['end_date'];
                    $sportName = $row['sport_name'];
                    $image = $row['image'];

                    echo "<div class='tournament'>";
                    echo "<div class='card'>";
                    if (!empty($image)) {
                        echo "<img src='Admin/uploads/$image' alt='Tournament Image' style='max-width: 100%;'>";
                    } else {
                        echo "<p>No image available.</p>";
                    }
                    echo "<div class='card-content'>";
                    echo "<h3 class='card-title'>$tournamentName</h3>";

                    echo "<p class='card-text'><span class='dates'>Sport:</span> $sportName</p>";
                    echo "<div class='registration'>";
                    echo "<div class='view-details'>";
                    echo "<a href='view_details.php?tournament_id=$tournamentId'>View Details</a>";
                    echo "</div>";
                    if (empty($_SESSION['username'])) {
                        echo "<a href='login.php?em=Please Login First'>Register</a>";
                    } else {
                        echo "<a href='registration.php?tournament_id=$tournamentId'>Register</a>";
                    }

                    echo "</div>";
                    echo "</div>"; // Close card-content
                    echo "</div>"; // Close card
                    echo "</div>"; // Close tournament
                }
            } else {
                echo "<p>No tournaments found.</p>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
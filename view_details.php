<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container-4 {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        .tournament-details {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 3px;
        }

        .tournament-details h3 {
            margin: 0;
        }

        .tournament-details p {
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
    </style>
</head>

<body>
    <div class="header">
        <?php include 'header.php'; ?>
    </div>
    <div class="container-4">

        <h2>Tournament Details</h2>

        <?php
        include("Admin/init.php");

        // Check if the tournament_id parameter is provided in the URL
        if (isset($_GET['tournament_id'])) {
            $tournamentId = $_GET['tournament_id'];

            // Fetch tournament details from the database
            $sql = "SELECT tournament.name AS tournament_name, tournament.tournament_details, tournament.start_date, tournament.end_date, sports.s_name AS sport_name, tournament.image AS image
                    FROM tournament
                    LEFT JOIN sports ON tournament.s_id = sports.s_id
                    WHERE tournament.tournament_id = $tournamentId";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $tournamentName = $row['tournament_name'];
                $tournamentDetails = $row['tournament_details'];
                $startDate = $row['start_date'];
                $endDate = $row['end_date'];
                $sportName = $row['sport_name'];
                $image = $row['image'];

                echo "<div class='tournament-details'>";
                if (!empty($image)) {
                    echo "<img src='Admin/uploads/$image' alt='Tournament Image' style='max-width: 100%;'>";
                } else {
                    echo "<p>No image available.</p>";
                }
                echo "<h3>$tournamentName</h3>";
                echo "<p><span class='dates'>Details:</span> $tournamentDetails</p>";
                echo "<p><span class='dates'>Start Date:</span> $startDate</p>";
                echo "<p><span class='dates'>End Date:</span> $endDate</p>";
                echo "<p><span class='dates'>Sport:</span> $sportName</p>";
                echo "<div class='registration'>";
                if (empty($_SESSION['username'])) {
                    echo "<a href='login.php?em=Please Login First'>Register</a>";
                } else {
                    echo "<a href='registration.php?tournament_id=$tournamentId'>Register</a>";
                }
                echo "</div>";
                echo "</div>";
            } else {
                echo "<p>Tournament not found.</p>";
            }

            mysqli_close($conn);
        } else {
            echo "<p>Invalid tournament ID.</p>";
        }
        ?>

    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
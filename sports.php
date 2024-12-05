<?php
include("Admin/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #bbe9db;
        }

        .no-sports {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="layout">
        <div class="header">
            <?php include('header.php'); ?>
        </div>
        <div class="content">
            <div class="content">
                <?php
                $sql = "SELECT sports.s_name AS s_name, tournament.name AS name
                FROM sports
                LEFT JOIN tournament ON sports.s_id = tournament.s_id
                WHERE tournament.end_date >= CURDATE() OR tournament.end_date IS NULL";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>Sport</th><th>Tournament</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sportName = $row['s_name'];
                        $tournamentName = $row['name'];
                        echo "<tr>";
                        echo "<td>$sportName</td>";
                        echo "<td>";

                        if ($tournamentName) {
                            echo "Ongoing Tournament: $tournamentName";
                        } else {
                            echo "No Tournaments";
                        }

                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo '<p class="no-sports">No sports found.</p>';
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
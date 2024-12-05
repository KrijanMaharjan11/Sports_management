<?php

include 'init.php';


$sql = "SELECT participationdetails.*, tournament.s_id, sports.s_name
FROM participationdetails
LEFT JOIN tournament ON participationdetails.t_id = tournament.tournament_id
LEFT JOIN sports ON tournament.s_id = sports.s_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container-2 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include 'admin_nav.php'; ?>
    </div>
    <div class="container-2">
        <h2>Registered Teams</h2>
        <table>
            <tr>
                <th>Tournament ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Player Details</th>
                <th>Contact</th>
                <th>Sport Name</th>
                <th>Registered At</th>
            </tr>
            <?php

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['t_id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['player_details'] . '</td>';
                echo '<td>' . $row['contact'] . '</td>';
                echo '<td>' . $row['s_name'] . '</td>';
                echo '<td>' . $row['registered_at'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>

</html>
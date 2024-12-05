<!DOCTYPE html>
<html>

<head>
    <title>Tournament Tie Sheet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        .round {
            margin-bottom: 20px;
        }

        .match {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .team {
            padding: 5px 10px;
            background-color: #f2f2f2;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <h2>Tournament Tie Sheet</h2>

    <?php
    $teams = array(
        "Team 1",
        "Team 2",
        "Team 3",
        "Team 4",
        "Team 5",
        "Team 6",
        "Team 7",
        "Team 8"
    );

    // Function to generate the match schedule
    function generateTieSheet($teams)
    {
        $numTeams = count($teams);
        $totalRounds = ($numTeams - 1) * 2;
        $matchesPerRound = $numTeams / 2;
        $tieSheet = array();

        for ($round = 1; $round <= $totalRounds; $round++) {
            $matches = array();

            for ($match = 0; $match < $matchesPerRound; $match++) {
                $home = ($round + $match) % ($numTeams - 1);
                $away = ($numTeams - 1 - $match + $round) % ($numTeams - 1);

                // Account for 0-indexed array
                if ($home == 0) {
                    $home = $numTeams - 1;
                }
                if ($away == 0) {
                    $away = $numTeams - 1;
                }

                $matches[$match] = array(
                    "home" => $teams[$home - 1],
                    "away" => $teams[$away - 1]
                );
            }

            $tieSheet[$round] = $matches;
        }

        return $tieSheet;
    }

    // Generate the tie sheet
    $tieSheet = generateTieSheet($teams);

    // Display the tie sheet
    foreach ($tieSheet as $round => $matches) {
        echo "Round $round:<br>";

        foreach ($matches as $match) {
            echo $match["home"] . " vs " . $match["away"] . "<br>";
        }

        echo "<br>";
    }
    foreach ($tieSheet as $round => $matches) {
        echo '<div class="round">';
        echo "<h3>Round $round</h3>";

        foreach ($matches as $match) {
            echo '<div class="match">';
            echo '<div class="team">' . $match["home"] . '</div>';
            echo '<div class="team">' . $match["away"] . '</div>';
            echo '</div>';
        }

        echo '</div>';
    }
    ?>

</body>

</html>
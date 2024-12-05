<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container4 {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            display: inline-block;
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }
    </style>
</head>

<body>
    <!-- Header section -->
    <div class="header">
        <?php include 'header.php'; ?>
    </div>

    <!-- PHP Code for Tournament Registration -->
    <?php
    include 'Admin/init.php';

    if (isset($_GET['tournament_id'])) {
        $tournamentId = $_GET['tournament_id'];

        // Display the tournament name
        $sql = "SELECT name FROM tournament WHERE tournament_id = $tournamentId";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $tournamentName = $row['name'];
        } else {
            echo "<p>Tournament not found.</p>";
            exit; // Exit to prevent further execution
        }
    } else {
        echo "<p>No tournament selected for registration.</p>";
        exit; // Exit to prevent further execution
    }

    if (isset($_POST['register'])) {
        // Process the form data and store in the database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $playerDetails = $_POST['player-details'];
        $contact = $_POST['contact'];

        // Prepare and execute the SQL statement to insert data into the table
        $sql = "INSERT INTO participationdetails (t_id, name, email, player_details, contact)
         VALUES ('$tournamentId', '$name', '$email', '$playerDetails', '$contact')";
        if ($conn->query($sql) === TRUE) {
            // Display JavaScript alert for success
            echo "<script>alert('Registration successful!');</script>";
        } else {
            // Display JavaScript alert for failure
            echo "<script>alert('Registration failed. Please try again.');</script>";
        }

        $conn->close();
    }
    ?>

    <!-- Tournament registration form -->
    <div class="container4">
        <h2>Tournament Registration</h2>
        <?php
        if (isset($_GET['tournament_id'])) {
            echo "<p>Tournament: $tournamentName</p>";
        ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="player-details">Player Details:</label>
                    <textarea id="player-details" name="player-details" cols="80" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="register" value="Register">
                </div>
            </form>
        <?php
        } else {
            echo "<p>No tournament selected for registration.</p>";
        }
        ?>
    </div>
</body>

</html>
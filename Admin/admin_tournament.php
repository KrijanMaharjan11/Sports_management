<?php


include("init.php");


if (isset($_GET['delete_tournament'])) {
    $tournamentId = $_GET['delete_tournament'];


    $sql = "DELETE FROM tournament WHERE tournament_id = '$tournamentId'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>alert('Tournament deleted successfully.');</script>";
        echo "<script>window.location.href = 'admin_tournament.php';</script>";
    } else {

        echo "<script>alert('Failed to delete the tournament.');</script>";
        echo "<script>window.location.href = 'admin_tournament.php';</script>";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Tournament Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            padding: 10px;
            background-color: #757a79;
        }

        .container img {
            max-width: 200px;
            height: auto;
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

        .container-1 {
            margin-top: 20px;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid black;
            background-color: #f2f2f2;
        }

        .form-input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #45a049;
        }

        .tournament-list {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fff;
        }

        .tournament-list-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .tournament-list-item .tournament-name {
            font-weight: bold;
        }

        .tournament-list-item .delete-button {
            color: red;
            cursor: pointer;
            margin-left: auto;
        }

        .tournament-list-item .edit-button {
            color: blue;
            cursor: pointer;
            margin-left: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include 'admin_nav.php'; ?>
    </div>

    <div class="container-1">
        <h2>Add Tournament</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Add a new file input for image upload -->
            <input type="file" name="tournament_image" class="form-input" required accept="image/*">
            <input type="text" name="tournament_name" placeholder="Tournament Name" class="form-input" required>
            <textarea name="tournament_details" id="" cols="72" rows="0" placeholder="Tournament Details"></textarea>
            <select name="sport_id" class="form-input" required>
                <option value="">Select Sport</option>
                <!-- Fetch sports from the database and populate the options dynamically -->
                <?php
                include("init.php");
                $sql = "SELECT * FROM sports";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $sportId = $row['s_id'];
                    $sportName = $row['s_name'];
                    echo "<option value='$sportId'>$sportName</option>";
                }

                mysqli_close($conn);
                ?>
            </select>
            <label>Starting date</label><br>
            <input type="date" name="start_date" class="form-input" required min="<?php echo date("Y-m-d"); ?>">
            <label>Ending date</label><br>
            <input type="date" name="end_date" class="form-input" required min="<?php echo date("Y-m-d"); ?>">
            <input type="submit" name="add_tournament" value="Add Tournament" class="form-button">
        </form>

        <div class="tournament-list">
            <h2>Tournament List</h2>
            <?php
            include("init.php");

            if (isset($_POST['add_tournament'])) {
                $tournamentName = $_POST['tournament_name'];
                $tournamentDetails = $_POST['tournament_details'];
                $sportId = $_POST['sport_id'];
                $startDate = $_POST['start_date'];
                $endDate = $_POST['end_date'];
                $currentDate = date("Y-m-d");

                // Check if a file was uploaded
                if (isset($_FILES['tournament_image'])) {
                    $file = $_FILES['tournament_image'];

                    // Extract file details
                    $fileName = $file['name'];
                    $fileTmpPath = $file['tmp_name'];
                    $fileSize = $file['size'];
                    $fileError = $file['error'];


                    if ($fileError === UPLOAD_ERR_OK) {

                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                        $newFileName = uniqid() . '.' . $fileExtension;


                        $uploadDir = 'uploads/';


                        $destination = $uploadDir . $newFileName;
                        if (move_uploaded_file($fileTmpPath, $destination)) {

                            // $sql = "INSERT INTO tournament (s_id, name, tournament_details, image, end_date, start_date) 
                            //         VALUES ('$sportId', '$tournamentName', '$tournamentDetails', '$newFileName', '$endDate', '$startDate')";
                            $sql = "INSERT INTO tournament (s_id, name, tournament_details, image, end_date, start_date) 
                            VALUES ('$sportId', '$tournamentName', '$tournamentDetails', '$newFileName', '$endDate', '$currentDate')";

                            if (mysqli_query($conn, $sql)) {
                                echo "<p>Tournament added successfully.</p>";
                            } else {
                                echo "<p>Error: " . mysqli_error($conn) . "</p>";
                            }
                        } else {
                            echo "<p>Failed to move the uploaded file to the destination folder.</p>";
                        }
                    } else {
                        echo "<p>File upload error: $fileError</p>";
                    }
                } else {
                    echo "<p>No file was uploaded.</p>";
                }
            }


            $sql = "SELECT tournament.tournament_id, tournament.name AS tournament_name, sports.s_name AS s_name
                    FROM tournament
                    LEFT JOIN sports ON tournament.s_id = sports.s_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $tournamentId = $row['tournament_id'];
                    $tournamentName = $row['tournament_name'];
                    $sportName = $row['s_name'];
                    echo "<div class='tournament-list-item'>";
                    echo "<span class='tournament-name'>$tournamentName</span>";
                    echo " - Sport: $sportName";
                    echo "<a class='edit-button' href='edit_tournament.php?tournament_id=$tournamentId'>Edit</a>";
                    echo "<span class='delete-button' onclick='delete_tournament($tournamentId)'>Delete</span>";
                    echo "</div>";
                    echo "<script>var tournamentId = $tournamentId;</script>";
                }
            } else {
                echo "<p>No tournaments found.</p>";
            }

            mysqli_close($conn);
            ?>
        </div>

        <script>
            function delete_tournament(tournamentId) {
                if (confirm("Are you sure you want to delete this tournament?")) {
                    window.location.href = "admin_tournament.php?delete_tournament=" + tournamentId;
                }
            }
        </script>

    </div>
</body>

</html>
<?php


include("init.php");

if (isset($_POST['update_tournament'])) {
    $tournamentId = $_POST['tournament_id'];
    $tournamentName = $_POST['tournament_name'];
    $tournamentDetails = $_POST['tournament_details'];
    $sportId = $_POST['sport_id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];


    if (isset($_FILES['tournament_image'])) {
        $file = $_FILES['tournament_image'];

        // Extract file details
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Check for any upload errors
        if ($fileError === UPLOAD_ERR_OK) {
            // Generate a unique filename
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $fileExtension;

            // Specify the destination folder
            $uploadDir = 'uploads/';

            // Move the uploaded file to the destination folder
            $destination = $uploadDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destination)) {
                // File upload successful
                // Update tournament details in the database
                $sql = "UPDATE tournament SET s_id = '$sportId', name = '$tournamentName', tournament_details = '$tournamentDetails',
                        image = '$newFileName', end_date = '$endDate', start_date = '$startDate' WHERE tournament_id = '$tournamentId'";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Tournament updated successfully.');</script>";
                } else {
                    echo "<script>alert('Failed to update the tournament.');</script>";
                }
            } else {
                echo "<script>alert('Failed to move the uploaded file to the destination folder.');</script>";
            }
        } else {
            echo "<script>alert('File upload error: $fileError');</script>";
        }
    } else {
        // Update tournament details without changing the image
        $sql = "UPDATE tournament SET s_id = '$sportId', name = '$tournamentName', tournament_details = '$tournamentDetails',
                end_date = '$endDate', start_date = '$startDate' WHERE tournament_id = '$tournamentId'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Tournament updated successfully.');</script>";
        } else {
            echo "<script>alert('Failed to update the tournament.');</script>";
        }
    }
}

// Retrieve the tournament ID from the query parameters
if (isset($_GET['tournament_id'])) {
    $tournamentId = $_GET['tournament_id'];

    // Fetch tournament details from the database
    $sql = "SELECT * FROM tournament WHERE tournament_id = '$tournamentId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $tournamentName = $row['name'];
        $tournamentDetails = $row['tournament_details'];
        $sportId = $row['s_id'];
        $startDate = $row['start_date'];
        $endDate = $row['end_date'];
    } else {
        echo "<script>alert('Tournament not found.');</script>";
        echo "<script>window.location.href = 'admin_tournament.php';</script>";
    }
} else {
    echo "<script>window.location.href = 'admin_tournament.php';</script>";
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tournament</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid black;
            background-color: #f2f2f2;
        }

        form input[type="text"],
        form textarea,
        form select,
        form input[type="date"],
        form input[type="file"],
        form input[type="submit"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form textarea {
            height: 100px;
            resize: vertical;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include 'admin_nav.php';
        ?>
    </div>
    <h2>Edit Tournament</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Add the form fields with the values retrieved from the database -->
        <input type="hidden" name="tournament_id" value="<?php echo $tournamentId; ?>">
        <input type="text" name="tournament_name" value="<?php echo $tournamentName; ?>" required>
        <textarea name="tournament_details" cols="72" rows="0"><?php echo $tournamentDetails; ?></textarea>
        <select name="sport_id" required>
            <option value="">Select Sport</option>
            <!-- Fetch sports from the database and populate the options dynamically -->
            <?php
            include("init.php");
            $sql = "SELECT * FROM sports";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $sportId = $row['s_id'];
                $sportName = $row['s_name'];
                $selected = ($sportId == $sportId) ? 'selected' : '';
                echo "<option value='$sportId' $selected>$sportName</option>";
            }

            mysqli_close($conn);
            ?>
        </select>
        <label>Starting date</label><br>
        <input type="date" name="start_date" value="<?php echo $startDate; ?>" required min="<?php echo date("Y-m-d"); ?>">
        <label>Ending date</label><br>
        <input type="date" name="end_date" value="<?php echo $endDate; ?>" required min="<?php echo date("Y-m-d"); ?>">
        <input type="file" name="tournament_image" accept="image/*">
        <input type="submit" name="update_tournament" value="Update Tournament">
    </form>
</body>

</html>
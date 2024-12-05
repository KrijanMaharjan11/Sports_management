<?php
require 'init.php';

// User Authentication (You need to implement this)
// Check if the user is logged in or has appropriate permissions
// If not authenticated, redirect to a login page or display an access denied message

// Handle file upload
if (isset($_POST['upload'])) {
    $targetDir = 'uploads/'; // Directory to save uploaded files
    $fileName = basename($_FILES['file']['name']);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    // Check if the uploaded file is a JPG, JPEG, or PNG file
    $allowedTypes = array('jpg', 'jpeg', 'png');
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        echo "<script>alert('Only JPG, JPEG, or PNG files are allowed.');</script>";
    } else {
        // Generate a unique file name to ensure uniqueness
        $uniqueFileName = uniqid() . '_' . $fileName;
        $targetFilePath = $targetDir . $uniqueFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            // Insert the file information into the database
            $tournamentName = mysqli_real_escape_string($conn, $_POST['tournament_name']);
            $sql = "INSERT INTO schedule (image, tournament_name) VALUES ('$uniqueFileName', '$tournamentName')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('File uploaded successfully.'); window.location.href='schedule.php';</script>";
            } else {
                echo "<script>alert('Error recording file information in the database: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    }
}

// Handle delete image
if (isset($_GET['delete'])) {
    // Validate and sanitize the image ID
    $imageId = mysqli_real_escape_string($conn, $_GET['delete']);
    $sql = "SELECT image FROM schedule WHERE sch_id = '$imageId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row['image'];

        // Delete the file from the server
        if (unlink('uploads/' . $imagePath)) {
            // Delete the image record from the database
            $deleteSql = "DELETE FROM schedule WHERE sch_id = '$imageId'";
            if (mysqli_query($conn, $deleteSql)) {
                echo "<script>alert('Image deleted successfully.'); window.location.href='schedule.php';</script>";
            } else {
                echo "<script>alert('Error deleting image: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error deleting image file.');</script>";
        }
    } else {
        echo "<script>alert('Image not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sports Management System - Schedule</title>
        <style>
            /* Reset some default styles */
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            .container-2 {
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

            .uploaded-images {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                margin-top: 20px;
            }

            .uploaded-images .image-container {
                position: relative;
            }

            .uploaded-images .image-container img {
                max-width: 300px;
                height: auto;
            }

            .uploaded-images .image-container .image-actions {
                position: absolute;
                top: 5px;
                right: 5px;
            }

            .uploaded-images .image-container .image-actions a {
                display: inline-block;
                padding: 5px;
                margin-left: 5px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 3px;
            }
        </style>
    </head>

</head>

<body>
    <div class="header">
        <?php include 'admin_nav.php'; ?>
    </div>
    <div class="container-2">
        <div class="upload-form">
            <h2>Upload Schedule</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <input type="text" name="tournament_name" placeholder="Tournament Name" required>
                <input type="submit" name="upload" value="Upload">
            </form>
        </div>
        <div class="uploaded-images">
            <?php
            // Retrieve schedule data from the database
            $sql = "SELECT * FROM schedule";
            $result = mysqli_query($conn, $sql);

            // Check if any rows are returned
            if (mysqli_num_rows($result) > 0) {
                // Loop through each row and display images
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageId = $row['sch_id'];
                    $imagePath = $row['image'];
                    echo "<div class='image-container'>";
                    echo "<img src='uploads/$imagePath' alt='Schedule Image'>";
                    echo "<div class='image-actions'>";
                    echo "<a href='?delete=$imageId'>Delete</a>";
                    // echo "<a href='edit.php?id=$imageId'>Edit</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No schedule images found.";
            }
            ?>
        </div>
    </div>
</body>

</html>
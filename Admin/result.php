<?php
require 'init.php';

if (isset($_POST['upload'])) {
    $targetDir = 'uploads/';
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if ($fileType != 'jpg') {
        echo "Only JPG files are allowed.";
    } else {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            echo "File uploaded successfully.";
            $tournamentName = $_POST['tournament_name'];

            $sql = "INSERT INTO result (image, tournament_name) VALUES ('$fileName', '$tournamentName')";

            if (mysqli_query($conn, $sql)) {
                echo "File information recorded in the database.";
            } else {
                echo "Error recording file information in the database: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading file.";
        }
    }
}

// Handle delete image
if (isset($_GET['delete'])) {
    $imageId = $_GET['delete'];
    $sql = "DELETE FROM result WHERE r_id = '$imageId'";
    if (mysqli_query($conn, $sql)) {
        echo "Image deleted successfully.";
    } else {
        echo "Error deleting image: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management System - Result</title>
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

<body>
    <div class="header">
        <?php include 'admin_nav.php'; ?>
    </div>
    <div class="container">
        <div class="upload-form">
            <h2>Upload Result</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <input type="text" name="tournament_name" placeholder="Tournament Name" required>
                <input type="submit" name="upload" value="Upload">
            </form>
        </div>
        <div class="uploaded-images">
            <?php
            // Retrieve result data from the database
            $sql = "SELECT * FROM result";
            $result = mysqli_query($conn, $sql);

            // Check if any rows are returned
            if (mysqli_num_rows($result) > 0) {
                // Loop through each row and display images
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageId = $row['r_id'];
                    $imagePath = $row['image'];
                    echo "<div class='image-container'>";
                    echo "<img src='uploads/$imagePath' alt='Result Image'>";
                    echo "<div class='image-actions'>";
                    echo "<a href='?delete=$imageId'>Delete</a>";
                    // echo "<a href='edit.php?id=$imageId'>Edit</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No result images found.";
            }
            ?>
        </div>
    </div>
</body>

</html>
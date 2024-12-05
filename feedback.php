<?php
// include 'session.php';

// Include your database connection code here
require 'Admin/init.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert the feedback into the database
    $sql = "INSERT INTO feedback (name, email, Message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Feedback submitted successfully.');</script>";
    } else {
        echo "<script>alert('Error submitting feedback: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Feedback - Sports Management System</title>
    <style>
        /* Custom CSS for Feedback Form */

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container2 {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 10px;
            cursor: pointer;
        }

        .copy-right {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include 'header.php'; ?>
    </div>
    <div class="container2">
        <h1>Feedback</h1>
        <form action="feedback.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>


    <footer>
        <?php include 'footer.php'; ?>
    </footer>


</body>
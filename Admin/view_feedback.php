<?php
// view_feedback.php

// Include your database connection code here
require 'init.php';

if (isset($_GET['delete_feedback'])) {
    $feedbackId = $_GET['delete_feedback'];

    // Delete the feedback from the database
    $sql = "DELETE FROM feedback WHERE f_id = '$feedbackId'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Feedback deleted successfully.');</script>";
        echo "<script>window.location.href = 'view_feedback.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the feedback.');</script>";
        echo "<script>window.location.href = 'view_feedback.php';</script>";
    }
}

// Retrieve the feedback data from the database
$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>View Feedback - Sports Management System</title>
    <style>
        /* Custom CSS for Feedback View */

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container3 {
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .delete-btn {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
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
        <?php include 'admin_nav.php'; ?>
    </div>
    <div class="container3">
        <h1>View Feedback</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterate over the feedback data and display it in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    $feedbackId = $row['f_id'];
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['Message'] . "</td>";
                    echo "<td><button class='delete-btn' onclick='deleteFeedback($feedbackId)'>Delete</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function deleteFeedback(id) {
            if (confirm("Are you sure you want to delete this feedback?")) {
                window.location.href = "view_feedback.php?delete_feedback=" + id;
            }
        }
    </script>
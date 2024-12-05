<?php
require 'init.php';

if (isset($_POST['remove'])) {
    $sportId = $_POST['sport_id'];

    // Use prepared statements to prevent SQL injection
    $query = "DELETE FROM sports WHERE s_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $sportId); // Assuming s_id is an integer
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Redirect to the sports page after successful deletion
            header('Location: admin_sports.php');
            exit();
        } else {
            // Handle database errors more gracefully
            echo 'Error: Sport could not be removed.';
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle database errors more gracefully
        echo 'Error: ' . mysqli_error($conn);
    }
}

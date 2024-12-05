<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link rel="stylesheet" type="text/css" href="css/login.css?=1">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .main {
            display: flex;
            justify-content: center;
            /* align-items: center; */
            height: 100%;
        }

        form {
            width: 20rem;
            height: 20rem;

        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login {
            text-align: center;
        }

        .login form {
            display: inline-block;
            text-align: center;
            padding: 5px;
        }

        .login input[type="text"],
        .login input[type="email"],
        .login input[type="password"],
        .login input[type="submit"] {
            display: block;
            margin-bottom: 10px;
            width: 96%;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .login input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .login input[type="submit"]:hover {
            background-color: #45a049;
        }

        .login .heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="top">
        <center>
            <h1>SPORTS MANAGEMENT SYSTEM</h1>
        </center>

    </div>

    <div class="main">
        <div class="login">
            <form action="register.php" method="post">
                <fieldset>
                    <center>
                        <h2>User Registration</h2>
                    </center>
                    <!-- <legend class="heading">Admin Login</legend> -->
                    <input type="text" name="name" placeholder="Name" autocomplete="off">
                    <input type="email" name="email" placeholder="Email" autocomplete="off">
                    <input type="text" name="username" placeholder="Username" autocomplete="off">
                    <input type="password" name="password" placeholder="Password" autocomplete="off">
                    <input type="password" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                    <p>Already have an account <a href="login.php"> Login </a></p>
                    <input type="submit" value="Register" name="register">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>
<?php
include("Admin/init.php");

if (isset($_POST["register"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($cpassword)) {

        echo "<script>alert('All fields are required.');</script>";
    } elseif ($password != $cpassword) {
        echo "<script>alert('Passwords don't match.')</script>";
    } else {
        // Check if the username already exists
        $usernameCheckQuery = "SELECT username FROM userdetails WHERE username = '$username'";
        $usernameCheckResult = mysqli_query($conn, $usernameCheckQuery);

        // Check if the email already exists
        $emailCheckQuery = "SELECT email FROM userdetails WHERE email = '$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        if (mysqli_num_rows($usernameCheckResult) > 0) {

            echo "<script>alert('Username already exists.')</script>";
        } elseif (mysqli_num_rows($emailCheckResult) > 0) {

            echo "<script>alert('Email already exists.')</script>";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO userdetails (name,email,username,password) 
                    VALUES('$name','$email','$username','$hashedPassword')";
            if ($conn->query($sql)) {
                echo "<script>";
                echo 'alert("Registration Successful")';
                echo 'window.location.href = "login.php";';
                echo "</script>";
                exit();
            } else {
                echo "<script>";
                echo 'alert("Registration error")';
                echo 'window.location.href = "register.php";';
                echo "</script>";
            }
        }
    }
}
?>
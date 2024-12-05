<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link rel="stylesheet" href="../css/login.css?=1">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.css">
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
            font-size: 25px;
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
    <div class="title">
        <h1>Sports Management System</h1>
    </div>

    <div class="main">
        <div class="login">
            <form action="" method="post" name="login">
                <fieldset>
                    <legend class="heading">Admin Login</legend>
                    <input type="text" name="username" placeholder="Username" autocomplete="off">
                    <input type="password" name="password" placeholder="Password" autocomplete="off">
                    <input type="submit" value="Login">
                </fieldset>
            </form>
        </div>

    </div>

</body>

</html>

<?php
session_start();
include("init.php");


if (isset($_POST["username"], $_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT *FROM admin WHERE username='$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    // $row=mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login_user'] = $username;
        header("Location: dashboard.php");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Invalid Username or Password")';
        echo '</script>';
    }
}
?>
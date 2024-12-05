<?php
session_start();
if (empty($_SESSION['login_user'])) {
    header("location: Admin_login.php");
}

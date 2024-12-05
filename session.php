<?php

session_start();
if (empty($_SESSION['studentdetails'])) {
   header('Location: login.php');
}

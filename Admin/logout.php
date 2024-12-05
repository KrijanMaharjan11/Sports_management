<?php
   session_start();
   
   if(session_destroy()) {
        header("Location: Admin_login.php");
        echo '<script language="javascript">';
        echo 'alert("Logout successful")';
        echo '</script>';

   }
?>
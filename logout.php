<?php
    //start session
 	session_start();
    //session array
    $_SESSION = array();
    //unset the user session array
    unset($_SESSION['user']);
    //destroy all the sessions
    session_destroy();
    //redirect to the index.php/login page
    header("location: index.php");
    exit;
?>
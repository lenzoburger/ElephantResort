<?php
    session_start();
    if (isset($_SESSION['loggedIn'])) {
        $_SESSION['loggedIn'] = array();
    }
    
    header("Location: admin.php");
    exit();
?>
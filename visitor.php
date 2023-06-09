<?php
    // Start session
    session_start();

    // Set access to false
    $_SESSION['access'] = false;

    // Redirect to index page
    header('Location: index.php');
?>
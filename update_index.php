<?php 
    // Start session
    session_start();

    // Include
    include("connection.php");
    
    // Checking form submission method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Setting up variables
        $short_desc = $_POST['short-desc'];
        $main_desc = $_POST['main-desc'];
        $short_desc = mysqli_real_escape_string($conn, $short_desc);
        $main_desc = mysqli_real_escape_string($conn, $main_desc);
        
        // Setting up query
        $query = "UPDATE index_page SET short_description = '$short_desc', main_description = '$main_desc' WHERE id = 1";

        $result = mysqli_query($conn, $query);

        header("Location: profile.php");
    }
?>
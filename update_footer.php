<?php
    //Session
    session_start();

    //Include
    include('connection.php');

    $motto = $_POST['motto'];
    $instagram_link = $_POST['instagram-link'];
    $linkedin_link = $_POST['linkedin-link'];
    $facebook_link = $_POST['facebook-link'];

    $stmt = $conn->prepare("UPDATE footer SET motto = ?, instagram_link = ?, linkedin_link = ?, facebook_link = ?");
    $stmt->bind_param("ssss", $motto, $instagram_link, $linkedin_link, $facebook_link);

    if ($stmt->execute()) {
        echo "Records updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
    }

    // header('Location: profile.php');
?>
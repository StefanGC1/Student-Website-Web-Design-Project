<?php
    // Session Start
    session_start();

    // Include
    include('connection.php');

    // Getting form data
    $id = $_POST['id'];
    $grades = $_POST['grades'];

    $stmt = $conn->prepare("UPDATE grades SET grades = ? WHERE id = ?");
    $stmt->bind_param("si", $grades, $id);

    if ($stmt->execute()) {
        echo "Records updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
    }

    header('Location: profile.php');
?>
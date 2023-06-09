<?php
    // Start session
    session_start();

    // Include
    include('connection.php');

    $course_name = $_POST['grade-course-name'];
    $grades = $_POST['grades'];

    $stmt = $conn->prepare("INSERT INTO grades (course_name, grades) VALUES (?, ?)");
    $stmt->bind_param("ss", $course_name, $grades);

    // if ($stmt->execute()) {
    //     echo "Records updated successfully.";
    // } else {
    //     if ($conn->errno == 1062) {
    //         $_SESSION['message'] = "DUPLICATE VALUE. TRY EDITING GRADES";
    //     }
    // }

    try {
        $stmt->execute();
    } catch (Exception $e) {
        $_SESSION['message'] = "DUPLICATE VALUE. TRY EDITING GRADES";
    }

    $stmt->close();

    header("Location: profile.php");
?>
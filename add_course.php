<?php 
    // Session start
    session_start();

    // Set up connection
    include('connection.php');

    $course_name = $_POST['course-name'];
    $course_desc = $_POST['course-desc'];
    $professor = $_POST['professor'];
    $start_date = $_POST['start-date'];
    $end_date;

    if (isset($_POST['end-date']) && $_POST['end-date'] != "") {
        $end_date = $_POST['end-date'];
        $stmt = $conn->prepare("INSERT INTO courses (course_name, description, professor, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $course_name, $course_desc, $professor, $start_date, $end_date);
    } else {
        $end_date = NULL;
        $stmt = $conn->prepare("INSERT INTO courses (course_name, description, professor, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $course_name, $course_desc, $professor, $start_date, $end_date);
    }

    if ($stmt->execute()) {
        echo "Records updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
    }

    $stmt->close();

    header("Location: profile.php");
?>
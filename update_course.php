<?php 
    // Start session
    session_start();

    // Include
    include('connection.php');

    $id = $_POST['id'];
    $course_name = $_POST['course-name'];
    $course_desc = $_POST['course-desc'];
    $professor = $_POST['professor'];
    $start_date = $_POST['start-date'];
    $end_date = NULL;

    $query = "SELECT course_name FROM courses WHERE id = " . $id;
    $result = mysqli_query($conn,$query);
    $old_row = mysqli_fetch_assoc($result);
    $old_course_name = $old_row['course_name'];

    if (isset($_POST['end-date']) && $_POST['end-date'] != "") {
        $end_date = $_POST['end-date'];
        $stmt = $conn->prepare("UPDATE courses SET course_name = ?, description = ?, professor = ?, start_date = ?, end_date = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $course_name, $course_desc, $professor, $start_date, $end_date, $id);
    } else {
        $end_date = NULL;
        $stmt = $conn->prepare("UPDATE courses SET course_name = ?, description = ?, professor = ?, start_date = ?, end_date = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $course_name, $course_desc, $professor, $start_date, $end_date, $id);
    }

    $grade_stmt = $conn->prepare("UPDATE grades SET course_name = ? WHERE course_name = ?");
    $grade_stmt->bind_param("ss", $course_name, $old_course_name);

    if ($stmt->execute()) {
        echo "Records updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
    }

    if ($grade_stmt->execute()) {
        echo "Records updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
    }

    $stmt->close();
    $grade_stmt->close();

    header("Location: profile.php");
?>
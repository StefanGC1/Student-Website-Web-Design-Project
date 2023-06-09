<?php 
    // Start session
    session_start();

    // Include
    include("connection.php");
    
    $personalInfo = $_POST['personal-info'];
    $education = $_POST['education'];
    $workExperience = $_POST['work-experience'];
    $skills = $_POST['skills'];

    if (isset($_FILES['cv-file']) && $_FILES['cv-file']['size'] > 0) {
        // File was uploaded
        $fileContent = file_get_contents($_FILES['cv-file']['tmp_name']);
        $stmt = $conn->prepare("UPDATE about_page SET cv = ?, personal_info = ?, education = ?, work_experience = ?, skills = ?");
        $stmt->bind_param("sssss", $fileContent, $personalInfo, $education, $workExperience, $skills);
    } else {
        // No file was uploaded
        $stmt = $conn->prepare("UPDATE about_page SET personal_info = ?, education = ?, work_experience = ?, skills = ?");
        $stmt->bind_param("ssss", $personalInfo, $education, $workExperience, $skills);
    }

    if ($stmt->execute()) {
        echo "Records updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
    }

    $stmt->close();

    header("Location: profile.php");
?>
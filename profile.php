<?php
    // Start session
    session_start();

    // Grade duplicates
    if (isset($_SESSION['message'])) {
        echo "<script type='text/javascript'>alert('" . $_SESSION['message'] . "');</script>";
        unset($_SESSION['message']);  // So that the message doesn't keep showing up every time the page is refreshed
    }

    // Include database connection file
    include("connection.php");

    // Create queries
    $index_page_query = "SELECT * FROM index_page";
    $about_page_query = "SELECT * FROM about_page";
    $courses_page_query = "SELECT * FROM courses";
    $grades_page_query = "SELECT * FROM grades";

    // Query Execution
    $index_page_result = mysqli_query($conn, $index_page_query);
    $about_page_result = mysqli_query($conn, $about_page_query);
    $courses_page_result = mysqli_query($conn, $courses_page_query);
    $grades_page_result = mysqli_query($conn, $grades_page_query);

    // Index Page Info Retrieval
    $short_desc = "";
    $main_desc = "";
    if ($index_page_result) {
        if (mysqli_num_rows($index_page_result) > 0) {
            $row = mysqli_fetch_row($index_page_result);
            $short_desc = $row[1];
            $main_desc = $row[2];
        }
    }

    // About Page Info Retrieval
    $pers_info = "";
    $education = "";
    $work_exp = "";
    $skills = "";
    if ($about_page_result) {
        if (mysqli_num_rows($about_page_result) > 0) {
            $row = mysqli_fetch_assoc($about_page_result);
            $pers_info = $row['personal_info'];
            $education = $row['education'];
            $work_exp = $row['work_experience'];
            $skills = $row['skills'];
        }
    }
    
    // Courses Page Info Retrieval
    $courses_data = [];
    $course_name_array = [];
    if ($courses_page_result) {
        while ($row = mysqli_fetch_assoc($courses_page_result)) {
            array_push($courses_data, $row);
            array_push($course_name_array, $row['course_name']);
        }
    }

    // Grades Page Info Retrival
    $grades_data = [];
    if ($grades_page_result) {
        while ($row = mysqli_fetch_assoc($grades_page_result)) {
            array_push($grades_data, $row);
        }
    }

    // Footer Section Info Retrieval
    $footer_section_query = "SELECT * FROM footer";
    $footer_section_result = mysqli_query($conn, $footer_section_query);
    $motto = "";
    $instagram_link = "";
    $linkedin_link = "";
    $facebook_link = "";
    if ($footer_section_result) {
        $row = mysqli_fetch_assoc($footer_section_result);
        $motto = $row['motto'];
        $instagram_link = $row['instagram_link'];
        $linkedin_link = $row['linkedin_link'];
        $facebook_link = $row['facebook_link'];
    }

    // JSON encoding for transfering the data to JS
    $courses_json_data = json_encode($courses_data);
    $course_name_json_data = json_encode($course_name_array);
    $grades_json_data = json_encode($grades_data);
?>

<script>
    // Initializing the object data in JS in global scope in order to be accessible from the .js file
    courses_data = JSON.parse('<?php echo $courses_json_data; ?>');
    course_name_data = JSON.parse('<?php echo $course_name_json_data; ?>');
    grades_data = JSON.parse('<?php echo $grades_json_data; ?>')
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
    <script src="profile.js"></script>
</head>
<body>
    <section class="header-sec">
        <div class="welcome"><p>Welcome, placeholder</p></div>
        <nav class="header-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="grades.php">Grades</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
    </section>

    <main>
        <div class="form-container">
        <section class="main-page">
            <!-- Section 1 -->
            <form action="update_index.php" method="POST">
                <h2>Add main page description</h2>
                <label for="short-desc">Short Description:</label>
                <textarea id="short-desc" name="short-desc"><?php echo $short_desc;?></textarea>
                <label for="main-desc">Main Description:</label>
                <textarea id="main-desc" name="main-desc"><?php echo $main_desc;?></textarea>
                <input type="submit" value="Submit">
            </form>
        </section>

        <section class="about-page">
            <form action="update_about.php" method="POST" enctype="multipart/form-data">
                <h2>Edit about page</h2>
                <label for="cv-file">Select CV:</label>
                <input type="file" id="cv-file" name="cv-file"/>
                <label for="personal-info">Personal Information:</label>
                <textarea id="personal-info" name="personal-info"><?php echo $pers_info; ?></textarea>
                <label for="education">Education:</label>
                <textarea id="education" name="education"><?php echo $education; ?></textarea>
                <label for="work-experience">Work Experience:</label>
                <textarea id="work-experience" name="work-experience"><?php echo $work_exp; ?></textarea>
                <label for="skills">Skills:</label>
                <textarea id="skills" name="skills"><?php echo $skills; ?></textarea>
                <input type="submit" value="Submit">
            </form>
        </section>

        <section class="courses-page" id="courses-page">
            <!-- Section 3 -->
            <form action="add_course.php" method="POST" id="courses-form">
                <h2>Add a Course</h2>
                <label for="course-name">Course Name:</label>
                <input type="text" id="course-name" name="course-name" required>
                <label for="course-desc">Course Description:</label>
                <textarea id="course-desc" name="course-desc" required></textarea>
                <label for="professor">Professor:</label>
                <input type="text" id="professor" name="professor" required>
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start-date" required>
                <label for="end-date">End Date (Optional):</label>
                <input type="date" id="end-date" name="end-date">
                <input type="submit" value="Add Course">
            </form>
        </section>
        
        <section class="grades-page" id="grades-page">
            <!-- Section 4 -->
            <form action="add_grades.php" method="POST">
                <h2>Add a Grade</h2>
                <label for="grade-course-name">Course Name:</label>
                <select id="grade-course-name" name="grade-course-name" required>
                </select>
                <label for="grades">Grades (separated by commas, no spaces):</label>
                <input type="text" id="grades" name="grades" required pattern="^(\d+(\.\d+)?)(,\s*\d+(\.\d+)?)*$">
                <input type="submit" value="Add Grade">
            </form>
        </section>

        <section class="links">
            <!-- Section 5 -->
            <form action="update_footer.php" method="POST">
                <h2>Edit Footer</h2>
                <label for="motto">Motto:</label>
                <input type="text" id="motto" name="motto" required value="<?php echo $motto;?>">
                <label for="instagram-link">Instagram Link:</label>
                <textarea id="instagram-link" name="instagram-link" required><?php echo $instagram_link;?></textarea>
                <label for="linkedin-link">Linkedin Link:</label>
                <textarea id="linkedin-link" name="linkedin-link" required><?php echo $linkedin_link;?></textarea>
                <label for="facebook-link">Linkedin Link:</label>
                <textarea id="facebook-link" name="facebook-link" required><?php echo $facebook_link;?></textarea>
                <input type="submit" value="Submit">
            </form>
        </section>
        </div>
    </main>

    <footer>
        <div class="hr-line"><hr></div>
        <h3><?php echo $motto;?></h3>
        <nav class="footer-nav cut-off-border">
            Links:
            <ul>
                <li><a href="<?php echo $instagram_link;?>">Instagram</a></li>
                <li><a href="<?php echo $linkedin_link;?>">Linkdin</a></li>
                <li><a href="<?php echo $facebook_link;?>">Facebook</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>
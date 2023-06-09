<?php
// Start the session
session_start();

$access = false;

// Check if 'access' is set in the session
if(isset($_SESSION['access'])) {
    $access = $_SESSION['access'];
} else {
    $access = false;  // default value if 'access' is not set in the session
}



echo "<script>
document.addEventListener('DOMContentLoaded', () => {
    var profileLink = document.getElementsByClassName('profile')[0];

    if (" . $access . ") {
        profileLink.style.display = 'block';
    } else {
        profileLink.style.display = 'none';
    }
});
</script>";
?>

<?php
    include("connection.php");

    // Create query
    $description_query = "SELECT * FROM about_page";

    // Execute query
    $result = mysqli_query($conn, $description_query);

    // Data to be encoded
    $data = [];

    // CV File
    $fileData;
    $fileName;
    $mimeType;

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $fileData = $row['cv'];
            unset($row['cv']);
            $data = $row;
            if ($fileData != NULL) {
                $fileName = "CV.pdf";
                $mimeType = "application/pdf";
            }
        }
    }

    // JSON
    $json_data = json_encode($data);

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
?>

<script>
    var data = JSON.parse('<?php echo $json_data; ?>'); // Setting up the data retrieved by the php to be dynamically placed by JS
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
    <link rel="stylesheet" href="about.css">
    <script src="about.js"></script>
    <title>About</title>
</head>
<body>
    <section class="header-sec">
        <div class="welcome"><p>Welcome to my site!</p></div>
        <nav class="header-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="grades.php">Grades</a></li>
                <li class="login"><a href="login.php">Login</a></li>
                <li class="profile"><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
    </section>

    <main>
        <p class="cv-download">You can view / download my CV <?php if ($fileData != NULL) {echo "<a href='data:$mimeType;base64," . base64_encode($fileData) . "' download='$fileName'>"; } ?>here</a></p>
        
        <div class="dropdown-menu">
            <button class="drop-button">Select Information...</button>
            <div class="dropdown-content">
                <button class="dropdown-item" onclick="dropDownMenuFunc(0);">Personal Information</button>
                <button class="dropdown-item" onclick="dropDownMenuFunc(1)">Education</button>
                <button class="dropdown-item" onclick="dropDownMenuFunc(2)">Work Experience</button>
                <button class="dropdown-item" onclick="dropDownMenuFunc(3)">Skills</button>
            </div>
        </div>

        <div class="info-choice"></div>
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
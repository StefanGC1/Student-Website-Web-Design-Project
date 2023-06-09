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
    // Include
    include('connection.php');

    $query = "SELECT * FROM grades";

    $result = mysqli_query($conn, $query);

    $data = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
    }

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
    data = JSON.parse('<?php echo $json_data; ?>');
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
    <link rel="stylesheet" href="grades.css">
    <script src="grades.js"></script>
    <title>Courses</title>
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
        <div id="grade-list">
        <!-- Courses will be inserted here -->
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
<?php
    // Start session
    session_start();

    // Include database connection file
    include('connection.php');

    // Initialize message variable
    $message = '';

    // Check if form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get username and password from POST request
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare MySQL query
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

        // Execute query
        $result = mysqli_query($conn, $query);

        // If result has one or more rows, credentials are valid
        if(mysqli_num_rows($result) == 1) {
            // Get the first row
            $row = mysqli_fetch_assoc($result);

            // If access is 1, start a session
            if($row['access'] == 1) {
                $_SESSION['access'] = true;
                header("Location: index.php"); // redirect to index page after successful login
                exit;
            } elseif ($row['access'] == 0) {
                $_SESSION['access'] = false;
                header("Location: index.php"); // redirect to index page after successful login
                exit;
            }
        } else {
            // If credentials are invalid, set the error message
            $message = "Incorrect username/password!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Website</title>
    <link rel="stylesheet" tpye="text/css" href="login.css">
</head>
<body>
    <div class="login-wrapper">
    <form action="" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br />
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br />
        <input type="submit" value="Submit">
    </form>
    <?php
        if(!empty($message)) {
            echo "<p>$message</p>";
        }
    ?>
    <a href="visitor.php">Continue as visitor</a>
    </div>
</body>
</html>
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfoliodb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Admin Name & Password Check
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $sql = "SELECT name, password FROM admin WHERE name='$name'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['name'] === $name && $row['password'] === $password) {
            // Start a PHP session
            session_start();
            // // Store the username in a session variable
            $_SESSION['name'] = $row['name'];
            echo "Login successful! Welcome, " . $row['name'];
            header('location:dashboard.php');
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- ======= Admin Form Start ======= -->
    <section class="section section-contact">
        <div class="container">
            <h2 class="common-heading">Admin Log In</h2>
        </div>
        <div class="section-contact-main contact-container">
            <form action="" method="POST">
                <div>
                    <label for="name"></label>
                    <input type="text" name="name" id="name" required placeholder="name">
                </div>
                <div>
                    <label for="password"></label>
                    <input type="password" name="password" id="password" required placeholder="password">
                </div>
                <div>
                    <input class="btn" type="submit" value="Log In">
                </div>
            </form>
        </div>
    </section>
    <!-- ======= Admin Form Ends ======= -->

</body>

</html>
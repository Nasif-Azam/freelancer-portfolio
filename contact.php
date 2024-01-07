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

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // SQL query to insert data into the table
    $sql = "INSERT INTO client (username, email, subject, message) VALUES ('$username', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully");</script>';        
        header('location:index.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

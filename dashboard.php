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
// Delete Data
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "delete from `client` where id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo 'Deleted Successfully';
        header('location:dashboard.php');
    } else {
        die(mysqli_error($conn));
    }
}
// Logout Session
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header('location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <style>
        .section {
            padding: 3rem 0;
        }

        table {
            width: 80%;
        }

        table,
        th,
        td {
            font-size: 1.2rem;
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
        }

        .btn {
            padding: 1rem 1rem;
            margin-top: 0;
        }

        .delete {
            color: red;
        }

        .edit {
            color: green;
        }

        label {
            font-size: 2rem;
        }

        input {
            padding: 1.5rem 2rem;
            border: 0.1rem solid #c9c9c9;
            border-radius: 5px;
        }
    </style>
    <header class="header">
        <?php
        // Start the session
        session_start();
        // Check if the username is set in the session
        if (isset($_SESSION['name'])) {
            $name = $_SESSION['name'];
            echo "<h1>Welcome, Admin $name!</h1>";
        } else {
            header('location:admin.php'); // Redirect to your login page
            exit();
        }
        ?>

        <form method="GET" action="">
            <button class="btn" type="submit" name="logout">Logout</button>
        </form>

    </header>
    <section class="section">
        <div class="container">

            <form action="#" method="POST">
                <h2 class="common-heading">Searched Data</h2>
                <div class="form-group-search">
                    <label>Searched By Student's ID:</label>
                    <input required type="text" name="id" />
                    <a class="btn" type="submit" name="search">Search</a>
                </div>
                <table>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        echo '
                            <thead>
                                <tr>
                                    <th scope="col"><h3>ID</h3> </th>
                                    <th scope="col"><h3>User Name</h3></th>
                                    <th scope="col"><h3>Email</h3></th>
                                    <th scope="col"><h3>Subject</h3></th>
                                    <th scope="col"><h3>Message</h3></th>
                                    <th scope="col" style="color:red;"><h3>Delete</h3></th>
                                </tr>
                            </thead>
                        ';
                    }
                    ?>

                    <tbody>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $id = $_POST['id'];
                            $sql = "SELECT id, username, email, subject, message FROM client WHERE id=$id";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row["id"];
                                $username = $row["username"];
                                $email = $row["email"];
                                $subject = $row["subject"];
                                $message = $row["message"];
                                echo '
                            <tr>
                                <th scope="row"><h4>' . $id . '</h4></th>
                                <td><h4>' . $username . '</h4></td>
                                <td><h4>' . $email . '</h4></td>
                                <td><h4>' . $subject . '</h4></td>
                                <td><h4>' . $message . '</h4></td>
                                <td>
                                    <a  class="btn delete" href="dashboard.php?deleteid=' . $id . '">Delete</a>
                                </td>
                            </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>

            <h2 class="common-heading">Display Information</h2>
            <table>
                <thead>
                    <tr>
                        <th scope="col">
                            <h3>ID</h3>
                        </th>
                        <th scope="col">
                            <h3>User Name</h3>
                        </th>
                        <th scope="col">
                            <h3>Email</h3>
                        </th>
                        <th scope="col">
                            <h3>Subject</h3>
                        </th>
                        <th scope="col">
                            <h3>Message</h3>
                        </th>
                        <th scope="col" style="color:red;">
                            <h3>Delete</h3>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "select * from `client`";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $username = $row['username'];
                            $email = $row['email'];
                            $subject = $row['subject'];
                            $message = $row['message'];
                            echo '
                        <tr>
                            <th scope="row"><h4>' . $id . '</h4></th>
                            <td><h4>' . $username . '</h4></td>
                            <td><h4>' . $email . '</h4></td>
                            <td><h4>' . $subject . '</h4></td>
                            <td><h4>' . $message . '</h4></td>
                            <td>
                                <a  class="btn delete" href="dashboard.php?deleteid=' . $id . '">Delete</a>
                            </td>
                        </tr>
                        ';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
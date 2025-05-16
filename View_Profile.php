<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}
include "Connect.php";

// Get the user's ID from the URL
$userId = $_GET['id'];

// Fetch the user's data from the database
$sql = "SELECT * FROM users WHERE id='$userId'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile of <?php echo $user['FirstName']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Profile of <?php echo $user['FirstName'] . " " . $user['LastName']; ?></h1>
        <img src="<?php echo $user['ProfilePicture']; ?>" alt="Profile Picture" width="150"><br>
        <strong>Name:</strong> <?php echo $user['FirstName'] . " " . $user['LastName']; ?><br>
        <strong>Email:</strong> <?php echo $user['Email']; ?><br><br>

        <a href="homepage.php">Back to Homepage</a><br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

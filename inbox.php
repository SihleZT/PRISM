<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}
include "Connect.php";

$userId = $_SESSION['user_id']; // Assuming user_id is stored in session after login

// Fetch all messages where the user is the receiver
$sql = "SELECT * FROM messages 
        JOIN users ON messages.sender_id = users.id 
        WHERE receiver_id = '$userId'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Inbox</h1>
        <ul>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<li><strong>From:</strong> " . $row['FirstName'] . " " . $row['LastName'] . "<br>";
                echo "<strong>Message:</strong> " . $row['message'] . "<br>";
                echo "<strong>Sent on:</strong> " . $row['timestamp'] . "</li><hr>";
            }
            ?>
        </ul>

        <a href="homepage.php">Back to Homepage</a><br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

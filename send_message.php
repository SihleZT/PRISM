<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}
include "Connect.php";

// Get the receiver's user ID from the URL
$receiverId = $_GET['id'];

// Fetch receiver's details
$sql = "SELECT * FROM users WHERE id='$receiverId'";
$result = $conn->query($sql);
$receiver = $result->fetch_assoc();

if (isset($_POST['send'])) {
    $message = $_POST['message'];
    $senderId = $_SESSION['user_id']; // Assuming user_id is stored in session after login

    // Insert the message into the messages table
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) 
            VALUES ('$senderId', '$receiverId', '$message')";
    if ($conn->query($sql)) {
        echo "Message sent!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message to <?php echo $receiver['FirstName']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Send Message to <?php echo $receiver['FirstName'] . " " . $receiver['LastName']; ?></h1>
        <form method="POST">
            <textarea name="message" placeholder="Enter your message" required></textarea><br>
            <input type="submit" value="Send Message" name="send">
        </form>

        <a href="homepage.php">Back to Homepage</a><br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

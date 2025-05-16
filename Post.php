<?php
session_start();
include "Connect.php";

if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caption = $_POST['caption'];
    $email = $_SESSION['email'];
    $target_file = "uploads/" . basename($_FILES["post_picture"]["name"]);

    // Check if the upload is successful
    if (move_uploaded_file($_FILES["post_picture"]["tmp_name"], $target_file)) {
        $insertPostQuery = "INSERT INTO posts (Email, Caption, Picture) VALUES ('$email', '$caption', '$target_file')";
        if ($conn->query($insertPostQuery)) {
            echo "Post uploaded successfully.";
            header("Location: homepage.php"); // Redirect to the homepage
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading post picture.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="post.php" enctype="multipart/form-data">
        <textarea name="caption" placeholder="Write your caption" required></textarea><br>
        <input type="file" name="post_picture" required><br>
        <input type="submit" value="Post">
    </form>
</body>
</html>

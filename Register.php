<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "Connect.php";

if (isset($_POST['register'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypting password

    // Check if the email already exists
    $checkEmail = "SELECT * FROM users WHERE Email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Handle file upload for profile picture
        $target_file = "uploads/" . basename($_FILES["profile_picture"]["name"]); 

        // Check if the upload is successful
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            echo "Profile picture uploaded successfully.";
            
            // Insert new user with profile picture
            $insertQuery = "INSERT INTO users (FirstName, LastName, Email, Password, ProfilePicture) 
                            VALUES ('$firstName', '$lastName', '$email', '$password', '$target_file')";
            if ($conn->query($insertQuery)) {
                header("Location: Login.php"); 
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error uploading profile picture.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
	 <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="/PRISM/Register.php" enctype="multipart/form-data">
        <input type="text" name="first_name" placeholder="First Name" required><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="file" name="profile_picture" required><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>

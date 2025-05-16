<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}

include "Connect.php"; 

// Fetch user data
$email = $_SESSION['email'];
$query = "SELECT id, FirstName, LastName, Email, ProfilePicture FROM users WHERE Email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email); 
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}

// Display profile picture
$profile_pic = 'uploads/' . $user['ProfilePicture']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>My Profile</h1>
        <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" width="150"><br> 
        <strong>Name:</strong> <?php echo htmlspecialchars($user['FirstName'] . " " . $user['LastName']); ?><br>
        <strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?><br><br>

        <a href="homepage.php">Back to Homepage</a><br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>



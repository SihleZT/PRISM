<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}
include "Connect.php";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to your homepage!</h1>
        <p>Logged in as <?php echo htmlspecialchars($_SESSION['email']); ?></p> 

        
        <a href="Post.php">Create a Post</a><br> 
        <a href="Search.php">Search Users</a><br> 

        
        <h3>All Users</h3>
        <ul>
            <?php
           
            $stmt = $conn->prepare("SELECT id, FirstName, LastName FROM users WHERE Email != ?");
            $stmt->bind_param("s", $_SESSION['email']);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='view_profile.php?id=" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['FirstName']) . " " . htmlspecialchars($row['LastName']) . "</a></li>";
            }

            
            $stmt->close();
            ?>
        </ul>

        <a href="profile.php">View My Profile</a><br>
        <a href="logout.php">Logout</a>

       
        <h2>Your Feed</h2>
        <?php
        $sql = "SELECT * FROM posts ORDER BY PostTime DESC";
        $result = $conn->query($sql);

        while ($post = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<p><strong>" . htmlspecialchars($post['Email']) . "</strong></p>";
            echo "<p>" . htmlspecialchars($post['Caption']) . "</p>";
            if ($post['Picture']) {
                echo "<img src='" . htmlspecialchars($post['Picture']) . "' width='300'/>";
            }
            echo "<p><small>Posted on: " . htmlspecialchars($post['PostTime']) . "</small></p>";
            echo "</div><hr>";
        }

 
        $conn->close();
        ?>
    </div>
</body>
</html>

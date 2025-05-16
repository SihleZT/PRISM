<?php
session_start();
include "Connect.php";

if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTerm = $_POST['search_term'];
    $stmt = $conn->prepare("SELECT id, FirstName, LastName, Email FROM users WHERE FirstName LIKE ? OR LastName LIKE ?");
    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="search.php">
        <input type="text" name="search_term" placeholder="Search users by name" required><br>
        <input type="submit" value="Search">
    </form>

    <div>
        <h3>Search Results</h3>
        <?php
        if (isset($result)) {
            while ($row = $result->fetch_assoc()) {
                echo "<p><a href='view_profile.php?id=" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['FirstName']) . " " . htmlspecialchars($row['LastName']) . " (" . htmlspecialchars($row['Email']) . ")</a></p>";
            }
        }
        ?>
    </div>
</body>
</html>

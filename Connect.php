<?php
$servername = "localhost";
$username = "root"; // Default in XAMPP is 'root'
$password = ""; // Leave it empty for XAMPP
$dbname = "social_media"; // Ensure this matches the name of your database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

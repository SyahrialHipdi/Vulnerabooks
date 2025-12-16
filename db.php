<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Default XAMPP password is empty
$db   = 'library_vulnerable';

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select database if it exists
$conn->select_db($db);
?>

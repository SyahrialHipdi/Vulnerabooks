<?php
require 'db.php';

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS library_vulnerable";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully (or already exists).<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->select_db('library_vulnerable');

// Create Table
$sql = "CREATE TABLE IF NOT EXISTS books (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    year INT(4),
    description TEXT,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'books' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert dummy data if empty
$check = $conn->query("SELECT * FROM books");
if ($check->num_rows == 0) {
    $sql = "INSERT INTO books (title, author, year, description) VALUES
    ('Hacking 101', 'John Doe', 2023, 'Intro to security.'),
    ('Web Security', 'Jane Smith', 2024, 'Deep dive into XSS and SQLi.'),
    ('PHP for Beginners', 'Admin', 2022, 'Learning PHP the hard way.')";

    if ($conn->query($sql) === TRUE) {
        echo "Dummy data inserted.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

echo "<br><b>Setup Complete!</b> <a href='index.php'>Go to Home</a>";
?>
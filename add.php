<?php
require 'db.php';
include 'header.php';
?>

<div class="form-container">
    <h2 style="margin-bottom: 2rem; text-align: center;">Add New Book</h2>

    <form action="add.php" method="POST">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" required>
        </div>

        <div class="form-group">
            <label>Year</label>
            <input type="number" name="year" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4"></textarea>
        </div>

        <button type="submit" name="submit" class="btn" style="width: 100%;">Add Book</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // VULNERABILITY: NO SANITIZATION
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $desc = $_POST['description'];

        // Using Prepared Statments partially to avoid SQLi breaking the insert flow easily, 
        // BUT the main goal here is showing Stored XSS via inputs.
        // If user wants SQLi on INSERT, we could do direct query, but 'search.php' is better for that.
        // Let's stick to simple insert but allow HTML tags.
    
        $sql = "INSERT INTO books (title, author, year, description) VALUES ('$title', '$author', '$year', '$desc')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: #4ade80; margin-top: 1rem; text-align: center;'>Book added successfully!</p>";
        } else {
            echo "<p style='color: var(--danger); margin-top: 1rem; text-align: center;'>Error: " . $conn->error . "</p>";
        }
    }
    ?>
</div>

<?php include 'footer.php'; ?>
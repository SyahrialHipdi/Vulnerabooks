<?php
require 'db.php';
include 'header.php';
?>

<div class="hero">
    <h1>Library Collection</h1>
    <p>Explore our curated list of books. Feel free to add your own!</p>

    <div class="search-box">
        <form action="search.php" method="GET">
            <input type="text" name="q" placeholder="Search books...">
            <button type="submit" class="btn">Search</button>
        </form>
    </div>
</div>

<div class="card-grid">
    <?php
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            // VULNERABILITY: DIRECT ECHO (STORED XSS)
            echo '<h3>' . $row["title"] . '</h3>';
            echo '<span class="author">By ' . $row["author"] . ' (' . $row['year'] . ')</span>';
            echo '<p>' . $row["description"] . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p style='grid-column: 1/-1; text-align: center;'>No books found.</p>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
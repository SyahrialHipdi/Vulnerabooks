<?php
require 'db.php';
include 'header.php';

$search = isset($_GET['q']) ? $_GET['q'] : '';
?>

<div class="hero" style="padding: 2rem 1rem; margin-bottom: 1rem;">
    <h1>Search Results</h1>

    <!-- VULNERABILITY: REFLECTED XSS -->
    <p>Results for: <?php echo $search; ?></p>
</div>

<div class="container">
    <div class="search-box"
        style="margin-bottom: 2rem; display: block; max-width: 500px; margin-left: auto; margin-right: auto;">
        <form action="search.php" method="GET">
            <input type="text" name="q" placeholder="Search again..." value="<?php echo $search; ?>">
            <button type="submit" class="btn">Search</button>
        </form>
    </div>

    <div class="card-grid">
        <?php
        if ($search) {
            // VULNERABILITY: SQL INJECTION
            // Direct concatenation of input into the query
            $sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%'";

            // For debugging (makes SQLi easier to spot)
            // echo "<small style='color: #666;'>Debug SQL: $sql</small><br><br>";
        
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<h3>' . $row["title"] . '</h3>';
                    echo '<span class="author">By ' . $row["author"] . '</span>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>No results found.</p>";
                if ($conn->error) {
                    echo "<p style='color: red;'>SQL Error: " . $conn->error . "</p>";
                }
            }
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
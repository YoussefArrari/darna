<?php
// Include database connection file
require_once "dbh.inc.php";

// Check if blog ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the blog ID from the URL
    $blog_id = $_GET['id'];

    try {
        // Prepare SQL statement to delete the blog post
        $sql = "DELETE FROM blogs WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$blog_id]);

        // Redirect back to the page where the blog was deleted from
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=true");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect back to the previous page if blog ID is not provided
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

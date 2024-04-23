<?php
// Include your database connection file
require_once "dbh.inc.php";

// Check if the message ID is provided in the URL
if (isset($_GET['id'])) {
    // Parse the message ID from the URL parameter
    $subscriber_id = $_GET['id'];

    try {
        // Prepare a DELETE statement to delete the message with the specified ID
        $sql = "DELETE FROM messages WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$subscriber_id]);

        // Redirect the user back to the previous page or a designated page after deletion
        header("Location: ../newsletter.php");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        // You can also redirect the user to an error page if needed
    }
} else {
    // Redirect the user back to the previous page or a designated page if the message ID is not provided
    header("Location: ../messages.php");
    exit();
}
?>
<?php
// Check if ID is provided
if(isset($_GET['id'])) {
    // Include the necessary files
    require_once "dbh.inc.php";

    // Prepare the SQL statement
    $sql = "DELETE FROM newsletter_subscribers WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Bind the ID parameter
    $stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);

    // Execute the statement
    if($stmt->execute()) {
        // Redirect back to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // If the deletion fails, handle the error
        echo "Error: Unable to delete newsletter.";
    }
} else {
    // If no ID is provided, redirect back to the previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

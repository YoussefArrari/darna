<?php
if(isset($_POST['subscribe'])) {
    // Include your database connection file
    require_once "dbh.inc.php";

    // Get the email from the form
    $email = $_POST['email'];

    // Insert the email into the database
    $sql = "INSERT INTO newsletter_subscribers (email) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    // Redirect the user back to the previous page
    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?emailsuccess=true");
    } else {
        // If the referer is not set, redirect to a default page
        header("Location: index.php");
    }
    exit();
} else {
    // Redirect the user to an error page or back to the previous page
    header("Location: error_page.php");
    exit();
}
?>

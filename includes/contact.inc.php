<?php

if (isset($_POST['submit'])) {
    // Include the necessary files
    require_once 'dbh.inc.php';

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate input (you can add more validation if needed)
    if (empty($name) || empty($email) || empty($message)) {
        // Redirect back to the form with an error message
        header("Location: ../contactUs.php?error=emptyfields");
        exit();
    } else {
        // Prepare SQL statement
        $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->execute([$name, $email, $message]);

        // Redirect back to the form with a success message
        header("Location: ../contactUs.php?success=message_sent");
        exit();
    }
} else {
    // If the form was not submitted, redirect back to the form page
    header("Location: ../contactUs.php");
    exit();
}

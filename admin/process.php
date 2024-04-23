<?php
session_start();
 require 'includes/is_loged_in.php';
 if(!is_logged_in()) {
     header("Location: /php%20tuto/admin/login.php");
     die();
 }
// Include database connection file
require_once "../includes/dbh.inc.php";

// Function to handle file upload
function handleFileUpload() {
    if(!isset($_FILES['file'])) {
        return "No file uploaded.";
    }

    $file = $_FILES['file'];
    $img_name = $file['name'];
    $img_size = $file['size'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if($error !== 0) {
        return "File upload error occurred.";
    }

    if($img_size > 1250000) {
        return "Sorry, your file is too large.";
    }

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if(!in_array($img_ex_lc, $allowed_exs)) {
        return "You can't upload files of this type.";
    }

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_upload_path = '../uploads/' . $new_img_name;

    if(!move_uploaded_file($tmp_name, $img_upload_path)) {
        return "Failed to upload image.";
    }

    return $new_img_name; // Return the generated image name
}

// Function to validate and handle product insertion
function insertProduct($pdo) {
    if(empty($_POST['product_name']) || empty($_POST['description']) || empty($_POST['price'])) {
        return "Please fill in all required fields.";
    }

    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload
    $image_url = handleFileUpload();
    
    if(!is_string($image_url)) {
        return $image_url;
    }

    try {
        // Insert product data into the database
        $sql = "INSERT INTO products (product_name, description, price, image_urls) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$product_name, $description, $price, $image_url]);
        return true; // Insertion successful
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage(); // Return error message
    }
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Call insertProduct function
    $result = insertProduct($pdo);

    // Check result and handle redirection
    if($result === true) {
        header("Location: uploadproduct.php?success=true");
        exit();
    } else {
        header("Location: uploadproduct.php?error=" . urlencode($result));
        exit();
    }
} else {
    header("Location: uploadproduct.php");
    exit();
}

?>

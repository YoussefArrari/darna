<?php

// Include database connection file
require_once "dbh.inc.php";

// Function to handle file upload
function handleFileUpload() {
    if(!isset($_FILES['image'])) {
        return "No image uploaded.";
    }

    $file = $_FILES['image'];
    $img_name = $file['name'];
    $img_size = $file['size'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if($error !== 0) {
        return "Image upload error occurred.";
    }

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if(!in_array($img_ex_lc, $allowed_exs)) {
        return "You can only upload JPG, JPEG, or PNG files.";
    }

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_upload_path = '../../uploads/' . $new_img_name;

    if(!move_uploaded_file($tmp_name, $img_upload_path)) {
        return "Failed to upload image.";
    }

    return $new_img_name; // Return the generated image name
}

// Function to validate and handle blog post insertion
function insertBlog($pdo) {
    if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['author'])) {
        return "Please fill in all required fields.";
    }

    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    // Handle file upload
    $image_url = handleFileUpload();
    
    if(!is_string($image_url)) {
        return $image_url;
    }

    try {
        // Insert blog data into the database
        $sql = "INSERT INTO blogs (title, content, author, img_title) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $content, $author, $image_url]);
        return true; // Insertion successful
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage(); // Return error message
    }
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Call insertBlog function
    $result = insertBlog($pdo);

    // Check result and handle redirection
    if($result === true) {
        header("Location: {$_SERVER['HTTP_REFERER']}?success=true");
        exit();
    } else {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=" . urlencode($result));
        exit();
    }
} else {
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}

?>

<?php
session_start();
 require 'includes/is_loged_in.php';
 if(!is_logged_in()) {
     header("Location: /php%20tuto/admin/login.php");
     die();
 }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/upload.css" />
    <title>Add a blog</title>
</head>
<body>

   
   
    <main>
    <a class="goback" href="/php%20tuto/admin/blogs.php">
    <img src="../img/back.svg" alt="back" width="20px" height="20px"/>    
    go back to blogs</a>
    <div>
        <h2>Add Blog</h2>
        <?php
            // Check if the URL parameter 'success' is set and its value is 'true'
            if (isset($_GET['success']) && $_GET['success'] === 'true') {
                // Display a success message
                echo '<div class="success-message">blog added successful!</div>';
            } elseif (isset($_GET['error'])) {
                // Get the error message from the URL parameter
                $error_message = htmlspecialchars($_GET['error']);
                // Display the error message
                echo '<div class="error-message">' . $error_message . '</div>';
            } 
        ?>
       <form action="./includes/blogupload.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Blog Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>
    </div>
    <div>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" required></textarea><br><br>
    </div>
    <div>
        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" required><br><br>
    </div>
    <div>
        <label for="image">Upload Image:</label><br>
        <input type="file" id="image" name="image" required><br><br>
    </div>
    <button type="submit" name="submit">Add Blog</button>
</form>

        </div>
    </main>
</body>
</html>

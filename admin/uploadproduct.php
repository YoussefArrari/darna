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
    <title>Add Product</title>
</head>
<body>

   
    <?php
    if(isset($_GET['error'])) {
        echo "<p>Error: " . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
    <main>
    <a class="goback" href="/php%20tuto/admin/products.php">
    <img src="../img/back.svg" alt="back" width="20px" height="20px"/>    
    go back to stock</a>
    <div>
        <h2>Add Product</h2>
        <?php
            // Check if the URL parameter 'success' is set and its value is 'true'
            if (isset($_GET['success']) && $_GET['success'] === 'true') {
                // Display a success message
                echo '<div class="success-message">Upload successful!</div>';
            } elseif (isset($_GET['error'])) {
                // Get the error message from the URL parameter
                $error_message = htmlspecialchars($_GET['error']);
                // Display the error message
                echo '<div class="error-message">' . $error_message . '</div>';
            } 
        ?>
        <form action="process.php" method="post" enctype="multipart/form-data">
            <div>
            <label for="product_name">Product Name:</label><br>
            <input type="text" id="product_name" name="product_name" required><br><br>
            </div>
            <div>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" required></textarea><br><br>
            </div>
            <div>
                <label for="price">Price:</label><br>
                <input type="number" id="price" name="price" step="0.01" required><br><br>
            </div>
            <div>
                <label for="file">Upload Image:</label><br>
                <input type="file" id="file" name="file" required><br><br>
            </div>
            <button type="submit" name="submit" >Add Product</button>
        </form>
        </div>
    </main>
</body>
</html>

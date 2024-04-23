<?php
 require 'includes/is_loged_in.php';
 session_start();
 if(!is_logged_in()) {
     header("Location: /php%20tuto/admin/login.php");
     die();
 }
// Check if product id is provided in the URL
if(isset($_GET['id'])) {
    // Include database connection file
    require_once "includes/dbh.inc.php";

    // Sanitize and validate product id
    $product_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if($product_id === false || $product_id === null) {
        // Invalid product id provided, redirect with error message
        header("Location: /php%20tuto/admin/products.php.php?error=Invalid product id");
        exit();
    }

    // Prepare and execute SQL query to delete the product
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);

    // Check if product was successfully deleted
    if($stmt->rowCount() > 0) {
        // Product deleted successfully, redirect to upload page with success message
        header("Location: /php%20tuto/admin/products.php?success=Product deleted successfully");
        exit();
    } else {
        // Product not found or deletion failed, redirect with error message
        header("Location:  /php%20tuto/admin/products.php?error=Product not found or deletion failed");
        exit();
    }
} else {
    // Product id not provided in the URL, redirect with error message
    header("Location:  /php%20tuto/admin/products.php?error=Product id not provided");
    exit();
}
?>

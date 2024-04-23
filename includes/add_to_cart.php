<?php
session_start();

// Include database connection file
require_once "dbh.inc.php";

// Check if the product ID is provided
if(isset($_POST['product_id'])) {
    // Check if the user is logged in
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];

        try {
            // Check if the product already exists in the user's cart
            $sql_check = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([$user_id, $product_id]);

            if($stmt_check->rowCount() > 0) {
                // If the product exists, update the quantity
                $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
                $stmt_update = $pdo->prepare($sql_update);
                $stmt_update->execute([$user_id, $product_id]);
            } else {
                // If the product does not exist, insert it into the cart
                $sql_insert = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
                $stmt_insert = $pdo->prepare($sql_insert);
                $stmt_insert->execute([$user_id, $product_id]);
            }

            // Return success response
            echo json_encode(["success" => true]);
            exit();
        } catch(PDOException $e) {
            // Return error response
            echo json_encode(["error" => "Database error"]);
            exit();
        }
    } else {
        // Return error response
        echo json_encode(["error" => "User not logged in"]);
        exit();
    }
} else {
    // Return error response
    echo json_encode(["error" => "Product ID not provided"]);
    exit();
}
?>

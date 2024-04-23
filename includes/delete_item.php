<?php
session_start();

// Include database connection file
require_once "dbh.inc.php";

// Initialize response array
$response = array();
$response['status'] = 'error';
$response['message'] = 'Product ID is not provided.';
// Check if product_id is set in the POST request
if(isset($_POST['product_id'])) {
    // Get the product ID from the POST data
    $product_id = $_POST['product_id'];

    try {
        // Prepare SQL statement to delete the item from the cart
        $user_id = $_SESSION['user_id']; // Assuming the user is logged in
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $product_id]);

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            // Set success response
            $response['status'] = 'success';
            $response['message'] = 'Item deleted successfully.';
        } else {
            // Set error response if the item was not found in the cart
            $response['status'] = 'error';
            $response['message'] = 'Item not found in the cart.';
        }
    } catch (PDOException $e) {
        // Set error response for database errors
        $response['status'] = 'error';
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} else {
    // Set error response if product_id is not set in the POST request
    $response['status'] = 'error';
    $response['message'] = 'Product ID is not provided.';
}

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

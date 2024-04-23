<?php
require_once "dbh.inc.php";
function displayCartItems($pdo) {
    try {
        // Get the user's cart items
        $user_id = $_SESSION['user_id']; // Assuming the user is logged in
        $sql = "SELECT products.product_id, products.product_name, products.price, products.image_urls, cart.quantity FROM cart JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        // Initialize total price
        $total_price = 0;

        // Check if there are any cart items
        if ($stmt->rowCount() > 0) {
            // Loop through each cart item and display its information
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Calculate item price
                $item_price = $row['price'] * $row['quantity'];
                $total_price += $item_price; // Update total price

                // Start cart item div
                echo '<div class="cart-item">';
                echo '<div class="cart-item-info">';
                echo '<img class="cart-img" src="uploads/' . $row['image_urls'] . '" width="150px" alt="' . $row['product_name'] . '" />';
                echo '<div>';
                echo '<div class="cart-item-name">' . $row['product_name'] . '</div>';
                echo '<div class="cart-item-quantity">Quantity: ' . $row['quantity'] . '</div>';
                echo '</div>'; // Close div
                echo '</div>'; // Close cart-item-info

                // Display cart item price and delete button
                echo '<div class="item-right-side">';
                echo '<div class="cart-item-price">' . number_format($item_price, 2) . ' dt</div>';
                echo '<div class="cart-item-delete">';
                echo '<div class="delete-button" onclick="deleteCartItem(' . $row['product_id'] . ')">'; // Call deleteCartItem function with product ID
                echo '<img src="img/close.svg" alt="close" />';
                echo '</div>'; // Close button
                echo '</div>'; // Close cart-item-delete
                echo '</div>'; // Close item-right-side

                echo '</div>'; // Close cart-item
            }
        } else {
            echo "<p>No items in the cart.</p>";
        }
        echo '</div>';
        // Display total price
        echo '<div class="total">';
        echo '<div class="total-text">Total</div>';
        echo '<div class="total-price">' . number_format($total_price, 2) . ' dt</div>';
        echo '</div>'; // Close total
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
function getCartItemCount($pdo) {
   
    try {
        // Get the user's cart items count
        $user_id = $_SESSION['user_id']; // Assuming the user is logged in
        $sql = "SELECT COUNT(*) AS item_count FROM cart WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        // Fetch the item count
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['item_count']; // Return the number of items in the cart
        } else {
            return 0; // Return 0 if no items are found in the cart
        }
    } catch (PDOException $e) {
        // Handle database errors
        return -1; // Return -1 to indicate an error occurred
    }
}
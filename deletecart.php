<?php
session_start();

// Check if product_id is provided via POST
if(isset($_POST['product_id'])) {
    $product_id_to_delete = $_POST['product_id'];
    
    // Check if the cart session variable exists and is not empty
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Iterate through each cart item
        foreach($_SESSION['cart'] as $key => $cart_item) {
            // If the product ID matches the ID to delete, remove it from the cart
            if($cart_item['product_id'] == $product_id_to_delete) {
                unset($_SESSION['cart'][$key]); // Remove the item from the cart array
            }
        }
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>

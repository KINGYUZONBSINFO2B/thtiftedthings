<?php
include 'conn.php';

// Start the session
session_start();

// Check if cart session data exists and is not empty
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Prepare statement for deleting from add_items table
    $stmt_delete_item = $conn->prepare("DELETE FROM add_items WHERE product_id = ?");
    if ($stmt_delete_item === false) {
        echo "Error preparing statement for deleting items: " . $conn->error;
        exit;
    }

    // Loop through cart items and delete each product from add_items table
    foreach ($_SESSION['cart'] as $cart_item) {
        $product_id = $cart_item['product_id'];

        // Bind parameter and execute the prepared statement
        $stmt_delete_item->bind_param("i", $product_id);
        if (!$stmt_delete_item->execute()) {
            echo "Error deleting item from add_items: " . $stmt_delete_item->error;
            exit;
        }
    }

    // Close statement
    $stmt_delete_item->close();

    // Clear the cart session data
    unset($_SESSION['cart']);

    // Redirect back to the previous page or wherever you want
    header("Location: index.php");
    exit;
} else {
    echo "Cart is empty";
}
?>

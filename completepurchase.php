<?php
include 'conn.php';
session_start();

// Process checkout form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize input
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $contactnum = trim($_POST['contactnum']);
    $landmark = trim($_POST['landmark']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit; // Stop script execution
    }

    // Validate phone number (Philippines format)
    if (!preg_match("/^09\d{9}$/", $contactnum)) {
        echo "Invalid phone number format";
        exit; // Stop script execution
    }

    // Start session

    // Insert data into order_summaries table
    $stmt_order_summary = $conn->prepare("INSERT INTO order_summaries (firstname, middlename, lastname, email, contactnum, landmark, product_name, product_price, product_color, product_size, image_data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt_order_summary === false) {
        echo "Error preparing statement for order summaries: " . $conn->error;
        exit;
    }

    // Bind parameters
    $stmt_order_summary->bind_param("sssssssssss", $firstname, $middlename, $lastname, $email, $contactnum, $landmark, $product_name, $product_price, $product_color, $product_size, $image_data);

    // Loop through cart items and insert into order_summaries table
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cart_item) {
            // Assign cart item details to variables
            $product_name = $cart_item['product_name'];
            $product_price = $cart_item['product_price'];
            $product_color = $cart_item['product_color'] ?? null;
            $product_size = $cart_item['product_size'] ?? null;
            $image_data = $cart_item['image_data'];

            // Execute the prepared statement for each cart item
            if (!$stmt_order_summary->execute()) {
                echo "Error inserting record into order summaries: " . $stmt_order_summary->error;
                exit;
            }
        }
}
}
//     // }
//     function display_cart_data(){
//         $cart_data = '';
//     if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
//          $selected_products = isset($_POST['selected_products']) ? explode(',', $_POST['selected_products']) : [];

//         foreach ($_SESSION['cart'] as $cart_item) {
//             if (in_array($cart_item['product_id'], $selected_products)) {
//                 $cart_data= $cart_item['product_name'];
//                 $cart_data= $cart_item['product_price'];
//                 $cart_data= $cart_item['product_color'];
//                 $cart_data= $cart_item['product_size'];
//                 $cart_data= $cart_item['image_data'];
//             }
        

//     }
// }
//     else {
//          $cart_data = "<p>Your cart is empty.</p>";
//     }
//      return $cart_data;
// }
// }
// $cart_data = display_cart_data();
//     $_SESSION['cart_data'] = $cart_data;
     $stmt_order_summary->close();

     header("Location: completed.php");
    exit;


// Close MySQL connection
$conn->close();
?>

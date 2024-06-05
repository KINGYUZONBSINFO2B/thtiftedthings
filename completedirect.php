<?php
session_start(); // Start the session

// Check if the user is not logged in and not already on the cart page
if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) !== 'cart.php') {
    // Set a flag to indicate that the user is not logged in
    $notLoggedIn = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<style>
  
    .btn-green:hover {
      background-color: #28a745;
      color: #fff;
    }
    .inline-buttons form {
      display: inline-block;
    }
  

</style>

<body>
<section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar" class="active">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php">All Products</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="faq.php">FAQS</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
 
                      // Check if the username session variable is set
                      if(isset($_SESSION['username'])) {
                          // If the username session variable is set, display a welcome message with the username
                          echo  "<li class='nav-item'>
                          <a class='nav-link' href='account.php'>". $_SESSION['username']."</a> </li>";
                      } else {
                          // If the username session variable is not set, display a message or login link
                      }
                      ?>
                    <li><a href="cart.php "class="active" >Cart <i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li><a href="account.php " >Account <i class="fa-regular fa-user "></i></a></li>
                    <a href="#" id="close"><i class="fa-solid fa-x"></i></a>   <br>
                </ul>
            </div>
</section>
<?php
 
// Check if the product details are received via POST
if(isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price'])) {
    // Retrieve product details from POST data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_color = $_POST['product_color'];
    $product_size = $_POST['product_size'];

    // Display product details
    echo '<div class="container text-center">';
    echo '<h2>Product Details</h2>';
    echo '<div class="row justify-content-center">';
    echo '<div class="col-md-6 p-3 d-flex justify-content-end">';
    echo '<img src="data:image/jpeg;base64,' . $image_data_base64 . '" class="img-fluid" alt="Product Image" style="width:55%">';
    echo '</div>';
    echo '<div class="col-md-6">';
    echo "<div class='rounded border p-3 mb-3'>";
    echo "<label for='product_name'><strong>Product Name:</strong></label>";
    echo "<p id='product_name'>$product_name</p>";
    echo "</div>";
    echo "<div class='rounded border p-3 mb-3'>";
    echo "<label for='product_price'><strong>Product Price:</strong></label>";
    echo "<p id='product_price'>PHP $product_price</p>";
    echo "</div>";
    echo "<div class=' p-3 mb-3 rounded border'>";
    echo "<label for='product_price'><strong>Product Color:</strong></label>";
    echo "<p id='product_price'>PHP $product_color</p>";
    echo "</div>";
    echo "<div class=' p-3 mb-3'>";
    echo "<label for='product_price'><strong>Product Size:</strong></label>";
    echo "<p id='product_price'>PHP $product_size</p>";
    echo "</div>";
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
} else {
    // If product details are not received via POST, display an error message
    echo "<p>Error: Product details not found.</p>";
}
?>
<?php
include 'conn.php';

// Retrieve data from database
$sql = "SELECT * FROM order_summaries ORDER BY checkout_id DESC LIMIT 1"; // Assuming 'id' is the primary key
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<div class="row mt-5">';
      echo '    <div class="col-md-6 offset-md-3">';
      echo '        <div class="card">';
      echo '            <div class="card-body">';
      echo '                <h2 class="card-title text-center pb-2">Customer Information</h2>';
      echo '                <div class="form-group">';
      echo '                    <label for="firstName">First Name:</label>';
      echo '                    <input type="text" class="form-control" id="firstName" value="' . (isset($row) ? htmlspecialchars($row["firstname"]) : '') . '" readonly>';
      echo '                </div>';
      echo '                <div class="form-group">';
      echo '                    <label for="middleName">Middle Name:</label>';
      echo '                    <input type="text" class="form-control" id="middleName" value="' . (isset($row) ? htmlspecialchars($row["middlename"]) : '') . '" readonly>';
      echo '                </div>';
      echo '                <div class="form-group">';
      echo '                    <label for="lastName">Last Name:</label>';
      echo '                    <input type="text" class="form-control" id="lastName" value="' . (isset($row) ? htmlspecialchars($row["lastname"]) : '') . '" readonly>';
      echo '                </div>';
      echo '                <div class="form-group">';
      echo '                    <label for="email">Email Address:</label>';
      echo '                    <input type="email" class="form-control" id="email" value="' . (isset($row) ? htmlspecialchars($row["email"]) : '') . '" readonly>';
      echo '                </div>';
      echo '                <div class="form-group">';
      echo '                    <label for="contactNumber">Contact Number (Philippines):</label>';
      echo '                    <input type="text" class="form-control" id="contactNumber" value="' . (isset($row) ? htmlspecialchars($row["contactnum"]) : '') . '" readonly>';
      echo '                </div>';
      echo '                <div class="form-group">';
      echo '                    <label for="address">Address (with Landmarks):</label>';
      echo '                    <textarea class="form-control" id="address" rows="3" readonly>' . (isset($row) ? htmlspecialchars($row["landmark"]) : '') . '</textarea>';
      echo '                </div>';
      echo '            </div>';
      echo '        </div>';
      echo '    </div>';
      echo '</div>';
      
        // You can display additional fields here if needed
    }
} else {
    echo "0 results";
}

$conn->close();
?>



</body>
</html>
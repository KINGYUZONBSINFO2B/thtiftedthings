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
  <link rel="icon" type="image/png" href="icon.png">  

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

<body style="background-color: ivory; font-family:cursive;">
<section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar">
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
            <div id="mobile">
                <i id="bar" class="fa-solid fa-bars"></i>
                
            </div>
</section>



<!-- Main content -->
<?php 
 include "conn.php";
// Check if the cart session variable exists and is not empty
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Calculate total price initially as 0
    $total_price = 0;
    $selected_products = isset($_POST['selected_products']) ? (is_array($_POST['selected_products']) ? $_POST['selected_products'] : explode(',', $_POST['selected_products'])) : array();
    
    // Iterate through each cart item
    foreach ($_SESSION['cart'] as $cart_item) {
        // Decode image data from base64
        $image_data_binary = base64_decode($cart_item['image_data']);

        // Display product details
        echo '<div class="container p-3 mb-3">';
        echo '<div class="row">';
        echo '<div class="col-md-1  d-flex justify-content-center align-items-center">';
        // Add checkbox for each product
      
        echo '<input type="checkbox" class="product-checkbox" name="selected_products[]" value="' . $cart_item['product_id'] . '" onchange="updateTotalPrice()" style="width:20px;height:20px;" checked>'; // Retain checked state
        echo '</div>';
        echo '<div class="col-md-2 ">';
        // Use the decoded image data to display the image
        echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data_binary) . '" style="width: 100%;" alt="Product Image">';
        echo '</div>';
        echo '<div class="col-md-2 text-center ">';
        echo '<p >' . $cart_item['product_name'] . '</p>';
        echo '<p style="display: inline;">PHP ' . $cart_item['product_price'] . '</p>';
        echo '</div>';
        
        echo '<div class="col-md-2 text-center">';
        echo '<p>Quantity (Single product)</p>';
        echo '<div class="quantity" style="font-size: 15px;">';
        // Quantity buttons can be added here
        echo '<button style="border-style: none;" class="btn disabled">-</button>';
        echo '<p style="display: inline; ">1</p>'; // Assuming quantity is not editable
        echo '<button style="border-style: none; " class="btn disabled">+</button>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-2 text-center">';
        echo '<p>Total</p>';
        echo '<p>PHP ' . $cart_item['product_price'] . '</p>';
        echo '</div>';
        echo '<div class="col-md-2 d-flex justify-content-center">';
        echo '<form action="deletecart.php" method="post" style="display: inline;">'; // Make the form inline
        echo '<input type="hidden" name="product_id" value="' . $cart_item['product_id'] . '">';
        echo '<button type="submit" class="btn btn-danger">Delete</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Update total price
        $total_price += $cart_item['product_price'];
    }
    // Display total price container
echo '<div id="total-price-container" class="container">';
echo '<div class="d-flex justify-content-end">';
echo "<label for='total'>Total Price:</label>";
echo '<p id="total-price" class="inline-block">PHP ' . $total_price . '</p>';
echo '<form action="checkout.php" method="post" style="display: inline;" onsubmit="return validateForm()">';
echo '    <input type="hidden" id="selectedProductsInput" name="selected_products">';
echo '    <button type="submit" class="btn btn-primary mx-1">Checkout</button>';
echo '</form>';

echo "</div>";
echo "</div>";
} else {
    // Cart is empty
    echo "<p>Your cart is empty</p>";
}
?>



<!-- JavaScript to update total price when checkbox is clicked -->
<script src="java.js"></script>
<script>
    function updateTotalPrice() {
        var totalPrice = 0;
        var checkedProducts = []; // Array to store IDs of checked products
        var checkboxes = document.querySelectorAll('.product-checkbox:checked');
        checkboxes.forEach(function(checkbox) {
            var productId = checkbox.value;
            checkedProducts.push(productId); // Add product ID to the array
            // Iterate through session cart to find the product price
            <?php foreach($_SESSION['cart'] as $cart_item): ?>
                if ('<?php echo $cart_item['product_id']; ?>' === productId) {
                    totalPrice += <?php echo $cart_item['product_price']; ?>;
                }
            <?php endforeach; ?>
        });
        // Update total price display
        var totalPriceDisplay = document.getElementById('total-price');
        totalPriceDisplay.textContent = 'PHP ' + totalPrice.toFixed(2);

        // Pass the IDs of checked products to your checkout page or process them further
        // Example: Redirect to checkout page with checked product IDs in query string
        var checkedProductsString = checkedProducts.join(',');
     }
</script>

<script>
    function validateForm() {
        // Select all checkboxes with the .product-checkbox class
        var checkboxes = document.querySelectorAll('.product-checkbox');

        // Create an array to store the IDs of checked products
        var checkedProductIDs = [];

        // Iterate over all checkboxes and store the IDs of checked products
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedProductIDs.push(checkbox.value);
            }
        });

        // If no products are checked, display an alert and prevent form submission
        if (checkedProductIDs.length === 0) {
            alert('Please select at least one product to proceed to checkout.');
            return false; // Prevent form submission
        }

        // Store the checked product IDs in a hidden input field in the form
        document.getElementById('selectedProductsInput').value = checkedProductIDs.join(',');

        // Allow form submission to proceed
        return true;
    }
</script>
















    <!-- Check if user is not logged in and display a prompt -->
    <?php if (isset($notLoggedIn) && $notLoggedIn): ?>
    <!-- Display alert and login link if the user is not logged in -->
    <div class="container">
        <div class="alert alert-warning" role="alert">
            You need to <a href="account.php" class="alert-link">log in</a> to access your cart.
        </div>
    </div>
<?php endif; ?>

  <!-- Scripts -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var toggleButton = document.getElementById("navbarToggle");
      var navbarLinks = document.getElementById("navbarLinks");
      var navlink = document.getElementsByClassName("nav-link");

      toggleButton.addEventListener("click", function() {
        navbarLinks.classList.toggle("show");
      });

      // Close navbar when clicking outside
      document.addEventListener("click", function(event) {
        if (!navbarLinks.contains(event.target) && !toggleButton.contains(event.target)) {
          navbarLinks.classList.remove("show");
        }
      });
    });

    document.getElementById('searchToggle').addEventListener('click', function() {
      var input = document.querySelector('.form-inline input');
      input.style.display = input.style.display === 'none' ? 'block' : 'none';
    });

    let slideIndex = 0;

    function showSlides() {
      let slides = document.getElementsByClassName("slide");
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {
        slideIndex = 1
      }    
      slides[slideIndex-1].style.display = "block";
      setTimeout(showSlides, 3000); // Change image every 3 seconds
    }

    showSlides();
  </script>
</body>
</html>

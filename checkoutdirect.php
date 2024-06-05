<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>src= "java.js"</script>
  
    <!-- Include your JavaScript file -->
      <link rel="stylesheet" href="style.css">
   
  <style>
    /* Add your custom styles here if needed */
    .footer-navbar {
        padding: 15px 0;
        text-align: center;
    }
    .footer-navbar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: center;
    }
    .footer-navbar li {
        display: inline;
        margin-right: 20px;
        
    }
    .footer-navbar li:last-child {
        margin-right: 0;
        
    }
    .footer-navbar li a {
        color: #000; /* Change link color if needed */
        text-decoration: none;
        font-weight: bold;
    }
    .footer-social-icons {
        text-align: center;
        margin-top: 20px;
    }
    .footer-social-icons a {
        color: #000; /* Change social icon color if needed */
        text-decoration: none;
        margin: 0 10px;
    }
 
 
</style>
<body style="background-color: ivory; font-family:cursive;">
<body>
  <!-- Navbar -->
  <section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar" class="active">
                    <li><a href="index.php" class="active">Home</a></li>
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
                    <li><a href="cart.php ">Cart <i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li><a href="account.php ">Account <i class="fa-regular fa-user"></i></a></li>
                    <a href="#" id="close"><i class="fa-solid fa-x"></i></a>   
                </ul>
            </div>

            <div id="mobile">
                <i id="bar" class="fa-solid fa-bars"></i>
                
            </div>
</section>

<?php
// Start the session
include 'conn.php';
 
// Check if the product details are received via POST
if(isset($_POST['product_ids']) && isset($_POST['product_names']) && isset($_POST['product_prices'])) {
    // Retrieve product details from POST data
    $product_ids = $_POST['product_ids'];
    $product_names = $_POST['product_names'];
    $product_prices = $_POST['product_prices'];
    $product_colors = $_POST['product_colors'];
    $product_sizes = $_POST['product_sizes'];


  
     $sql = "SELECT image_data FROM add_items WHERE product_id = $product_ids";
    $result = $conn->query($sql);

    // Check if the query was successful and if an image is found
    if ($result && $result->num_rows > 0) {
        // Fetch the image data
        $row = $result->fetch_assoc();
        $image_data = $row['image_data'];
        echo '<div class="container text-center">';
        echo '<h2>Product Details</h2>';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6 p-3 d-flex justify-content-end">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" class="img-fluid" alt="Product Image" style = "width:55%">';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo "<div class='rounded border p-3 mb-3'>";
        echo "<label for='product_name'><strong>Product Name:</strong></label>";
        echo "<p id='product_name'>$product_names</p>";
        echo "</div>";
        echo "<div class='rounded border p-3 mb-3'>";
        echo "<label for='product_price'><strong>Product Price:</strong></label>";
        echo "<p id='product_price'>PHP $product_prices</p>";
        echo "</div>";
        echo "<div class=' p-3 mb-3 rounded border'>";
        echo "<label for='product_price'><strong>Product Color:</strong></label>";
        echo "<p id='product_price'>PHP $product_colors</p>";
        echo "</div>";
        echo "<div class=' p-3 mb-3'>";
        echo "<label for='product_price'><strong>Product Size:</strong></label>";
        echo "<p id='product_price'>PHP $product_sizes</p>";
        echo "</div>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
     

        // You can add more product details here if needed
   
    // Close the database connection
    $conn->close();
}
 else {
    // If product details are not received, display an error message
    echo "<p>Error: Product details not found.</p>";
}
?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Checkout</h2>
                <form id="checkoutForm" method="post" action="completepurchase.php">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                        <input type="text" class="form-control" name="middlename" id="middleName">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="contactNumber">Contact Number (Philippines):</label>
                        <input type="text" class="form-control" id="contactNumber" name="contactnum" placeholder="09XXXXXXXXX" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Complete Address (with Landmarks):</label>
                        <textarea class="form-control" id="address" name="landmark" rows="3" required></textarea>
                    </div>
                    <!-- Hidden input field to hold the order ID -->
                    <input type="hidden" id="orderId" name="orderId" value=""> <!-- Replace '123' with your actual order ID -->
                    <input type="hidden" name="product_ids" value="<?=$row['product_id'];?>">
                    <input type="hidden" name="product_names" value="<?=$row['product_name'];?>">
                    <input type="hidden" name="product_prices" value="<?=$row['product_price'];?>">
                    <input type="hidden" name="product_colors" value="<?$row['product_color'];?>">
                    <input type="hidden" name="product_sizes" value="<?$row['product_size'];?>">                    
                    <button type="submit" class="btn btn-primary">Complete purchase</button>
                    <!-- Go back button -->
                    <a href="cart.php" class="btn btn-secondary">Go back</a>
                </form>
                <!-- Anchor tag for messaging -->
                <h5>Message<a href="" class="my-2"> Thrift Things </a>for Payment</h5>
            </div>
        </div>
    </div>
</div>




  

    
    <footer class="m-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light footer-navbar">
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavFooter">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" id="nav-link" href="index.html">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">ALL PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">CATEGORIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacts">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </nav>
      
        <div class="footer-social-icons">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </footer>
      
      
      
      
      
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="script.js"></script>
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
      showSlides();
      
      function showSlides() {
        let slides = document.getElementsByClassName("slide");
        for (let i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
           
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        slides[slideIndex-1].style.display = "block";
         setTimeout(showSlides, 3000); // Change image every 3 second
      }
        </script>
      
</body>
</html>

<?php
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
</head>
<body style="background-color: ivory; font-family:cursive;">
  <!-- Navbar -->
  <section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="product.php">All Products</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="faq.php">FAQS</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                      session_start();

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
include 'conn.php';

// Check if product details are received via POST
if(isset($_POST['product_ids']) && isset($_POST['product_names']) && isset($_POST['product_prices'])) {
    // Retrieve product details from POST data
    $product_ids = $_POST['product_ids'];
    $product_names = $_POST['product_names'];
    $product_prices = $_POST['product_prices'];
    $product_colors = $_POST['product_colors'];
    $product_sizes = $_POST['product_sizes'];
    $layout = '';
    $layout = "<div class='col-md-6 offset-md-3'>
            <div class='card'>
             <div class='productphoto m-3'>
            <div class='card-body'>
            <h2 class='card-title text-center pb-2'>Product Summary</h2>";


    // Display product details
    echo '<div class="form-group d-flex justify-content-center">';

    // Assuming you have image data in $_POST, adjust this part accordingly
    $image_data_base64 = $_POST['image_data']; // Assuming image data is posted
    $image_data = base64_decode($image_data_base64);

    if (!empty($image_data)) {
        echo '<img src="data:image/jpeg;base64,' . $image_data_base64 . '" alt="Product Image" style="width:30%" class="p-2">';
    } else {
        echo "Error: Image data is empty.";
    }
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="productName">Product Name:</label>';
    echo '<input type="text" class="form-control" id="productName" value="' . $product_names . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="productPrice">Price:</label>';
    echo '<input type="text" class="form-control" id="productPrice" value="' . $product_prices . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="productSize">Size:</label>';
    echo '<input type="text" class="form-control" id="productSize" value="' . $product_sizes . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="productColor">Color:</label>';
    echo '<input type="text" class="form-control" id="productColor" value="' . $product_colors . '" readonly>';
    echo '</div>';
} 
// Check if cart data is stored in session
?>
                </div>
            </div>
        </div>
    </div>
</div>
 
<div class=''>
               <h2 class='card-title text-center pb-2'>Product Summary</h2>

<?php
if (isset($_SESSION['cart_data'])) {
    // Retrieve cart data from session
    $cart_data = $_SESSION['cart_data'];

     echo $cart_data;

    // Optionally, you can unset or clear the session variable after displaying it
    // unset($_SESSION['cart_data']);
} else {
    // If cart data is not found in session, display a message
    echo "<p>No cart data found.</p>";
}
?>
         </div>
            </div>
        </div>
    </div>
</div>



<?php
include 'conn.php';

// Retrieve data from database
$sql = "SELECT * FROM order_summaries ORDER BY order_id DESC LIMIT 1"; 
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
      
     }
} else {
    echo "0 results";
}

$conn->close();
?>
        <!-- Add this HTML code where you want to display the button -->
<div class="container text-center justify-content-center">
    <form id="deleteForm" action="delete_product.php" method="post">
        <!-- You can add any additional hidden input fields here if needed -->
        <button type="submit" class="btn btn-outline-primary">Complete ALL</button>
    </form>
</div>

<!-- Add this JavaScript code to handle form submission -->
<script>
    // Wait for the document to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Find the deleteForm element
        var form = document.getElementById('deleteForm');

        // Add event listener for form submission
        form.addEventListener('submit', function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Redirect to delete_product.php
            window.location.href = 'delete_product.php';
        });
    });
</script>


 <footer class="footer bg-white text-dark py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Contact</h4>
                        <p><strong>Address:</strong> Brgy Uno Alaminos, Laguna </p>
                        <p><strong>Phone:</strong> 09456743221 </p>
                        <p><strong>Hours:</strong> Brgy Uno Alaminos, Laguna </p>
                    </div>
                    <div class="col-md-6">
                        <h4>Follow us</h4>
                        <div class="social-icons">
                            <a href="https://www.facebook.com/profile.php?id=61555989808165"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-tiktok"></i></a>
                            <a href="https://www.instagram.com/yanoowho_/"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="product.php">Shop</a></li>
                            <li><a href="categories.php">Categories</a></li>
                            <li><a href="faq.php">FAQs</a></li>
                            <li><a href="contact.php">Contacts</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4>My Account</h4>
                        <ul class="list-unstyled">
                            <li><a href="cart.php">View Cart</a></li>
                            <li><a href="account.php">Log in</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <p>&copy; 2024, HTML & CSS, Ian G, Maloles King Christopher Yuzon</p>
                </div>
            </div>
        </footer>
        <script src="java.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Retrieve the order ID from the URL
    var orderId = <?php echo $_GET['order_id']; ?>;

    // Send the order ID to adminorder.php using Ajax
    $.ajax({
        url: 'adminorder.php',
        type: 'POST',
        data: { order_id: orderId },
        success: function(response){
            // Handle success response, if needed
            console.log(response);
        },
        error: function(xhr, status, error){
            // Handle error response, if needed
            console.error(error);
        }
    });
});
</script>








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

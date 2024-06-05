<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thrift Things</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="icon.png">  
<style>  
    
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
        color: #000;
        text-decoration: none;
        font-weight: bold;
    }
    .footer-social-icons {
        text-align: center;
        margin-top: 20px;
    }
    .footer-social-icons a {
        color: #000;
        text-decoration: none;
        margin: 0 10px;
    }
    .form-inline input {
        display: none;
    }
    
  /* Showcase styles */
 
  .fullscreen-bg {
    width: 100%;
    height: 100vh;
    object-fit: cover;
  }
  .slideshow-container {
position: relative;
width: 100%;
margin: auto;
    }

.slide {
display: none;
animation-name: slide;
animation-duration: 1s;
    }

.fade {
animation-name: fade;
animation-duration: 2s;
}
.bg{
background-image: url(caps.jpg);
background-repeat: no-repeat;

}
.img-container, img{
    width: 190% ;
}

 
  </style>
  <style>
    a{
      text-decoration: none;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        padding: 20px;
    
    }
    
    .grid-item {
        
        padding: 20px;
        text-align: center;
    }
    
    .grid-item img {
        max-width: 100%;
        height: auto;
    }
   
    .fullscreen-bg {
    width: 100%;
    height: 100vh; /* This will make the image cover the entire viewport height */
    object-fit: cover; /* This will make sure the image covers the entire container without stretching */
}  
 .grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 columns */
    gap: 20px; /* Gap between grid items */
    
}
@media (max-width: 768px) {
  #sm-banner .banner-box,
  #sm-banner .banner-box2 {
    width: 100vw; /* Set width to full viewport width */
    max-width: 100%; /* Ensure width does not exceed viewport width */
    height: 50vh;
    background-size: cover;
    background-position: center;
    margin: 10px 0; /* Add margin for spacing between boxes */
    padding: 20px; /* Adjust padding for better readability */
    text-align: center;
    color: white; /* Set text color to contrast with background */
    
  }
  .grid-container {
        grid-template-columns: repeat(1, 1fr); /* 2 columns */
    }
    .grid-item img{
      width: 100%;
    }
 
    
  }
  .ITEM:hover{
  border: 3px solid skyblue;
  border-radius: 25px;
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


        <section id="hero">
            <h4>100% Original Products</h4>
            <h2>Good Deals</h2>
            <h1>On all products</h1>
            <p>Save more with if you buy aspack!  </p>
        <a href="product.php"> <button class="btn">Shop Now</button></a>
        </section>

        <section>
        <div class="slider-frame ">
            <div class="slide-images">
                  <div class="img-container d-flex justify-content-center">
                      <img src="img/banners.jpeg">
                  </div>
                  <div class="img-container d-flex justify-content-center">
                      <img src="img/bg2.jpeg">
                  </div>
                  <div class="img-container d-flex justify-content-center">
                      <img src="img/bg3.jpeg">
                  </div>
                  <div class="img-container d-flex justify-content-center">
                      <img src="img/bg4.jpeg">
                  </div>
                  
            </div>
        </section>
        <div class="grid-container">
        <?php
require "conn.php"; // Ensure this file contains the database connection setup

// Modify the SQL query to fetch only 8 records
$sql = "SELECT * FROM add_items LIMIT 6"; // Select all columns from the add_items table, but limit the results to 8
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $starRating = $row['MT']; // Assuming 'MT' is the column containing the star rating in your database

        // Generate the HTML for star rating dynamically
        $starsHTML = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $starRating) {
                $starsHTML .= '<i class="fa-solid fa-star checked" style="color:yellow;"></i>';
            } else {
                $starsHTML .= '<i class="fa-solid fa-star"></i>';
            }
        }
?>
        <div class="grid-item">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ITEM">
                        <!-- Pass product_id as a parameter in the URL -->
                        <!-- Hide the product_id using CSS -->
                             <div class='grid-item'>
                                <img style="border-radius: 25px;" src='data:image/jpeg;base64,<?= base64_encode($row['image_data']) ?>' alt='<?= htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') ?>' class='img-fluid mb-2'>
                                <h4><?= htmlspecialchars($row["product_name"], ENT_QUOTES, 'UTF-8') ?></h4>
                                 <h5>PHP <?= htmlspecialchars($row["product_price"], ENT_QUOTES, 'UTF-8') ?></h5>
                                <?= $starsHTML ?>
                                <!-- Hide the product_id using CSS -->
                                <p class="product-id" style="display: none;"><?= htmlspecialchars($row["product_id"], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "No products found";
}
?>
</div>


        

  
  
        <div class="container-fluid">
        <section id="banner" class="section-m1">
            <h4>Hey there'</h4>
            <h2>Wanna see more of these? <span>click here</span> at Thrift Things</h2>
            <a href="product.php" class=" btn btn-outline-primary">Explore More</a>
        </section>
        </div>

        <section id="sm-banner" class="section-m1 rounded container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="banner-box rounded">
        <h4>See What kinds of Apparel we sell</h4>
        <h2>Find It out</h2>
        <span>Authentic Quality Deals</span>
        <a href="categories.php" class="white btn btn-outline-primary">Learn More</a>
      </div>
    </div>
    <div class="col-md-6">
      <div class="banner-box2 rounded">
        <h4>Come check us Out</h4>
        <h2>Reach us in!</h2>
        <span>Click now</span>
        <a href="contact.php" class="white btn btn-outline-primary">Learn More</a>
      </div>
    </div>
  </div>
</section>

    
        <footer class="footer bg-white text-dark py-5" style="display: block;">
                <div class="container-fluid px-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Contact</h4>
                            <p><strong>Address:</strong> Brgy Uno Alaminos, Laguna </p>
                            <p><strong>Phone:</strong> 09301975178 </p>
                            <p><strong>Hours:</strong> 9:00 - 5:00 </p>
                        </div>
                        <div class="col-md-6">
                            <h4>Follow us</h4>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/profile.php?id=61555989808165&mibextid=ZbWKwL"><i class="fab fa-facebook"></i></a>
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href="https://www.instagram.com/thriftthings385?igsh=aWZ3aGx1Z3p3N2R6"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Quick Links</h4>
                            <ul class="list-unstyled">
                                <li><a href="product.html">Shop</a></li>
                                <li><a href="categories.php">Categories</a></li>
                                <li><a href="faq.php">FAQS</a></li>
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
</body>
</html>


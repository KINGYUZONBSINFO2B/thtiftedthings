<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="icon.png">  

  <title>Products</title>
</head>
<body style="background-color: ivory; font-family:cursive;">
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
    .showcase{
      width: 100%;
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


.ITEM:hover{
  border: 3px solid skyblue;
  border-radius: 15px;
}
img{
  border-radius: 15px;
 
}
/* For small screens (cellphones) */
@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: repeat(1, 1fr); /* 2 columns */
    }
    .grid-item img{
      width: 100%;
    }
}
.product-id{
  display: none;
}
</style>

<section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php" class="active">All Products</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="faq.php">FAQs</a></li>
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



<div class="row">
  <div class="col-md-12 mt-5 text-center">
    <h2>All Products</h2>
    <p>All Thrift Things Collections</p>
  </div>
</div>

<div class="grid-container">
     <?php
    require "conn.php";
    $sql = "SELECT * FROM add_items"; // Select all columns from the add_items table
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $starRating = $row['MT']; // Assuming 'material_quality' is the column containing the star rating in your database

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
                            <a href='description.php?product_id=<?= $row['product_id'] ?>' class='item' style='text-decoration: none; color: black;'>
                                <div class='grid-item'>
                                    <img src='data:image/jpeg;base64,<?= base64_encode($row['image_data']) ?>' alt='<?= $row['product_name'] ?>' class='img-fluid mb-2'>
                                    <h4><?= $row["product_name"] ?></h4>
                                    <p><?= $row['product_desc']?></p>
                                    <h5>PHP <?= $row["product_price"]  ?></h5>
                                    <?= $starsHTML?>
                                    <!-- Hide the product_id using CSS -->
                                    <p class="product-id" style="display: none;"><?= $row["product_id"] ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "<p>No products found</p>";
    }
?>

</div>

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="icon.png">  

    <title>Categories</title>
    <style>
        
    .overlay-link {
    position: relative;
    display: block;
    text-decoration: none;
}

.overlay-link::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1; /* Ensure the overlay is above other content */
    text-decoration: none;
}


#banner {
    position: relative;
    z-index: 2; /* Ensure the content is above the overlay */
    /* Your existing styles for the banner */
}
.catdess:hover{
    margin: 2px;
}

    </style>
</head>
<body style="background-color: ivory; font-family:cursive;">
    


<section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php">All Products</a></li>
                    <li><a href="categories.php" class="active">Categories</a></li>
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

<section>
    
<div class="container-fluid catdess">
    <a href="categoryopen.php?category=T-shirts" class="overlay-link" style="text-decoration: none;">
        <section id="banner" class="section-m1 rounded">
            <h4>T Shirts</h4>
            <h2>See all <span>Authentic </span>Streetwear Graphic Tees</h2>
            <button class="btn btn-outline-primary">Click here</button>
        </section>
    </a>
</div>

<div class="container-fluid catdess">
    <a href="categoryopen.php?category=Hoodies" class="overlay-link" style="text-decoration: none;">
        <section id="banner1" class="section-m1 rounded">
            <h4>Hoodies</h4>
            <h2>Take a look at <span>100% authentic</span> Hoodies </h2>
            <button class="btn btn-outline-primary">Click here</button>
        </section>
    </a>
</div>

<div class="container-fluid catdess">
    <a href="categoryopen.php?category=Caps" class="overlay-link" style="text-decoration: none;">
        <section id="banner2" class="section-m1 rounded">
            <h4>Caps</h4>
            <h2>Best caps with different<span>Themes</span> </h2>
            <button class="btn btn-outline-primary">Click here</button>
        </section>
    </a>
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

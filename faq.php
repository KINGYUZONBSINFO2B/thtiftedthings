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

        <style>
          .question{
              border: 1px solid black;
              border-radius: 10px;
              padding: 15px;
          }
          .answer{
              border: 1px solid black;
              border-radius: 10px;
              padding: 15px;
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
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="faq.php" class="active">FAQs</a></li>
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

  

  <div class="container mt-5">
    <h1 class="text-center mb-5">Frequently Asked Questions</h1>
    
    <?php
    // Include the database connection file
    include "conn.php";

    // Retrieve FAQ entries from the database
    $query = "SELECT * FROM faq";
    $result = mysqli_query($conn, $query);

    // Check if there are any rows returned
    if ($result && mysqli_num_rows($result) > 0) {
        // Loop through each row to display FAQ items
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="row faq-item">
            <div class="col-md-6">
                <h4 class="question"><?php echo htmlspecialchars($row['q1']); ?></h4>
            </div>
            <div class="col-md-6">
                <p class="answer"><?php echo htmlspecialchars($row['an1']); ?></p>
            </div>
        </div>
        
        <div class="row faq-item">
            <div class="col-md-6 order-md-1">
                <h4 class="question"><?php echo htmlspecialchars($row['q2']); ?></h4>
            </div>
            <div class="col-md-6 order-md-2">
                <p class="answer"><?php echo htmlspecialchars($row['an2']); ?></p>
            </div>
        </div>
        
        <div class="row faq-item">
            <div class="col-md-6">
                <h4 class="question"><?php echo htmlspecialchars($row['q3']); ?></h4>
            </div>
            <div class="col-md-6">
                <p class="answer"><?php echo htmlspecialchars($row['an3']); ?></p>
            </div>
        </div>
        
        <!-- Add more FAQ items as needed -->
    <?php
        }
    } else {
        // Handle the case where no FAQ entries are found
        echo "<p>No FAQ entries found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</div>

    <!-- Bootstrap JS (optional, for dropdowns) -->
    
    <script src="java.js"></script>
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
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Quick Links</h4>
                            <ul class="list-unstyled">
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="#">Categories</a></li>
                                <li><a href="#">FAQS</a></li>
                                <li><a href="#">Contacts</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>My Account</h4>
                            <ul class="list-unstyled">
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Log in</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p>&copy; 2024, HTML & CSS, Ian G, Maloles King Christopher Yuzon</p>
                    </div>
                </div>
</footer>
  
</body>
</html>

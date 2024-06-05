<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="index.js">
  <link rel="icon" type="image/png" href="icon.png">  
  <title>Category</title>
</head>
<body style="background-color: ivory; font-family:cursive;">
<style>
    a{
      text-decoration: none;
    }
    
    body{
      background-color: ivory;
       color: black;
      width: 100%;
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
/* For large screens (desktops and tablets) */
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 4 columns */
    gap: 20px; /* Gap between grid items */
}
.item:hover{
  border: 1px solid skyblue;
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
</style>

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


  <div class="text-center mt-3">
  <h1><?php echo $_GET['category']; ?></h1>
  </div>
    <div class="grid-container">
        <?php
       require'conn.php';
        
        // Prepare and execute SQL query
        $category = $_GET['category'];
        $sql = "SELECT * FROM add_items WHERE product_category = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if there are any products available
        if ($result->num_rows > 0) {
            // Display items
            while ($row = $result->fetch_assoc()) {
                // Generate the HTML for star rating dynamically
                $starRating = $row['MT'];
            $starsHTML = '';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $starRating) {
                    $starsHTML .= '<i class="fa-solid fa-star checked" style="color:yellow;"></i>';
                } else {
                    $starsHTML .= '<i class="fa-solid fa-star"></i>';
                }
            }
                echo "<div class='grid-item'>";
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-md-12 ITEM'>";
                echo "<a href='description.php?product_id=" . $row['product_id'] . "' class='item' style='text-decoration: none; color: black;'>";
                echo "<div class='grid-item'>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['image_data']) . "' alt='" . $row['product_name'] . "' class='img-fluid mb-2'>";
                echo "<h4>" . $row["product_name"] . "</h4>";
                echo "<p>" . $row['product_desc'] . "</p>";
                echo  $starsHTML;
                echo "<h5>PHP " . $row["product_price"] . "</h5>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // No products found for the selected category
            echo "<p>No products yet .</p>";
        }
        
        // Close connection
        $stmt->close();
        $conn->close();
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
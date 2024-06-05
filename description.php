
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
 
  <title>Product Description</title>
</head>
<body  style="background-color: ivory; font-family:cursive;" class="pb-5">
   <style>
    a{
      text-decoration: none;
      color: black;
    }
    
    body{
      background-color: ivory;
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      color: black;
      width: 100%;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        padding: 20px;
    }
    
    

.item:hover{
  border: 1px solid black;
}
.cart{
  height: 15px;
}

.navbar {
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }
    full-height {
      height: 100vh; /* 100% of the viewport height */
      border: 2px solid #000; /* Adding border for visibility */
    }
    .half-height {
      height: 50%; /* Half of the parent's height */
      border-right: 2px solid #000; /* Adding border to cut it by half */
    }
    .checked{
      color: orange;
    }
 
    
/* For small screens (cellphones) */
@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: repeat(2, 1fr); /* 2 columns */
    }
    .grid-item img{
      width: 100%;
    }
}
</style>
<!-- NAV BAR -->
<section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php" class="active">All Products</a></li>
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

                    <li><a href="account.php ">Account<i class="fa-regular fa-user"></i></a></li>
                    <a href="#" id="close"><i class="fa-solid fa-x"></i></a>   
                </ul>
            </div>

            <div id="mobile">
                <i id="bar" class="fa-solid fa-bars"></i>
                
            </div>
</section>

<?php
require "conn.php";

// Start or resume the session
 
// Check if a product ID is provided in the URL
if(isset($_GET['product_id'])) {
    // Get the product ID from the URL
    $product_id = $_GET['product_id'];

    // Query the database to get the details of the selected product
    $sql = "SELECT * FROM add_items WHERE product_id = $product_id"; // Assuming 'id' is the primary key of your 'add_items' table
    $result = $conn->query($sql);

    // Check if the query returned any result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $starRating = $row['MT'];  

        $starsHTML = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $starRating) {
                $starsHTML .= '<i class="fa-solid fa-star checked"></i>';
            } else {
                $starsHTML .= '<i class="fa-solid fa-star mb-3"></i>';
            }
        }
        
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the product is already in the cart
        $product_already_in_cart = false; // Initialize the variable
        foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                $product_already_in_cart = true; // Set to true if product is found in cart
                break; // Exit the loop since we found the product
            }
        }

        // If product not already in cart and Add to Cart button is clicked, add the product to cart
        if(isset($_POST['add_to_cart']) && !$product_already_in_cart) {
            $image_data_base64 = base64_encode($row['image_data']);
            $_SESSION['cart'][] = array(
                'product_id' => $product_id,
                'product_name' => $row['product_name'],
                'product_price' => $row['product_price'],
                'product_color' => $row['product_color'],
                'product_size' => $row['product_size'],

                'image_data' => $image_data_base64  
            );
           
        }
        
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-5">
            <img src="data:image/jpeg;base64,<?= base64_encode($row['image_data']) ?>" alt="<?= $row['product_name'] ?>" style="width: 75%; margin: 10%; ">
        </div>
        <div class="col-12 col-md-7 " style="margin-top: 10px;">
            <div class="desc" style="margin-top: 18%; margin-left: 15%;">
                <h3><?= $row['product_name'] ?></h3>
                <p>Size: <?= $row['product_size'] ?></p>
                <p>Description: <?= $row['product_desc']?></p>
                <p>Color: <?= $row['product_color'] ?></p>
                <p>Price: PHP <?= $row['product_price'] ?></p>
                <br>
                <h5 class="pt-3 mb-2">Material Quality</h5>
                <?= $starsHTML ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <form id="addToCartForm" action="" method="post">
                                <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
                                <input type="hidden" name="product_name" value="<?= $row['product_name']; ?>">
                                <input type="hidden" name="product_price" value="<?= $row['product_price']; ?>">
                                <input type="hidden" name="product_color" value="<?= $row['product_color']; ?>">
                                <input type="hidden" name="product_size" value="<?= $row['product_size']; ?>">
                                 <?php if (!$product_already_in_cart): ?>
                                     <button type="submit" class="btn btn-outline-primary" <?= isset($_SESSION['username']) ? '' : 'disabled' ?> id="addToCartBtn" name="add_to_cart">
                                        <i class="fa-solid fa-cart-plus cart p-2">Add To Cart</i> 
                                    </button>
                                    <?php if(!isset($_SESSION['username'])): ?>
                                    <h5 class="py-3"><a href="account.php" style="color: purple;">Log in</a> first!!</h5>
                                    <?php endif; ?>
                                <?php else: ?>
                                     <p>This product is already in your cart.</p>
                                <?php endif; ?>
                            </form>
                        </div>
                        <div class="col-md-6">
                            
<form action="checkoutdirect.php" method="post">
     <input type="hidden" name="product_ids" value="<?= $row['product_id']; ?>">
    <input type="hidden" name="product_names" value="<?= $row['product_name']; ?>">
    <input type="hidden" name="product_prices" value="<?= $row['product_price']; ?>">
    <input type="hidden" name="product_colors" value="<?= $row['product_color']; ?>">
    <input type="hidden" name="product_sizes" value="<?= $row['product_size']; ?>">
    <?php if(!isset($_SESSION['username'])): ?>
         <?php endif; ?>
     <button type="submit" class="btn btn-outline-success" <?= isset($_SESSION['username']) ? '' : 'disabled' ?> id="addToCartBtn" name="add_to_cart">
        <i class="fa-solid fa-bag-shopping p-2 bag"> BUY</i>
    </button>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<?php
    } // end if result > 0
} // end if isset product_id
?>

<?php
// Start the session
 
// Assuming you have retrieved the product details already
$product_id = $row['product_id'];
$product_name = $row['product_name'];
$product_price = $row['product_price'];
$product_size = $row['product_size'];
$product_color = $row['product_color'];
$image_data = base64_encode($row['image_data']);


// Set product details as session variables
$_SESSION['product_id'] = $product_id;
$_SESSION['product_name'] = $product_name;
$_SESSION['product_price'] = $product_price;
$_SESSION['product_size'] = $product_size;
$_SESSION['product_color'] = $product_color;
$_SESSION['image_data'] = $image_data;
 
// Redirect to checkout.php
 ?>


<script src="java.js"></script>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
  <!-- Scripts -->
   
 


</body>
</html>
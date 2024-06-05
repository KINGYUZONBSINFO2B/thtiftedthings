<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="icon.png">  

    <title>Contact Form</title>
    <style>
        
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css");

    .row{
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
   
}
.col-md-7{
    padding: 20px;
}
.col-md-5{
    background: #43CBD6;
    padding: 20px;
    color: white;

}
.form-control {
    height: 52px;
    background: #fff;
    color: #000;
    font-size: 14px;
    border-radius: 2px;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.bi{
    font-size: 20px;
}
.d-flex p{
    font-size: 18px;
    padding-left: 10px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}



   */
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
                    <li><a href="faq.php">FAQs</a></li>
                    <li><a href="contact.php"class="active">Contact</a></li>
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


        
        
            <div class="container">
            <?php
        require 'conn.php';
        $sql = "SELECT*FROM contact_us";
        $result = $conn->query($sql);
        if($result-> num_rows>0){
            while($rows=$result->fetch_assoc()){

            }
        }
        ?>
        <?php
include 'conn.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    // Set parameters and execute
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $stmt->execute();

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Redirect after submission (optional)
    // header("Location: thank-you-page.php");
    // exit();
}
?>
                <p class="text-center p-2">Contact our Team</p>
                <h1 class="text-center p-2" >Contact Form</h1>
                <div class="row">
                    <div class="col-md-7">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         <div class="col-md-7">
            <h4>Get in touch</h4>
            <div class="mb-3">
                <label for="nameInput" class="form-label">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="phoneInput" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="phoneInput" name="phone" placeholder="Enter your number">
            </div>
            <div class="mb-3">
                <label for="messageInput" class="form-label">Message</label>
                <textarea class="form-control" id="messageInput" name="message" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
     </div>
</form>
                 </div>

        
                    <?php
// Assuming you have already established a database connection
include 'conn.php';
// Query to fetch a single row from the contact_us table
$query = "SELECT * FROM contact_us LIMIT 1";
$result = mysqli_query($conn, $query);

// Check if there is a row returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the single row
    $row = mysqli_fetch_assoc($result);

    // Extract the values from the database
    $address = $row['address'];
    $contact = $row['contact'];
    $email = $row['email'];
    $website = $row['website'];

    // Output the HTML structure with dynamically populated data
    echo '<div class="col-md-5">
            <h4>Contact us</h4><hr>
            <div class="mt-4">
                <div class="d-flex">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Address: '.$address.'</p>
                </div><hr>
                <div class="d-flex">
                    <i class="bi bi-telephone-fill"></i>
                    <p>Contact: '.$contact.'</p>
                </div><hr>
                <div class="d-flex">
                    <i class="bi bi-envelope-fill"></i>
                    <p>Email: '.$email.'</p>
                </div><hr>
                <div class="d-flex">
                    <i class="bi bi-browser-chrome"></i>
                    <p>Website: '.$website.'</p>
                </div><hr>
            </div>
          </div>';
} else {
    // Handle case where no data is found
    echo "No contact information available.";
}

// Close the database connection
mysqli_close($conn);
?>




<section>
            <footer class="footer bg-white text-dark py-5" style="display: block;">
                <div class="container">
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

            </section>
            <script src="java.js"></script>

    </body>
</html>


        
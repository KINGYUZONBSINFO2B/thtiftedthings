<?php
// Include the database connection file
include_once 'conn.php';

// Start session
session_start();

// Step 2: Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm']);

    // Step 3: Validate form data
    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Error: Passwords do not match.";
        header("Location: create.php"); // Redirect back to the create.php page
        exit(); // Stop execution
    }
    
    // You can add more validation here if needed
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_confirm = password_hash($confirm_password, PASSWORD_DEFAULT);


    // Step 4: Insert data into the "accounts" table
    $sql = "INSERT INTO create_account (username, email, password, confirm) VALUES ('$username', '$email', '$hashed_password', '$hashed_confirm')";

    if ($conn->query($sql) === TRUE) {
        // Display JavaScript alert after successfully creating the account
        echo '<script>alert("New record created successfully");</script>';
        // Delay redirection slightly
        echo '<script>setTimeout(function(){ window.location.href = "create.php"; }, 1000);</script>';
        exit(); // Stop execution
    } else {
        // Handle any errors
        echo '<script>alert("Error occurred: ' . $conn->error . '");</script>';
        // Redirect back to the create.php page
        header("Location: create.php");
        exit(); // Stop execution
    }
    
    header("Location: create.php"); // Redirect back to the create.php page
}

// Step 5: Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .create-account-link {
            text-align: center;
            margin-top: 20px;
        }
      
</style>
</head>
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


 
  
  <!-- Navbar -->
  <!-- Navbar code remains unchanged -->
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
          <div class="text-center mb-4"> <!-- Center align content -->
              
            <i class="fa-regular fa-user " style="font-size: 24px; display: inline;"><span> SIGN-UP</span></i>
          
    </div>
            <form action="create.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa-solid fa-eye"></i>
                    </button>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="confirm_password">Confirm Password:</label>
                    <div class="input-group">
                    <input type="password" class="form-control confirm" id="confirm" name="confirm" minlength="8" required style="text-align: start;">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                </div>
                <!-- Add more fields for personal information as needed -->
                <button type="submit" class="btn btn-primary btn-block" id="confirm">Sign Up</button>
            </form>
            <div class="create-account-link">
                <p>Already have an account? <a href="account.php">Log In</a></p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
  <!-- Scripts -->
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
<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordInput = document.getElementById("password");
        var icon = document.querySelector("#togglePassword i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
</script>
<script>
    document.getElementById("togglePassword2").addEventListener("click", function() {
        var passwordInput = document.getElementById("confirm");
        var icon = document.querySelector("#togglePassword2 i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
</script>


</body>
</html>

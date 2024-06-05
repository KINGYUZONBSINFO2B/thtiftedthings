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
<body style="background-color: ivory; font-family:cursive;">
  <!-- Navbar -->
  <section id="header">
            <div class="logo-container">
            <a href="#"> <img src="logo.png" alt="logs" class="logo" style="width: 48%;"></a>
            </div>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
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
                    <li><a href="account.php " class="active">Account <i class="fa-regular fa-user "></i></a></li>
                    <a href="#" id="close"><i class="fa-solid fa-x"></i></a>   
                </ul>
            </div>

            <div id="mobile">
                <i id="bar" class="fa-solid fa-bars"></i>
                
            </div>
</section>
<div class>


          
  <?php
// Include the database connection file
include 'conn.php';

// Start the session
session_start();

// Check if the user is already logged in, then redirect to index.php
if(isset($_SESSION['username'])) {
    // If the user is logged in, display their username and a logout button
    echo "<h3>Welcome, " . $_SESSION['username'] . "! You are logged in.</h3>";
    echo '<form action="logout.php" method="post">
    <button type="submit" name="logout" class="mx-3 btn btn-danger d-flex justify-content-start">Logout</button>
      </form>';
    exit(); // Stop further execution

}
echo"</div>";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Query to retrieve the hashed password associated with the provided username
    $sql = "SELECT * FROM create_account WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($result) {
        // Check if a matching user is found
        if (mysqli_num_rows($result) == 1) {
            // Retrieve the hashed password from the database
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            // Compare the stored hashed password with the password entered by the user
            if (password_verify($password, $stored_password)) {
                // User authenticated, set session variable
                $_SESSION['username'] = $username;

                // Set a cookie to remember the username for 7 days
                setcookie('remember_username', $username, time() + (7 * 24 * 3600), '/');

                // Redirect to index.php after successful login
                header("Location: index.php");
                exit();
            } else {
                // Incorrect password
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            // User not found
            $error_message = "User not found. Please check your username.";
        }
    } else {
        // Error in executing query
        $error_message = "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>


<?php if(isset($error_message)): ?>
<div class="alert alert-danger" role="alert">
    <?php echo $error_message; ?>
</div>
<?php endif; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <div class="text-center mb-4"> <!-- Center align content -->
                <i class="fa-regular fa-user " style="font-size: 24px; display: inline;"><span> LOG-IN</span></i>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="name">Enter Username:</label>
                    <input type="text" class="form-control" id="name" name="username" required>
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

                <button type="submit" class="btn btn-primary btn-block my-2">Login</button>
            </form>

            <div class="create-account-link">
                <p>No account yet? <a href="create.php">Create account</a></p>
            </div>
        </div>
    </div>
</div>




<!-- Bootstrap JS -->
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

  <!-- Scripts -->



</body>
</html>
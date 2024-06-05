<?php

session_start();
if(empty($_SESSION['username_login']) && empty($_SESSION['password'])){
        header("Location: TTadminlogin.php?message=You need to login first before Entering here");
        exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>th, td,tr{
        border: 1px solid black;
        padding-left: 10px;
        padding-right: 10px;
        text-align: center;
     }
     .LOGO{
        width: 20%;
        
     }
     @media(max-width:786px){
        .LOGO{
            width: 40%;
        }
     }
      .modal-header .close {
    display: none;
  }
  body.modal-opened {
    filter: blur(100px);
    pointer-events: none;
  }

    </style>
   
</head>
<body style="background: linear-gradient(rgb(210, 219, 255),ivory);" class="pb-5 container-fluid">
<!-- NAV -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
     <div class="container-fluid">
        <a class="navbar-brand" href="TTadmin.php">Administrator Panel</a>
        <div class="navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" href="adminorder.php">Your Orders</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="TTmessage.php">Messages</a>
                </li>

                <li class = "nav-item">
                <li class="nav-item">
                    <a class="nav-link" href="#PM">Product Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#PL">Product List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#VA">View Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#FAQ">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contacts</a>
                </li>
                <li class = "nav-item">
                <form action="TTadminlogin.php" method="post" >
                <button class="nav-link btn btn-link" name="logout">
                    Logout
                </button>
                </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


 
    <div class="container mt-5" id="PM">
        <div class=" d-flex justify-content-center">
 
            <img src="LOGO.png" alt="LOGO"  id="LOGO" class=" LOGO">
        </div>
        
        <!-- Product Form -->
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Add Product</h2>
                        <form action="TTadmin.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input class="form-control" type="text" name="product_name" id="product_name" placeholder="PRODUCT NAME" required>
                            </div>
                            <div class="form-group">
                                <input  class="form-control" type="text" name="product_desc" id="product_desc" placeholder="PRODUCT DESCRIPTION"required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="product_size" id="product_size" placeholder="PRODUCT SIZE"required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="product_color" id="product_color" placeholder="PRODUCT COLOR"required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="product_category" id="product_category" placeholder="PRODUCT CATEGORY"required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="MT" id="MT" placeholder="MATERIAL QUALITY"required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" name="product_price" id="product_price" placeholder="PRICE"required>
                            </div>
                            <label for="image"> Insert Images: </label> 
                            <input class="form-control" type="file" name="image" id="image"> <br>
                            <button type="submit" name="submit" class="btn btn-primary d-flex justify-content-center">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div style="border-bottom: 1px solid black;" class="mt-5"></div>
    

    <?php
    require "conn.php";

    // Define a variable to store the status message and initialize it
    $status_message = "";
    
    // Check if the form is submitted
    if(isset($_POST['submit'])) {
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Check if file is uploaded
        if(isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK){
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = $_FILES['image']['name'];

            $file_data = file_get_contents($file_tmp);
            // Escape special characters to prevent SQL injection
            $file_data = mysqli_real_escape_string($conn, $file_data);
        }
        
        // Get form data
        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $product_size = $_POST['product_size'];
        $product_color = $_POST['product_color'];
        $product_category = $_POST['product_category'];
        $MT = $_POST['MT'];
        $product_price = $_POST['product_price'];

        // Check if the product already exists in the database
        $sql_check = "SELECT * FROM add_items WHERE product_name = '$product_name'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows == 0) {
            // Insert data into database
            $sql = "INSERT INTO add_items (product_name, product_desc, product_size, product_color, product_category, MT, product_price, image_data) 
                    VALUES ('$product_name', '$product_desc', '$product_size', '$product_color', '$product_category', '$MT', '$product_price', '$file_data')";

            if ($conn->query($sql) === TRUE) {
               echo $status_message = "New record created successfully.";
            } else {
                $status_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        } 
        // Close connection
        $conn->close();
    }

    ?>

    <?php
    require "conn.php";

    // Retrieve product data from database and display
    $sql = "SELECT * FROM add_items"; // Select all columns from the add_items table
    $result = $conn->query($sql);

    // Define the status message HTML
    $status_message_html = "";

    if (!empty($status_message)) {
        $status_message_html = "<p>$status_message</p>";
    }

    ?>
    <div id="PL">
    <h2 class="text-center mt-5 mb-3">Product List</h2>
    <?php echo $status_message_html; ?>
    <table class='px-3 table-responsive d-flex justify-content-center'>
        <tr style="border: 1px solid black;">
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Size</th>
            <th>Product Color</th>
            <th>Product Category</th>
            <th>Star Rating</th>
            <th>Product Price</th>
            <th>Product Image</th>
            <th>Edit Product</th>
            <th>Delete Product</th>
        </tr>
        <?php
        require "conn.php";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["product_desc"] . "</td>";
                echo "<td>" . $row["product_size"] . "</td>";
                echo "<td>" . $row["product_color"] . "</td>";
                echo "<td>" . $row["product_category"] . "</td>";
                echo "<td>" . $row["MT"] . "</td>";
                echo "<td>" . $row["product_price"] . "</td>";
                // Output the product image as an HTML img element
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["image_data"]) . "' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";
                echo "<td><a href='update_record.php?product_id=" . $row['product_id'] . "' class='btn btn-outline-primary'>Edit</a></td>";
                echo "<td> <form id='delete' action='deleteaccount.php' method='GET' onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>
                <input type='hidden' name='product_id' value='" . $row['product_id'] . "'>
                    <button class='btn btn-outline-danger' type='submit'>Delete</button></form></td>";

                                    
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>0 results</td></tr>";
        }
        ?>
        </div>
    </table>
    <div style="border-bottom: 1px solid black;" class="mt-5"></div>




    <div class="container-fluid" id="VA">
    <h1 class="my-3">User Accounts</h1>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Account ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    include_once 'conn.php';

                    // Query to select all records from the "accounts" table
                    $sql = "SELECT * FROM create_account";
                    $result = $conn->query($sql);

                    // Check if there are any records
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["signup_id"]."</td>";
                            echo "<td>" . htmlspecialchars($row["username"] ). "</td>";
                            echo "<td>" . htmlspecialchars($row["email"] ). "</td>";
                            echo "<td>" . htmlspecialchars($row["password"] ). "</td>";
                            echo "<td>  <form action='deleteproduct.php' method='GET'>
                            <input type='hidden' name='signup_id' value='".$row["signup_id"]."'>
                            <button type='submit' class='btn btn-outline-danger'>Delete</button>
                        </form></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>0 results</td></tr>";
                    }
                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<div style="border-bottom: 1px solid black;" class="mt-5"></div>



<?php
include "conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare an SQL statement
    $update_query = "UPDATE faq SET q1=?, an1=?, q2=?, an2=?, q3=?, an3=?";
    $stmt = mysqli_prepare($conn, $update_query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $q1, $an1, $q2, $an2, $q3, $an3);

    // Get values from the form
    $q1 = $_POST['q1'];
    $an1 = $_POST['an1'];
    $q2 = $_POST['q2'];
    $an2 = $_POST['an2'];
    $q3 = $_POST['q3'];
    $an3 = $_POST['an3'];

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "FAQs updated successfully.";
    } else {
        echo "Error updating FAQs: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Retrieve all FAQ entries from the database
$query = "SELECT * FROM faq";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    // Handle the case where the query failed
    echo "Error fetching FAQs: " . mysqli_error($conn);
}

// Initialize $row with default values
$row = [
    'q1' => '',
    'an1' => '',
    'q2' => '',
    'an2' => '',
    'q3' => '',
    'an3' => '',
];

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the first row from the result set
    $row = mysqli_fetch_assoc($result);
}
?>

<div class="container-fluid" id="FAQ">
    <h2>FAQs</h2>
    <p>Enter the changes you want to make in your FAQs page.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row m-2">
            <div class="col-md-12 form-group d-flex justify-content-end"><br>
                <button type="submit" class="btn btn-primary" name="save_changes">Save Changes</button>
             </div>
        </div>
        <div class="row m-2">
            <div class="col-md-5 form-group">
                <label for="q1">Question 1</label>
                <!-- Use <textarea> for multiline input -->
                <textarea name="q1" class="form-control"><?php echo isset($row['q1']) ? $row['q1'] : ''; ?></textarea>
            </div>
            <div class="col-md-5 form-group">
                <label for="an1">Answer 1:</label>
                <!-- Use <textarea> for multiline input -->
                <textarea name="an1" class="form-control"><?php echo isset($row['an1']) ? $row['an1'] : ''; ?></textarea>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-5 form-group">
                <label for="q2">Question 2</label>
                <!-- Use <textarea> for multiline input -->
                <textarea name="q2" class="form-control"><?php echo isset($row['q2']) ? $row['q2'] : ''; ?></textarea>
            </div>
            <div class="col-md-5 form-group">
                <label for="an2">Answer 2:</label>
                <!-- Use <textarea> for multiline input -->
                <textarea name="an2" class="form-control"><?php echo isset($row['an2']) ? $row['an2'] : ''; ?></textarea>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-5 form-group">
                <label for="q3">Question 3</label>
                <!-- Use <textarea> for multiline input -->
                <textarea name="q3" class="form-control"><?php echo isset($row['q3']) ? $row['q3'] : ''; ?></textarea>
            </div>
            <div class="col-md-5 form-group">
                <label for="an3">Answer 3:</label>
                <!-- Use <textarea> for multiline input -->
                <textarea name="an3" class="form-control"><?php echo isset($row['an3']) ? $row['an3'] : ''; ?></textarea>
            </div>
        </div>
    </form>
</div>

<!-- HTML for contact form -->
<?php
include "conn.php";

// Retrieve contact information from the database
$query = "SELECT * FROM contact_us";
$result = mysqli_query($conn, $query);

// Initialize $contact_row with default values
$contact_row = [
    'address' => '',
    'contact' => '',
    'email' => '',
    'website' => ''
];

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the first row from the result set
    $contact_row = mysqli_fetch_assoc($result);
}
?>

<div class="container-fluid" id="contact">
    <h2>Contact Information</h2>
    <p>Enter the changes you want to make to your contact information.</p>
    <form action="TTcontact.php" method="post">
        <div class="row m-2">
            <div class="col-md-12 form-group d-flex justify-content-end"><br>
                <button type="submit" class="btn btn-primary">Save Changes</button>
             </div>
        </div>
        <div class="row m-2">
            <div class="col-md-5 form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control"><?php echo isset($contact_row['address']) ? $contact_row['address'] : ''; ?></textarea>
            </div>
            <div class="col-md-5 form-group">
                <label for="contact">Contact</label>
                <textarea name="contact" class="form-control"><?php echo isset($contact_row['contact']) ? $contact_row['contact'] : ''; ?></textarea>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-5 form-group">
                <label for="email">Email</label>
                <textarea name="email" class="form-control"><?php echo isset($contact_row['email']) ? $contact_row['email'] : ''; ?></textarea>
            </div>
            <div class="col-md-5 form-group">
                <label for="website">Website</label>
                <textarea name="website" class="form-control"><?php echo isset($contact_row['website']) ? $contact_row['website'] : ''; ?></textarea>
            </div>
        </div>
    </form>
</div>

<div style="border-bottom: 1px solid black;" class="mt-5"></div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
document.getElementById('delete').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission
  
  // Submit the form asynchronously
  var form = this;
  fetch(form.action + '?' + new URLSearchParams(new FormData(form)), {
    method: form.method
  })
  .then(response => {
    if (response.ok) {
      // If deletion is successful, reload the current page
      window.location.href = 'TTadmin.php';
    } else {
      alert('Failed to delete record');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred while deleting the record');
  });
});
</script>

</body>
</html>

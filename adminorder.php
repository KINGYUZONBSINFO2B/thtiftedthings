<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
     <div class="container-fluid">
        <a class="navbar-brand" href="TTadmin.php">Administrator Panel</a>
        <div class="navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" href="adminorder.php">Your Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="TTadmin.php">Product Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="TTadmin.php">Product List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="TTadmin.php">View Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="TTadmin.php">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="TTadmin.php">Contacts</a>
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


<?php
session_start();
if(empty($_SESSION['username_login']) && empty($_SESSION['password'])){
    
    header("Location: TTadminlogin.php");
}
if(isset($_GET['message'])){
    echo '<div class="alert alert-warning">' . htmlspecialchars($_GET['message']) . '</div>';
  }
require 'conn.php';
// Fetch data from the order_summaries table
$sql = "SELECT * FROM order_summaries";
$result = $conn->query($sql);
echo "<h2>Your Orders</h2>";

// Check if there are rows returned
     // Start HTML table
    
        // Assuming you have already established a database connection and executed a query to get $result
        if ($result->num_rows > 0) {
        ?>
            <div class='table-responsive'>
                <table class='table table-striped table-bordered table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Size</th>
                            <th>Product Image</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact#</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $row["order_id"]; ?></td>
                                <td><?php echo $row["product_name"]; ?></td>
                                <td><?php echo $row["product_price"]; ?></td>
                                <td><?php echo $row["product_size"]; ?></td>
                                <td><img src='data:image/jpeg;base64,<?php echo base64_encode($row['image_data']); ?>' alt='Product Image' width='100' height='100'></td>
                                <td><?php echo $row["firstname"]; ?></td>
                                <td><?php echo $row["middlename"]; ?></td>
                                <td><?php echo $row["lastname"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["contactnum"]; ?></td>
                                <td><?php echo $row["landmark"]; ?></td>
                                <td><?php echo $row["created_at"]; ?></td>
                                <td><form action="adminorderdel.php" method="get">
                                    <button class="btn btn-danger" name="order_id">Delete</button></td>
                                    </form>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        
        <?php
        } else {
            echo "<div class='alert alert-warning' role='alert'>No Orders set</div>";
        }

        // Close connection
        $conn->close();
        ?>
        </body>
</html>
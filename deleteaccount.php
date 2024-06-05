<?php
require "conn.php";
$product_id = $_GET['product_id'];
// sql to delete a record
$sql = "DELETE FROM add_items WHERE product_id=$product_id";

if ($conn->query($sql) === TRUE) {

 echo "Record deleted successfully";

} else {

 echo "Error deleting record: " . $conn->error;

}
?> 
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
</head>
<body>
  <h5>Product deleted successfully</h5>
    <form action="TTadmin.php"> <button class="btn btn-outline-primary">Go back</button></form>
</body>
</html>
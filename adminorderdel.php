<?php
require "conn.php";
$order_id = $_GET['order_id'];
// sql to delete a record
$sql = "DELETE FROM order_summaries WHERE order_id=order_id";

if ($conn->query($sql) === TRUE) {

 echo "Record deleted successfully";
 header("Location: adminorder.php");

} else {

 echo "Error deleting record: " . $conn->error;

}
?> 
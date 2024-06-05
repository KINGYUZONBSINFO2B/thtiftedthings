<?php
include "conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare an SQL statement to update existing record
    $update_query = "UPDATE contact_us SET address=?, contact=?, email=?, website=?";
    $stmt = mysqli_prepare($conn, $update_query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssss", $address, $contact, $email, $website);

    // Get values from the form
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $website = $_POST['website'];

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Contact information updated successfully, redirect to TTadmin.php
        header("Location: TTadmin.php");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error updating contact information: " . mysqli_error($conn);
    }
    if (isset($_POST['reset'])) {
        // Prepare an SQL statement to update existing records to empty values or whitespace
        $reset_query = "UPDATE contact_us SET address='', contact='', email='', website=''";
        
        // Execute the query
        if (mysqli_query($conn, $reset_query)) {
            // Records reset successfully
            // Redirect to the same page or any other appropriate action
            header("Location: TTcontact.php");
            exit(); // Ensure no further code execution after redirection
        } else {
            // Error resetting records
            echo "Error resetting contact information: " . mysqli_error($conn);
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt);
 
}

?>

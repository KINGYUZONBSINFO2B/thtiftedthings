<?php
// Include your database connection file here
require "conn.php";

// Check if product_id is set in the URL
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Retrieve record based on product_id
    $sql = "SELECT * FROM add_items WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    // Check if record exists
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Display edit form
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(skyblue,ivory);
            padding: 10px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 16px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 10px;
        }
         #LOGO{
           margin: 0 auto;
           margin-left: 45%;
        }
    </style>
    <title>Update</title>
</head>
<body>
    
<img src="LOGO.png" alt="LOGO" style="width: 10%; " id="LOGO" class="mt-5 ">

<div class="container">
            <h2 class="m-2">Edit Record</h2>
            <form method="post" action="update_record.php" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <div class="form-group">
                    <label>Product Name:</label>
                    <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']; ?>">
                </div>
                <div class="form-group">
                    <label>Product Description:</label>
                    <input type="text" class="form-control" name="product_desc" value="<?php echo $row['product_desc']; ?>">
                </div>
                <div class="form-group">
                    <label>Product Size:</label>
                    <input type="text" class="form-control" name="product_size" value="<?php echo $row['product_size']; ?>">
                </div>
                <div class="form-group">
                    <label>Product Color:</label>
                    <input type="text" class="form-control" name="product_color" value="<?php echo $row['product_color']; ?>">
                </div>
                <div class="form-group">
                    <label>Product Category:</label>
                    <input type="text" class="form-control" name="product_category" value="<?php echo $row['product_category']; ?>">
                </div>
                <div class="form-group">
                    <label>MT:</label>
                    <input type="text" class="form-control" name="MT" value="<?php echo $row['MT']; ?>">
                </div>
                <div class="form-group">
                    <label>Product Price:</label>
                    <input type="text" class="form-control" name="product_price" value="<?php echo $row['product_price']; ?>">
                </div>
                <div class="form-group">
                    <label>Product Image:</label>
                    <input type="file" class="form-control-file" name="product_image">
                </div>
                <form action="TTadmin.php" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    <button type="submit" class="btn btn-outline-primary m-1">Update</button> 
                </form>

                <button action= "TTadmin.php" class="btn btn-outline-danger m-1">Cancel</button>
            </form>
        </div>
        </body>
</html>
        <?php
    } else {
        echo "Record not found";
    }
} else {
    echo "Invalid request";
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_desc = $_POST["product_desc"];
    $product_size = $_POST["product_size"];
    $product_color = $_POST["product_color"];
    $product_category = $_POST["product_category"];
    $MT = $_POST["MT"];
    $product_price = $_POST["product_price"];

    // Handle file upload
    $target_directory = "uploads/"; // Specify the directory where you want to store uploaded images
    $target_file = $target_directory . basename($_FILES["product_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["product_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["product_image"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update query (excluding image update for now)
    $sql = "UPDATE add_items SET 
            product_name = '$product_name', 
            product_desc = '$product_desc', 
            product_size = '$product_size', 
            product_color = '$product_color', 
            product_category = '$product_category', 
            MT = '$MT', 
            product_price = '$product_price' 
            WHERE product_id = $product_id";

    // Execute the update query
    if(mysqli_query($conn, $sql)) {
        // Redirect back to admin page after successful update
        header("Location: TTadmin.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

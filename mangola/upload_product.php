<?php
session_start();
include "includes/dbconnect.php"; // your mysqli connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];

    // Handle image upload
    $target_dir = "images/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Save product info including image filename
        $query = "INSERT INTO products (product_name, product_price, product_description, product_image) 
                  VALUES ('$name', '$price', '$description', '$image_name')";

        if (mysqli_query($connection, $query)) {
            header("Location: admin.php?msg=1"); // success
            exit();
        } else {
            header("Location: admin.php?msg=2"); // DB insert failed
            exit();
        }
    } else {
        header("Location: admin.php?msg=2"); // File upload failed
        exit();
    }
}
?>

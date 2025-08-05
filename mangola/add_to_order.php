<?php
session_start();

// Redirect if user not logged in
if(!(isset($_SESSION['name']) && isset($_SESSION['email']))) {
    header('Location: register.php');
    exit();
}

include "includes/dbconnect.php";

// Validate product_id
if(!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("Invalid request: Product ID is missing.");
}

$product_id = intval($_GET['product_id']);
$user_id    = intval($_SESSION['user_id']);

// Step 1: Remove the item from cart
$delete = "DELETE FROM `cart` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
if (!mysqli_query($connection, $delete)) {
    die("Error deleting from cart: " . mysqli_error($connection));
}

// Step 2: Check if order already exists
$query1 = "SELECT * FROM `orders` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
$result1 = mysqli_query($connection, $query1);

if (!$result1) {
    die("Error fetching from orders: " . mysqli_error($connection));
}

if (mysqli_num_rows($result1) == 0) {
    // Step 3: Insert into orders
    $query = "INSERT INTO `orders` (`order_id`, `user_id`, `product_id`) 
              VALUES (NULL, '$user_id', '$product_id')";
    if (mysqli_query($connection, $query)) {
        header('Location: details_form.php?product_id=' . $product_id);
        exit();
    } else {
        die("Database Insert Error: " . mysqli_error($connection));
    }
} else {
    // If already exists, redirect to cart items page with message
    header('Location: show_cart_items.php?product_id=' . $product_id . '&msg=22');
    exit();
}
?>

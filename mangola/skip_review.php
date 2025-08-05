<?php
session_start();
if(!(isset($_SESSION['name']) && isset($_SESSION['email']))) {
    header('Location: register.php');
    exit;
}

include "includes/dbconnect.php";

$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];

// Check if already ordered:
$query_check = "SELECT * FROM `orders` WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
$result_check = mysqli_query($connection, $query_check);

if(mysqli_num_rows($result_check) == 0) {
    // Insert order
    $query_insert = "INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `order_date`) VALUES (NULL, '$user_id', '$product_id', NOW())";
    mysqli_query($connection, $query_insert);
}

header("Location: order_success.php");
exit;
?>

<?php
session_start();
include "includes/dbconnect.php";

// Only logged in users should post reviews
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?msg=loginrequired");
    exit;
}

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];
$review_heading = mysqli_real_escape_string($connection, $_POST['review_heading']);
$review_text = mysqli_real_escape_string($connection, $_POST['review_text']);

$query = "INSERT INTO `reviews` (`product_id`, `user_id`, `review_heading`, `review_text`) 
          VALUES ('$product_id', '$user_id', '$review_heading', '$review_text')";

if (mysqli_query($connection, $query)) {
    header("Location: product_description.php?product_id=$product_id&msg=review_added");
} else {
    header("Location: product_description.php?product_id=$product_id&msg=review_failed");
}
?>

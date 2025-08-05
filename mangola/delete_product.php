<?php
session_start();
if (!(isset($_SESSION['name']) && isset($_SESSION['email']))) {
    header('Location: register.php');
    exit;
}

include "includes/dbconnect.php";

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Optional: validate that product_id is numeric
    if (!is_numeric($product_id)) {
        header("Location: admin.php?msg=22");
        exit;
    }

    $query = "DELETE FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_affected_rows($connection) > 0) {
            header("Location: admin.php?msg=11");
            exit;
        } else {
            // No rows affected - product ID not found
            header("Location: admin.php?msg=22");
            exit;
        }
    } else {
        header("Location: admin.php?msg=22");
        exit;
    }
} else {
    header("Location: admin.php?msg=22");
    exit;
}
?>

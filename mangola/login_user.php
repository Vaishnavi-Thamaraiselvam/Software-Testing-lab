<?php
session_start();
include "includes/dbconnect.php";

$email = $_POST['user_email'];
$password = $_POST['user_password'];

if (empty($email) || empty($password)) {
    header("Location: index.php?msg=emptyfields");
    exit;
}

// First check if email exists
$check_email_query = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
$check_email_result = mysqli_query($connection, $check_email_query);

if (mysqli_num_rows($check_email_result) == 0) {
    // Email not found in DB
    header("Location: index.php?msg=noid");
    exit;
} else {
    // Email exists — now check password
    $query = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['user_id'];

        if ($_SESSION['email'] == "admin@mangola.com" && $row['password'] == "1234") {
            header('Location: admin.php');
        } else {
            header('Location: products.php');
        }
    } else {
        // Wrong password
        header("Location: index.php?msg=loginerror");
        exit;
    }
}
?>

<?php
session_start();
if(!(isset($_SESSION['name']) && isset($_SESSION['email']))) {
    header('Location: register.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<?php include "includes/css_header.php"; ?>
<body style="background-color: #EEEEEE;">
    <?php include "includes/header_postlogin.php"; ?>

    <div class="container text-center">
        <h1 class="text-success margin-top50"><b>Order placed successfully!</b></h1>
        <p class="margin-top20">Thank you for shopping with Mangola.com.</p>
        <a href="products.php" class="btn btn-success btn-lg margin-top30">Back to Home</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
	<?php 
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/css_header.php"; ?>
<body style="background-color: #EEEEEE;">
	<?php include "includes/header_admin.php"; ?>
	<div class="row margin-left20">

		<div class="col-md-12 text-center">
			<h1 class="font-80px">Admin Pannel</h1>
		</div>
		<br><br><br>
		<a href="admin_orders.php" class="btn btn-lg btn-success margin-left20"> View all Orders</a>
		<br><br><br>
		
		<?php 
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if ($msg == 1) {
        echo "<h3 class='text-center text-red'><i>Product has been added</i></h3><br>";
    } elseif ($msg == 2) {
        echo "<h3 class='text-center text-red'><i>Product could not be added</i></h3><br>";
    } elseif ($msg == 11) {
        echo "<h3 class='text-center text-red'><i>Product has been Deleted</i></h3><br>";
    } elseif ($msg == 22) {
        echo "<h3 class='text-center text-red'><i>Oops..No such Product Id</i></h3><br>";
    } elseif ($msg == "review_deleted") {
        echo "<h3 class='text-center text-red'><i>Review has been deleted</i></h3><br>";
    } elseif ($msg == "review_delete_failed") {
        echo "<h3 class='text-center text-red'><i>Failed to delete review</i></h3><br>";
    } elseif ($msg == "invalid_review_id") {
        echo "<h3 class='text-center text-red'><i>Invalid Review ID</i></h3><br>";
    }
}
?>

		<div class="row">
			<div class="col-md-6">
				<h3 class="font-80px">Add a product To Database</h3>
			</div>
			<div class="col-md-6">
				<form action="upload_product.php" method="POST" enctype="multipart/form-data">
					<label>Product Name</label>
					<input type="text" name="product_name" class="form-control"><br>
					<label>Product Price</label>
					<input type="number" name="product_price" class="form-control"><br>
					<label>Product Description</label>
					<textarea name="product_description" class="form-control"></textarea><br>
					<label>Upload Image</label>
					<input type="file" name="image" class="form-control"><br>
					<input type="submit" value="Add product" class="btn btn-success btn-lg">
				</form>
			</div>
		</div>
		<br><br><br>
		<div class="row">
			<div class="col-md-6">
				<h3 class="font-80px">Delete a product From Database</h3>
			</div>
			<div class="col-md-6">
				<form action="delete_product.php" method="POST">
					<label>Product ID</label>
					<input type="number" name="product_id" class="form-control"><br>
					<input type="submit" value="Delete Product" class="btn btn-success btn-lg">
				</form>
			</div>
		</div>
		<div class="row">
 <div class="row">
    <div class="col-md-12">
        <h3 class="font-80px">User Reviews</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Review ID</th>
                    <th>User</th>
                    <th>Product ID</th>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "includes/dbconnect.php"; 
                $query = "SELECT r.review_id, u.name AS user, r.product_id, r.review_text
                          FROM reviews r 
                          JOIN users u ON r.user_id = u.user_id";

                $result = mysqli_query($connection, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['review_id']}</td>";
                        echo "<td>{$row['user']}</td>";
                        echo "<td>{$row['product_id']}</td>";
                        echo "<td>{$row['review_text']}</td>";
                        echo "<td><a href='delete_review.php?review_id={$row['review_id']}' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No reviews found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


</body>
</html>
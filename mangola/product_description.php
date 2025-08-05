<?php 
    session_start();

    if(!(isset($_SESSION['name'])&&isset($_SESSION['email']))) {
        header('Location: register.php');
    }
    include "includes/css_header.php";
    include "includes/dbconnect.php";

    include "includes/header_postlogin.php"; 				

    $product_id = $_GET['product_id'];
    $query = "SELECT * FROM `products` WHERE `product_id` LIKE '$product_id'";
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($results);

    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 1) {
            echo "<h4 class='text-center text-red'><i>Added to cart</i></h4><br>";
        } elseif ($_GET['msg'] == 2) {
            echo "<h4 class='text-center text-red'><i>You have Already added this to cart</i></h4><br>";
        } elseif ($_GET['msg'] == 11) {
            echo "<h4 class='text-center text-red'><i>Added to Wishlist</i></h4><br>";
        } elseif ($_GET['msg'] == 22) {
            echo "<h4 class='text-center text-red'><i>You have Already added this to Wishlist</i></h4><br>";
        } elseif ($_GET['msg'] == "review_added") {
            echo "<h4 class='text-center text-success'><i>Your review has been added successfully!</i></h4><br>";
        } elseif ($_GET['msg'] == "review_failed") {
            echo "<h4 class='text-center text-danger'><i>Failed to submit review. Please try again.</i></h4><br>";
        } else {
            echo "<h4 class='text-center text-red'><i>Some error occurred!</i></h4><br>";
        }
    }
?>

<div class="container">
    <div class="row padding30">  
        <div class="col-md-6">
            <div class="product-tab">
                
<img src="images/<?php echo $row['product_image']; ?>" class="img-size-lg">
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-tab">
                <h1 class="text-center"><?php echo $row['product_name']; ?></h1>
                <p>&nbsp;&nbsp;<?php echo $row['product_description']; ?><br>
                <br> <b>&nbsp;&nbsp;Price: ₹<?php echo $row['product_price']; ?>/Kg</b><br><br></p> 
                <a href="add_to_cart.php?product_id=<?php echo $product_id; ?>" class="btn btn-lg btn-danger">Add to Cart</a>
                <a href="add_to_wishlist.php?product_id=<?php echo $product_id; ?>" class="btn btn-lg btn-danger">Add to Wishlist</a>
            </div>
        </div>
    </div>
</div>


      	<div class="row">
      		<div class="col-md-12">
      			<h1 class="text-center"> TOP REVIEWS</h1>
      		</div>
      	</div>
      	<div class="row">
      		
      			<?php
      				$query1="SELECT * FROM `reviews` r JOIN `users` u ON r.`user_id`=u.`user_id` WHERE r.`product_id` LIKE '$product_id'";
      				$result1=(mysqli_query($connection,$query1));
      				while($row1=mysqli_fetch_assoc($result1))
      				{
      					echo '<div class="col-md-6">
      							<div class="product-tab margin-left20"> 
      								<h4><b>'.$row1['review_heading'].'</b><br>
      								<small>By: '.$row1['name'].'</small> <br><br>
      								'.$row1['review_text'].' </h4>
      							</div>
      						  </div>';
      				}
      			?>
      		
      	</div>	

		      	</div>	

<!-- Add Review Form -->
<div class="row">
    <div class="col-md-12">
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] == 'review_added') {
            echo "<p class='text-center text-success'><i></i></p>";
        } elseif (isset($_GET['msg']) && $_GET['msg'] == 'review_failed') {
            echo "<p class='text-center text-danger'><i>Failed to submit review. Please try again.</i></p>";
        }
        ?>

        <h2 class="text-center">Add Your Review</h2>
        <form action="submit_review.php" method="POST" class="form margin-left20 margin-right20">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            
            <label>Review Heading:</label>
            <input type="text" name="review_heading" class="form-control" required><br>
            
            <label>Your Review:</label>
            <textarea name="review_text" class="form-control" rows="4" required></textarea><br>
            
            <input type="submit" value="Submit Review" class="btn btn-success btn-lg">
        </form>
    </div>
</div>

	</body>
</html>

	</body>
</html>
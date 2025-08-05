<!DOCTYPE html>
<html>

	<?php include "includes/css_header.php" ?>

	<body style="background-color:	#FFFFE0 !important">

		<?php include "includes/header_prelogin.php" ?>

		<div class="col-md-4 margin-top50">
    <h2 class="text-black text-center"> <b>Login to continue</b> </h2>

    <?php
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'emptyfields') {
        echo "<p class='text-center text-danger'><i>Email and password cannot be empty.</i></p>";
    } elseif ($_GET['msg'] == 'loginerror') {
        echo "<p class='text-center text-danger'><i>Incorrect email or password. Please try again.</i></p>";
    } elseif ($_GET['msg'] == 'noid') {
        echo "<p class='text-center text-danger'><i>No ID found. Are you new? Register First </a>.</i></p>";
    }
}
?>


    <form class="form" action="login_user.php" method="POST">
        <label class="text-black">Email:</label>
        <input type="email" class="form-control" placeholder="Enter your Email" name="user_email" required><br>

        <label class="text-black">Password:</label>
        <input type="password" class="form-control" placeholder="Password" name="user_password" required><br>

        <input type="submit" class="btn btn-danger btn-lg btn-block" value="Login"><br>
    </form>

    <p class="text-black"><i>Not a member? <a href="register.php">Register Here</a></i></p>
</div>

	</body>
</html>
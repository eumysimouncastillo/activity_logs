<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Register here!</h1>
	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		}

		else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}

	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label> <br>
			<input type="text" name="username">
		</p>
		<p>
			<label for="username">First Name</label> <br>
			<input type="text" name="first_name">
		</p>
		<p>
			<label for="username">Last Name</label> <br>
			<input type="text" name="last_name">
		</p>
		<p>
			<label for="username">Password</label> <br>
			<input type="password" name="password">
		</p>
		<p>
			<label for="username">Confirm Password</label> <br>
			<input type="password" name="confirm_password"> <br> <br>
			<input type="submit" name="insertNewUserBtn">
		</p>
	</form>
</body>
</html>
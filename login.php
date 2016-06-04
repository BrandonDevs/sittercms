<?php
	session_start();

	if(isset($_POST['login'])) {
		include_once("db.php");
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);

		$username = stripslashes($username);
		$password = stripslashes($password);

		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);

		$password = md5($password);

		$sql = "SELECT * FROM staff WHERE username='$username' LIMIT 1";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($query);
		$staffID = $row['staffID'];
		$db_password = $row['password'];
		$admin = $row['admin'];

		if($password == $db_password) {
			$_SESSION['username'] = $username;
			$_SESSION['staffID'] = $staffID;
			header("Location: children.php");
		} else {
			header("Location: error_login.php");
		}
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>Sitter - Portal</title>
<?php include('header.php'); ?>

<section class="content">
	<div class="center">

<h2>Login</h2>

<form action="login.php" method="post" enctype="multipart/form-data">
<input placeholder="Username" name="username" type="text" autofocus><br />
<input placeholder="Password" name="password" type="password"><br />
<input name="login" type="submit" value="Login">
</form>

	</div>
</section>

<section class="content">

<div class="center">
<h2>Register</h2>

<p>Don't have an account? <a href="register.php">Register </a> for an account
	if you are an employee.</p>
</div>
</section>

<?php include('footer.php'); ?>

<?php
  if(isset($_SESSION['id'])) {
    header("Location: index.php");
  }

  if(isset($_POST['register'])) {
    include_once("db.php");

   $staffName = strip_tags($_POST['staffName']);
   $username = strip_tags($_POST['username']);
   $password = strip_tags($_POST['password']);
   $password_confirm = strip_tags($_POST['password_confirm']);
   $email = strip_tags($_POST['email']);
   $phone = strip_tags($_POST['phone']);
   $address = strip_tags($_POST['address']);
   $code = strip_tags($_POST['code']);

   $staffName = stripslashes($staffName);
   $username = stripslashes($username);
   $password = stripslashes($password);
   $password_confirm = stripslashes($password_confirm);
   $email = stripslashes($email);
   $phone = stripslashes($phone);
   $address = stripslashes($address);
   $code = stripslashes($code);

   $staffName = mysqli_real_escape_string($db, $staffName);
   $username = mysqli_real_escape_string($db, $username);
   $password = mysqli_real_escape_string($db, $password);
   $password_confirm = mysqli_real_escape_string($db, $password_confirm);
   $email = mysqli_real_escape_string($db, $email);
   $phone = mysqli_real_escape_string($db, $phone);
   $address = mysqli_real_escape_string($db, $address);

   $password = md5($password);
   $password_confirm = md5($password_confirm);

   $sql_store = "INSERT into staff (staffName, username, password, email, phone, address)
      VALUES ('$staffName','$username','$password','$email','$phone','$address')";

   $sql_fetch_username = "SELECT username FROM staff WHERE username = '$username'";
   $sql_fetch_email = "SELECT email FROM staff WHERE email = '$email'";

   $query_username = mysqli_query($db, $sql_fetch_username);
   $query_email = mysqli_query($db, $sql_fetch_email);

    if(mysqli_num_rows($query_username)) {
      echo "There is already a user with that name!";
      return;
    }

    if($staffName == "") {
      echo "Please insert your name.";
      return;
    }

    if($username == "") {
      echo "Please insert a username";
      return;
    }

	if($password == "" || $password_confirm == "") {
		echo "Please insert a password.";
		return;
	}

    if($password != $password_confirm) {
      echo "The passwords don't match!";
      return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == "") {
      echo "This email is not valid!";
      return;
    }

    if(mysqli_num_rows($query_email)) {
      echo "That email is already in use!";
      return;
    }

    if($address == "") {
      echo "Please insert an address.";
      return;
    }

    if($phone == "") {
      echo "Please insert a phone number.";
      return;
    }

    // Lathrop, ITT Tech's zip code

   if($code == "95330") {
      mysqli_query($db, $sql_store);
      header("Location: login.php");
   } else {
       echo "Wrong facility code.";
       return;
    }
}

?>

 <?php include 'head.php'; ?>
 <title>SitterCMS - Babysitter Management System</title>
 <?php include 'header.php'; ?>

 <section class="content">

    <h2>Register a New Account</h2>

  <form action="register.php" method="post" enctype="multipart/form-data">
   <input placeholder="First and Last Name" name="staffName" type="text" autofocus>
   <input placeholder="Username" name="username" type="text">
   <input placeholder="Password" name="password" type="password">
   <input placeholder="Confirm Password" name="password_confirm" type="password">
   <input placeholder="E-Mail Address" name="email" type="email">
   <input placeholder="Address" name="address" type="text">
   <input placeholder="Phone Number" name="phone" type="number">
   <input placeholder="Facility Code" name="code" type="password">
   <input name="register" type="submit" value="Register">
  </form>
  </section>
<?php include 'footer.php'; ?>

<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(isset($_POST['new_parent'])) {
		$parentName = strip_tags($_POST['parentName']);
		$address = strip_tags($_POST['address']);
		$city = strip_tags($_POST['city']);
		$state = strip_tags($_POST['state']);
		$zip = strip_tags($_POST['zip']);
		$cellPhone = strip_tags($_POST['cellPhone']);
		$workPhone = strip_tags($_POST['workPhone']);
		$email = strip_tags($_POST['email']);

		$parentName = mysqli_real_escape_string($db, $parentName);
		$address = mysqli_real_escape_string($db, $address);
		$city = mysqli_real_escape_string($db, $city);
		$state = mysqli_real_escape_string($db, $state);
		$zip = mysqli_real_escape_string($db, $zip);
		$cellPhone = mysqli_real_escape_string($db, $cellPhone);
		$workPhone = mysqli_real_escape_string($db, $workPhone);
		$email = mysqli_real_escape_string($db, $email);

		$sql = "INSERT into parent (parentName, address, city, state, zip,
         cellPhone, workPhone, email) VALUES ('$parentName', '$address', '$city', '$state', '$zip', '$cellPhone', '$workPhone','$email')";

      $fetch_name = "SELECT parentName FROM parent WHERE parentName = '$parentName'";
      $fetch_email = "SELECT email FROM parent WHERE email = '$email'";

      $query_name = mysqli_query($db, $fetch_name);
      $query_email = mysqli_query($db, $fetch_email);

      if(mysqli_num_rows($query_name)) {
        echo "There is already a parent with that name!";
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

		if($parentName == "" || $address =="" || $city =="" ||
         $state =="" || $zip =="" || $cellPhone =="" || $workPhone ==""
         || $email =="") {
			echo "<section class='content'>
			<h2>Incomplete Child</h2>
         <p>This is what was submitted.</p>
			 <h3>Parent's First and Last Name: $parentName</h3>
 			 <h3>Address: $address</h3>
 			 <h3>City: $city</h3>
 			 <h3>State: $state</h3>
 			 <h3>Zip code: $zip</h3>
 			 <h3>Cell phone: $cellPhone</h3>
 			 <h3>Work phone: $workPhone</h3>
 			 <h3>Email: $email</h3>
			</section>";
			return;
		}

		mysqli_query($db, $sql);
		header("Location: parents.php");
		return;
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - New Parent</title>
<?php include('header.php'); ?>

<section class="content">
	<h2>Add a Parent</h2>
	<form action="new_parent.php" method="post" enctype="multipart/form-data">

      <input placeholder="First and Last Name" name="parentName" type="text" autofocus>
      <input placeholder="Address" name="address" type="text">
      <input placeholder="City" name="city" type="text">
      <input placeholder="State Abreviation" name="state" type="text" maxlength="2">
      <input placeholder="Zip code" name="zip" type="text">
      <input placeholder="Cell Phone Number" name="cellPhone" type="number">
      <input placeholder="Work Phone Number" name="workPhone" type="number">
      <input placeholder="E-Mail Address" name="email" type="email">

		<input name="new_parent" type="submit" value="Add Parent">
	</form>
</section>

<?php include('footer.php'); ?>

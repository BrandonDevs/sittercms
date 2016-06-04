<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['pid'])) {
		header("Location: index.php");
		}

	$pid = $_GET['pid'];

	if(isset($_POST['update'])) {
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

		$sql = "UPDATE parent SET parentName='$parentName', address='$address',
		city='$city', state='$state', zip='$zip', cellPhone='$cellPhone', workPhone='$workPhone', email='$email' WHERE parentID = $pid";

      if($parentName == "" || $address =="" || $city =="" ||
         $state =="" || $zip =="" || $cellPhone =="" || $workPhone ==""
         || $email =="") {
			echo "<section class='content'>
			<h2>Incomplete Child</h2>
         <p>This is what was submitted.</p>
			 <h3>Parents's First and Last Name: $parentName</h3>
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
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - Edit Parent</title>
<?php include('header.php'); ?>

<section class="content">

<?php
	$sql_get = "SELECT * FROM parent WHERE parentID = $pid LIMIT 1";
	$res = mysqli_query($db, $sql_get);

	if(mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$parentName = $row['parentName'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$cellPhone = $row['cellPhone'];
			$workPhone = $row['workPhone'];
			$email = $row['email'];

		echo "<form action='edit_parent.php?pid=$pid' method='post' enctype='multipart/form-data'>";
		echo "<input placeholder='First Name' name='parentName' type='text' value='$parentName' autofocus size='48'><br /><br />";
		echo "<input placeholder='Address' name='address' type='text' value='$address'><br />";
      echo "<input placeholder='City' name='city' type='text' value='$city'><br />";
      echo "<input placeholder='State Abreviation' name='state' type='text' maxlength='2' value='$state'><br />";
      echo "<input placeholder='Zip code' name='zip' type='text' value='$zip'><br />";
      echo "<input placeholder='Cell Phone Number' name='cellPhone' type='number' value='$cellPhone'><br />";
      echo "<input placeholder='Work Phone Number' name='workPhone' type='number' value='$workPhone'><br />";
      echo "<input placeholder='E-Mail Address' name='email' type='email' value='$email'><br />";

		}
	}
?>

<input name="update" type="submit" value="Update">
</form>

</section>

<?php include('footer.php'); ?>

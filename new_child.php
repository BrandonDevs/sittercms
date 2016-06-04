<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(isset($_POST['new_child'])) {
		$childName = strip_tags($_POST['childName']);
		$childAge = strip_tags($_POST['childAge']);
		$childSex = strip_tags($_POST['childSex']);
		$extra = strip_tags($_POST['extra']);
		$parentID = strip_tags($_POST['parentID']);

		$childName = mysqli_real_escape_string($db, $childName);
		$childAge = mysqli_real_escape_string($db, $childAge);
		$childSex = mysqli_real_escape_string($db, $childSex);
		$extra = mysqli_real_escape_string($db, $extra);
		$parentID = mysqli_real_escape_string($db, $parentID);

		$sql = "INSERT into child (childName, childAge, childSex, extra, parentID)
		VALUES ('$childName', '$childAge', '$childSex', '$extra', '$parentID')";

		if($childName == "" || $childAge == "" || $childSex == "" || $parentID == "") {
			echo "<section>
			<h2>Incomplete Child</h2>
			 <h3>Name: $childName</h3>
			 <h3>Parent ID: $parentID</h3>
 			 <h3>Age: $childAge</h3>
 			 <h3>Child: $childSex</h3>
 			 <h3>Extras: $extra</h3>
			</section>";
			return;
		}

		mysqli_query($db, $sql);
		header("Location: children.php");
		return;
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - New Child</title>
<?php include('header.php'); ?>

<section class="content">
	<h2>Add a Child<h2>
	<form action="new_child.php" method="post" enctype="multipart/form-data">

		<input placeholder="First and Last Name" name="childName" type="text" autofocus><br />
		<input placeholder="Age" name="childAge" type="text" maxlength="2"><br />
		<input placeholder="Sex" name="childSex" type="text" maxlength="1"><br />
		<textarea placeholder="Conditions and etc." name="extra" type="text" rows="10" cols="50"></textarea><br />
		<input placeholder="Parent ID" name="parentID" type="number"><br />

		<input name="new_child" type="submit" value="Add Child">
	</form>
</section>

<?php include('footer.php'); ?>

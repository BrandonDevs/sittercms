<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['cid'])) {
		header("Location: index.php");
		}

	$cid = $_GET['cid'];

	if(isset($_POST['update'])) {
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

		$sql = "UPDATE child SET childName='$childName', childAge='$childAge',
		childSex='$childSex', extra='$extra', parentID='$parentID'
		 WHERE childID = $cid";

		if($childName == "" || $childAge == "" || $childSex == "" || $parentID == "") {
			echo "Child incomplete.";
			return;
		}

		mysqli_query($db, $sql);

		header("Location: children.php");
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - Edit Child</title>
<?php include('header.php'); ?>

<section class="content">

<?php
	$sql_get = "SELECT * FROM child WHERE childID = $cid LIMIT 1";
	$res = mysqli_query($db, $sql_get);

	if(mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$childName = $row['childName'];
			$childAge = $row['childAge'];
			$childSex = $row['childSex'];
			$extra = $row['extra'];
			$parentID = $row['parentID'];

		echo "<form action='edit_child.php?cid=$cid' method='post' enctype='multipart/form-data'>";
		echo "<input placeholder='First and Last Name' name='childName' type='text' value='$childName' autofocus size='48'><br />";
		echo "<input placeholder='Age' name='childAge' type='text' value='$childAge'><br />";
		echo "<input placeholder='Sex' name='childSex' type='text' value='$childSex'><br />";
		echo "<textarea placeholder='extra' name='extra' type='text' rows='20' cols='50'>$extra</textarea><br />";
		echo "<input placeholder='ParentID' name='parentID' type='text' value='$parentID'><br />";
		}
	}
?>

<input name="update" type="submit" value="Update">
</form>

</section>

<?php include('footer.php'); ?>

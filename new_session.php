<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(isset($_POST['new_session'])) {
		$date = strip_tags($_POST['date']);
		$duration = strip_tags($_POST['duration']);
		$childID = strip_tags($_POST['childID']);
		$staffID = strip_tags($_POST['staffID']);
		$bill = strip_tags($_POST['bill']);

		$date = mysqli_real_escape_string($db, $date);
		$duration = mysqli_real_escape_string($db, $duration);
		$childID = mysqli_real_escape_string($db, $childID);
		$staffID = mysqli_real_escape_string($db, $staffID);
		$bill = mysqli_real_escape_string($db, $bill);

		$sql = "INSERT into session (date, duration, childID, staffID, bill) VALUES ('$date', '$duration', '$childID', '$staffID', '$bill')";

		if($date == "" || $duration =="" || $childID =="") {
			echo "<section class='content'>
			<h2>Incomplete Session</h2>
         <p>This is what was submitted.</p>
			 <h3>Date: $date</h3>
 			 <h3>duration: $duration</h3>
 			 <h3>ChildID: $childID</h3>
			</section>";
			return;
		}

		mysqli_query($db, $sql);
		header("Location: sessions.php");
		return;
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - New Parent</title>
<?php include('header.php'); ?>

<section class="content">
	<h2>New Session</h2>
	<form action="new_session.php" method="post" enctype="multipart/form-data">

<?php
   echo "<input placeholder='Date' name='date' type='date' autofocus>
	      <input placeholder='duration of Session in Hrs' name='duration' type='text' maxduration='5'>
	      <input placeholder='ChildID' name='childID' type='text'>";

			$staffID = $_SESSION['staffID'];
			$bill = 'Waiting';

			echo "<input value='$staffID' name='staffID' type='text' class='hideSessionInput'>";
			echo "<input value='$bill' name='bill' type='text' class='hideSessionInput'>";
?>
		<input name="new_session" type="submit" value="Add Session">
	</form>

</section>

<?php include('footer.php'); ?>

<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['sid'])) {
		header("Location: sessions.php");
		}

	$sid = $_GET['sid'];

	if(isset($_POST['update'])) {
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

		$sql = "UPDATE session SET date='$date', duration='$duration', childID='$childID', staffID='$staffID', bill='$bill' WHERE sessionID = $sid";

		mysqli_query($db, $sql);

		header("Location: sessions.php");
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - Edit Session</title>
<?php include('header.php'); ?>

<section class="content">

<?php
	$sql_get = "SELECT * FROM session WHERE sessionID = $sid LIMIT 1";
	$res = mysqli_query($db, $sql_get);

	echo "<table style='width: 100%' border='1px black solid'>
	  <tr>
	  	 <th>Billed?</th>
		 <th>Date</th>
		 <th>Duration</th>
		 <th>ChildID</th>
		 <th>Delete?</th>
	  </tr>

	";

	if(mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$date = $row['date'];
			$duration = $row['duration'];
			$childID = $row['childID'];
			$staffID = $row['staffID'];
			$bill = $row['bill'];

			echo "<form action='edit_session.php?sid=$sid' method='post' enctype='multipart/form-data'>";

		   echo "<tr>
	<td>
		<div class='center'>
			<select type='options' name='bill' value='$bill'>
				<option value='Sent'>Sent</option>
				<option value='Waiting'>Waiting</option>
				<option value='Paid'>Paid</option>
			</select>
		</div>
	</td>

	<td align='center'>
		<input placeholder='Date' name='date' type='date' value='$date' autofocus>
	</td>

	<td align='center'>
		<input placeholder='duration of Session in Hrs' name='duration' type='text' maxlength='3' value='$duration'>
	</td>

	<td align='center'>
		<input placeholder='ChildID' name='childID' type='text' value='$childID'>
	</td>";

	echo "<input value='$staffID' name='staffID' type='text' class='hideSessionInput'>";
	echo "
	<td align='center'>
		<div class='center'>
			<a href='del_session.php?sid=$sid'>Delete</a>
		</div>
	</td>

	</tr>";
					// echo <input value='$bill' name='bill' type='text'>
		}

		echo "</table>";
	}
?>
	<div class='center'>
		<input name="update" type="submit" value="Update">
	</div>
</form>

</section>

<?php include('footer.php'); ?>

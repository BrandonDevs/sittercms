<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['eid'])) {
		header("Location: activities.php");
		} else {
			$eid = $_GET['eid'];
			$sql = "DELETE FROM event WHERE eventID = $eid";
			mysqli_query($db, $sql);
			header("Location: activities.php");
		}
?>

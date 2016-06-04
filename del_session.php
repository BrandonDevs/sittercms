<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['sid'])) {
		header("Location: sessions.php");
		} else {
			$sid = $_GET['sid'];
			$sql = "DELETE FROM session WHERE sessionID = $sid";
			mysqli_query($db, $sql);
			header("Location: sessions.php");
		}
?>

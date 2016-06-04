<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['cid'])) {
		header("Location: children.php");
		} else {
			$cid = $_GET['cid'];
			$sql = "DELETE FROM child WHERE childID = $cid";
			mysqli_query($db, $sql);
			header("Location: children.php");
		}

		/*
			ALTER TABLE child AUTO_INCREMENT = 1
		*/

		// Starts IDs at 1 again
?>

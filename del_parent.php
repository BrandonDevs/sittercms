<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['pid'])) {
		header("Location: parents.php");
		} else {
			$pid = $_GET['pid'];
			$sql = "DELETE FROM parent WHERE parentID = $pid";
			mysqli_query($db, $sql);
			header("Location: parents.php");
		}
?>

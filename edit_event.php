<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(!isset($_GET['eid'])) {
		header("Location: activities.php");
		}

	$eid = $_GET['eid'];

	if(isset($_POST['update'])) {
		$title = strip_tags($_POST['title']);
      $content = strip_tags($_POST['content']);
      $start = strip_tags($_POST['start']);

		$title = mysqli_real_escape_string($db, $title);
		$content = mysqli_real_escape_string($db, $content);
		$start = mysqli_real_escape_string($db, $start);

		$sql = "UPDATE event SET title='$title', content='$content', start='$start' WHERE eventID = $eid";

		mysqli_query($db, $sql);

		header("Location: activities.php");
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - Edit Event</title>
<?php include('header.php'); ?>

<section class="content">

<?php
	$sql_get = "SELECT * FROM event WHERE eventID = $eid LIMIT 1";
	$res = mysqli_query($db, $sql_get);

	if(mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$title = $row['title'];
			$content = $row['content'];
			$start = $row['start'];

		echo "<form action='edit_event.php?eid=$eid' method='post' enctype='multipart/form-data'>";
		echo "<input placeholder='Title' name='title' type='text' value='$title' autofocus size='48'><br />";
      echo "<textarea placeholder='Content' name='content' type='text' rows='20' cols='50'>$content</textarea><br />";
      echo "<input placeholder='Date' name='start' type='text' value='$start'><br />";

		}
	}
?>

<input name="update" type="submit" value="Update">
</form>

</section>

<?php include('footer.php'); ?>

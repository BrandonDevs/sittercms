<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(isset($_POST['new_event'])) {
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);
		$start = strip_tags($_POST['start']);

		$title = mysqli_real_escape_string($db, $title);
		$content = mysqli_real_escape_string($db, $content);
		$start = mysqli_real_escape_string($db, $start);

		$sql = "INSERT into event (title, content, start) VALUES ('$title', '$content', '$start')";

		if($title == "" || $content =="" || $start =="") {
			echo "<section class='content'>
			<h2>Incomplete Event</h2>
         <p>This is what was submitted.</p>
			 <h3>Title: $title</h3>
 			 <h3>Content: $content</h3>
 			 <h3>Start: $start</h3>
			</section>";
			return;
		}

		mysqli_query($db, $sql);
		header("Location: activities.php");
		return;
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - New Event</title>
<?php include('header.php'); ?>

<section class="content">
	<h2>Add an Event</h2>
	<form action="new_event.php" method="post" enctype="multipart/form-data">

      <input placeholder="Title" name="title" type="text" autofocus><br />
      <textarea placeholder="Content" name="content" type="text" rows="20" cols="50"></textarea><br />
      <input placeholder="Start Date" name="start" type="text"><br /><br />

		<input name="new_event" type="submit" value="Add Event">
	</form>
</section>

<?php include('footer.php'); ?>

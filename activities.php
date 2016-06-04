<?php
	session_start();
	include_once("db.php");
	include("constants.php");
?>

<?php include 'head.php'; ?>

<title>SitterCMS - Babysitter Management System</title>

<?php include 'header.php'; ?>

<article class="content">

<h2 class='center'>Special Events</h2>

<p>Children love to be entertained and we love education so we combine the two with our monthly field trips and special
events.</p>

<?php

require_once("nbbc/nbbc.php");

$bbcode = new BBCode;

$sql = "SELECT * FROM event ORDER BY eventID DESC";
$res = mysqli_query($db, $sql) or die(mysqli_error());

if(mysqli_num_rows($res) > 0) {
	while($row = mysqli_fetch_assoc($res)) {
		$eventID = $row['eventID'];
		$title = $row['title'];
		$content = $row['content'];
		$start = $row['start'];

		$output = $bbcode->Parse($content);

      if($_SESSION['staffID'] == $admin){
       $edit = "<div><a href='edit_event.php?eid=$eventID' class='adminEdit'>Edit</a>
      	<a href='del_event.php?eid=$eventID' class='adminDel'>Delete</a>
      	</div>";
      }

		echo "$edit<h3 class='center'>$title</h3>
            <p>$output</p>
            <p>$start</p>";
	        }
	} else {
		echo "There are no events currently.";
	}
?>

<h3>Field Trips</h3>

<p>We make regular visits to our area favorite <a href="http://www.childrensmuseumstockton.org">Children's Museum of Stockton</a>, <a href="http://www.mgzoo.com">Micke Grove Park
and Zoo</a>, Modesto’s <a href="http://www.thehousemodesto.com/kidspace">Kidspace</a>, <a href="https://www.gilroygardens.org">Bonfonte Gardens </a>and various other local parks and attractions.</p>

<h3>Activities</h3>

<p>These are just a sample of some of the exciting events! <br><br>
The wonderful folks over at <a href="http://www.michaels.com">Michael’s </a> pay us monthly visits with craft projects
parents can recreate at home.<br><br>
Julie Stoddard, yoga teacher extraordinaire gives kids a fun new way to stay healthy.<br><br>
Chef Manu Feildel from <a href="http://www.ardoisesf.com/">La Ardoise SF</a> loves to teach kids how to make tasty but healthy treats.<br><br>
Creative Kids offers paint instruction followed by a mobile gallery showing. <br><br>
Joe Miller is always w8illing to bring his four legged pals of the Golden Meadows Farm Friends for a visit! </p>

</article>

<?php include 'footer.php'; ?>

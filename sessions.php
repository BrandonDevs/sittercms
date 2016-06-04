<?php
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])) {
     header("Location: login.php");
	  return;
   }
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Childcare - Sessions</title>
<?php include('header.php'); ?>

<?php

$searchOutput = '';

if(isset($_POST['search'])){
   $searchq = $_POST['search'];
   $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

	$sqlSearch = "SELECT * FROM session WHERE bill LIKE '%$searchq%'";
// Options: Paid, Emailed, Waiting

   $query = mysqli_query($db, $sqlSearch) or die(mysqli_error());

   if(mysqli_num_rows($query) < 0){
      $searchOutput = 'Nothing found.';
   } else {
      while($row = mysqli_fetch_assoc($query)){
			$sessionID = $row['sessionID'];
			$date = $row['date'];
			$duration = $row['duration'];
			$bill = $row['bill'];

			if($duration < 1.01){
				$hr = 'hr';
			} else {
				$hr = 'hrs';
			}

			$childID = $row['childID'];
			$staffID = $row['staffID'];

         $searchOutput .= "
			<tr>
				<form action='change.php' method='get'>
					<td align='center'><input type='checkbox' name='options' value='$change'></td>
					<td align='center'><a href='edit_session.php?sid=$sessionID'>$sessionID</a></td>
					<td align='center'>$date</td>
					<td align='center'>$duration $hr</td>
					<td align='center'><a href='view_child.php?cid=$childID'>$childID</td>
					<td align='center'>$staffID</td>
					<td align='center'>$bill</td>
			</tr>";
      }
   }
}

?>

<?php

if(isset($_POST['choose'])){

   $choose = $_POST['choose'];

	if($choose == 'Send'){
		/*
			- Sets bills to "sent"

			- Groups all the same ChildID

				- Adds all "$duration"s

				- $owe = $duration * $perhour

				- Gets "email" from "ChildID" from "ParentID"
		*/

		include('email.php');

	} elseif ($choose == 'Delete') {
		// Delete selected sessions

	} else {
		// $CHOOSE == 'PAID'

	}
}

?>

<section class="content" id="title">
   <h2 class="center">List of Sessions</h2>
</section>

<section class="content">
   <ul id="dash-nav">
		<?php include 'dash-menu.php'; ?>
   </ul>
</section>

<ul id="dash-new">
	<?php include 'dash-new.php'; ?>
</ul>

<section class="content">

	<form action"sessions.php" method="post">
		<select type="options" name="search" id="search">
		  <option value="Waiting">Waiting</option>
		  <option value="Sent">Sent</option>
		  <option value="Paid">Paid</option>
		</select>
	   <input type="submit" value="Show" id="searchBtn"/>
	</form>

	<div class="do">
		<form action"sessions.php" method="post">
			<select type="options" name="choose" id="do">
			  <option value="Send">Send</option>
			  <option value="Delete">Delete</option>
			  <option value="Paid">Paid</option>
			</select>
		   <input type="submit" value="Do" id="doBtn"/>
	</div>

	<table style="width: 100%" border="1px black solid">
	  <tr>
		 <th><input type="checkbox" onClick="toggle(this)" name="session"/></th>
		 <th>ID</th>
		 <th>Date</th>
		 <th>duration</th>
		 <th>Child</th>
		 <th>Staff</th>
		 <th>Bill</th>
	  </tr>

		<?php print("$searchOutput"); ?>
		</form>
	</table>

</section>

<?php include('footer.php'); ?>

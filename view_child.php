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
<title>ABC Childcare - Child</title>
<?php include('header.php'); ?>

<?php

require_once("nbbc/nbbc.php");

$bbcode = new BBCode;

$cid = $_GET['cid'];

$sql = "SELECT * FROM child WHERE childID = $cid LIMIT 1";

$res = mysqli_query($db, $sql) or die(mysql_error());

if(mysqli_num_rows($res) > 0) {
	while($row = mysqli_fetch_assoc($res)) {
		$childID = $row['childID'];
		$childName = $row['childName'];
		$childAge = $row['childAge'];
		$childSex = $row['childSex'];
		$extra = $row['extra'];
		$parentID = $row['parentID'];

		$admin = "<div><a href='edit_child.php?cid=$childID' class='adminEdit'>Edit</a>
		<a href='del_child.php?cid=$childID' class='adminDel'>Delete</a>
		</div> ";

	// for BB Code	$output = $bbcode->Parse($content);

		$child = "<section class='content'>$admin<h2 class='center'>$childName</h2>
			<table style='width: 100%' border='1px black solid'>
				<tr>
					<th>ID</th>
					<th>Age</th>
					<th>Sex</th>
					<th>Parent</th>
				</tr>
				<tr>
					<td align='center'>$childID</td>
					<td align='center'>$childAge</td>
					<td align='center'>$childSex</td>
					<td align='center'><a href='view_parent.php?pid=$parentID'>View Parent</a></td>
				</tr>
			</table>

			<p>$extra</p>
		</section>";
	}
	echo $child;
} else {
	echo "Child does not exist.";
}
?>

<?php include('footer.php'); ?>

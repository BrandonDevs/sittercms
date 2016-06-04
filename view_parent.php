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
<title>ABC Childcare - Parent</title>
<?php include('header.php'); ?>

<?php

require_once("nbbc/nbbc.php");

$bbcode = new BBCode;

$pid = $_GET['pid'];

$sql = "SELECT * FROM parent WHERE parentID = $pid LIMIT 1";

$res = mysqli_query($db, $sql) or die(mysql_error());

if(mysqli_num_rows($res) > 0) {
	while($row = mysqli_fetch_assoc($res)) {
		$parentID = $row['parentID'];
		$parentName = $row['parentName'];
		$address = $row['address'];
		$city = $row['city'];
		$state = $row['state'];
		$zip = $row['zip'];
		$cellPhone = $row['cellPhone'];
		$workPhone = $row['workPhone'];
		$email = $row['email'];

		$admin = "<div><a href='edit_parent.php?pid=$parentID' class='adminEdit'>Edit</a>
		<a href='del_parent.php?pid=$parentID' class='adminDel'>Delete</a>
		</div> ";

	// for BB Code	$output = $bbcode->Parse($content);

		$parent = "<section class='content'>$admin<h2 class='center'>$parentName</h2>

		<table style='width: 100%' border='1px black solid'>
			<tr>
				<th>ParentID</th>
				<td align='center'>$parentID</td>
			</tr>

			<tr>
				<th>Address</th>
				<td align='center'>$address</td>
			</tr>

			<tr>
				<th>City</th>
				<td align='center'>$city</td>
			</tr>

			<tr>
				<th>State</th>
				<td align='center'>$state</td>
			</tr>

			<tr>
				<th>Zip</th>
				<td align='center'>$zip</td>
			</tr>

			<tr>
				<th>Cell #</th>
				<td align='center'>$cellPhone</td>
			</tr>

			<tr>
				<th>Work #</th>
				<td align='center'>$workPhone</td>
			</tr>

			<tr>
				<th>Email</th>
				<td align='center'>$email</td>
			</tr>

		</table>

		</section>";
	}
	echo $parent;
} else {
	echo "Nobody selected.";
}
?>

<?php include('footer.php'); ?>

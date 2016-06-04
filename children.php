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
<title>ABC Childcare - Children List</title>
<?php include('header.php'); ?>

<?php

$searchOutput = '';

if(isset($_POST['search'])){
   $searchq = $_POST['search'];
   $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

	$sqlSearch = "SELECT * FROM child WHERE childName LIKE '%$searchq%'";

   $query = mysqli_query($db, $sqlSearch) or die(mysqli_error());

   if(mysqli_num_rows($query) < 0){
      $searchOutput = 'Nothing found';
   } else {
      while($row = mysqli_fetch_assoc($query)){
			$childID = $row['childID'];
         $childName = $row['childName'];

         $searchOutput .= "<div>
			<h3><a href='view_child.php?cid=$childID'>$childName</a></h3>
			</div>";
      }
   }
}

?>

<section class="content" id="title">
   <h2 class="center">List of Children</h2>
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
	<div class="center">
		<form action"children.php" method="post">
		   <input type="text" name="search" placeholder="Search by name." id="search"/>
		   <input type="submit" value="Search" id="searchBtn"/>
		</form>
	</div>
	<?php print("$searchOutput"); ?>
</section>

<section class="content">

<?php

$sql = "SELECT * FROM child ORDER BY childID DESC";
$res = mysqli_query($db, $sql) or die(mysqli_error());

echo "<section class='content'>
<table style='width: 100%' border='1px black solid'>
  <tr>
	 <th>Child</th>
	 <th>Age</th>
	 <th>Sex</th>
	 <th>Parent</th>
  </tr>";

if(mysqli_num_rows($res) > 0) {
	while($row = mysqli_fetch_assoc($res)) {
		$childID = $row['childID'];
		$childName = $row['childName'];
		$childAge = $row['childAge'];
		$childSex = $row['childSex'];
		$extra = $row['extra'];
		$parentID = $row['parentID'];

		$sql2 = "SELECT parentName FROM parent WHERE parentID =".$row["parentID"];
		$res2 = mysqli_query($db, $sql2) or die(mysqli_error());

		while($row2 = mysqli_fetch_assoc($res2)) {
			$parentName = $row2["parentName"];
			// $parentName = ".$row['parentName']";
		}

/*	Not used on main page
		$admin = "<div><a href='edit_child.php?cid=$childID' class='adminEdit'>Edit</a>
		<a href='del_child.php?cid=$childID' class='adminDel'>Delete</a>
		</div> ";
*/
		echo "<tr>
			    <td align='center'><a href='view_child.php?cid=$childID'>$childName</td>
				 <td align='center'>$childAge</td>
				 <td align='center'>$childSex</td>
			    <td align='center'><a href='view_parent.php?pid=$parentID'>$parentName</td>
			  </tr>";
	}

	} else {
		echo "<td width='100%'>There are no children currently.</td>";
	}

	echo "</table></section>";
?>

</section>

<?php include('footer.php'); ?>

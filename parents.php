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
<title>ABC Childcare - Parent List</title>
<?php include('header.php'); ?>

<?php

$searchOutput = '';

if(isset($_POST['search'])){
   $searchq = $_POST['search'];
   $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

	$sqlSearch = "SELECT * FROM parent WHERE parentName LIKE '%$searchq%'";

   $query = mysqli_query($db, $sqlSearch) or die(mysqli_error());

   if(mysqli_num_rows($query) < 0){
      $searchOutput = 'Nothing found';
   } else {
      while($row = mysqli_fetch_assoc($query)){
			$pID = $row['pID'];
         $parentName = $row['parentName'];

         $searchOutput .= "<div>
			<h3><a href='view_parent.php?pid=$pID'>$parentName</a></h3>
			</div>";
      }
   }
}

?>

<section class="content" id="title">
   <h2 class="center">List of Parents</h2>
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
		<form action"parents.php" method="post">
		   <input type="text" name="search" placeholder="Search by name" id="search"/>
		   <input type="submit" value="Search" id="searchBtn"/>
		</form>
	</div>
	<?php print("$searchOutput"); ?>
</section>

<section class="content">

<?php

$sql = "SELECT * FROM parent ORDER BY parentID DESC";

$res = mysqli_query($db, $sql) or die(mysqli_error());

if(mysqli_num_rows($res) > 0) {
	while($row = mysqli_fetch_assoc($res)) {
		$parentID = $row['parentID'];
		$parentName = $row['parentName'];

/*	Not used on main page
		$admin = "<div><a href='edit_child.php?cid=$childID' class='adminEdit'>Edit</a>
		<a href='del_child.php?cid=$childID' class='adminDel'>Delete</a>
		</div> ";
*/
		echo "<section class='item'>

		<h3>
			<a href='view_parent.php?pid=$parentID'>$parentName</a>
		</h3>

		</section>";
	}

	} else {
		echo "There are no parents currently.";
	}

?>

</section>

<?php include('footer.php'); ?>

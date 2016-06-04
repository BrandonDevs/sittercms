<?php
	session_start();
	include_once("db.php");
	include("constants.php");

	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if(isset($_POST['send_bill'])) {
		$email = strip_tags($_POST['email']);
		$duration = strip_tags($_POST['duration']);

		$email = mysqli_real_escape_string($db, $email);
		$duration = mysqli_real_escape_string($db, $duration);

		$owe = $duration * $perhour;

		$to = $email;
		// $to = "branign@outlook.com";
	   $subject = "Your Invoice is Ready";
	   $headers = "MIME-Version: 1.0" . "\r\n";
	   $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	   $headers .= "From: ABC ChildCare" . "\r\n";
	   $headers .= "Reply-To:<donotreply@abc-child-care.com>" . "\r\n";
	   $headers .= "X-Mailer: PHP/" . phpversion();

		   $message = "Thank you for choosing ABC Childcare. Your current balance is $$owe. <br><br>
			Please remit payment within two weeks. <br><br>
			Thank you, <a href='http://www.branign.com/sitter'>ABC Childcare</a>";

		mail($to, $subject, $message, $headers);

		if($email == "" || $duration == "") {
			echo "<section>
			<h2>Incomplete Child</h2>
			 <h3>Email: $email</h3>
			 <h3>Duration: $duration</h3>
			</section>";
			return;
		}

		header("Location: children.php");
		return;
	}
?>

<?php include('head.php'); ?>
<link rel="stylesheet" href="style.css"/>
<title>ABC Daycare - Email Bill</title>
<?php include('header.php'); ?>

<section class="content">
	<h2>Email Bill</h2>
	<form action="new_bill.php" method="post" enctype="multipart/form-data">

		Email: <input placeholder="Email" name="email" type="text" autofocus><br />
		Duation: <input placeholder="Duration" name="duration" type="text"><br />

		<input name="send_bill" type="submit" value="Email">
	</form>
</section>

<?php include('footer.php'); ?>

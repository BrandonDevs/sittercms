<?php

include("constants.php");

$owe = $duration * $perhour;

$to = $email;
// $to = "branign@outlook.com";
$subject = "Your Invoice is Ready";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers .= "From: ABC ChildCare" . "\r\n";
$headers .= "Reply-To:<donotreply@abc-child-care.com>" . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$message = "Thank you for choosing ABC Childcare. Your current balance is $$owe. <br/><br/>
Please remit payment within two weeks. <br/><br/>
Thank you, <a href='http://www.branign.com/sitter'>ABC Childcare</a>";

mail($to, $subject, $message, $headers);

if($email == "" || $duration == "") {
	echo "<section>
	<h2>Incomplete Email</h2>
	 <h3>Email: $email</h3>
	 <h3>Duration: $duration</h3>
	</section>";
	return;
}

?>

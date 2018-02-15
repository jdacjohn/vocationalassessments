<?php
	// Grab the vars from the form
	$name = trim(utf8_decode($_POST['realname']));
	$recipient = trim(utf8_decode($_POST['recipient']));
	$email = stripslashes(trim(utf8_decode($_POST['email'])));
	$comments = stripslashes(trim(utf8_decode($_POST['comments'])));
	
	if ($recipient == '') {
		$recipient = 'VIPServicesTexas@gmail.com';
	}
	//$recipient = "jarnold@2k3technologies.com";

	$subject = $_POST['subject'];
	$env_reort = $_POST['env_report'];
	
	if ($name == '' || $email == '') {
		header("Location:http:./contact_error.php");
	} else {
		$msg = "Website Contact Information: \n" .
			"Name:  $name \n" .
			"Email:  $email \n\n" .
			"Comments:\n\n$comments\n\n" .
			"Env:  $env_report";
	
		mail($recipient,$subject,$msg,"From: $name <$email>");
		$name = '';
		$email = '';
		$comments = '';
		$msg = '';
		
	
		header("Location:http:./thank_you.php");
	}
	
?>
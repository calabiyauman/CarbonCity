<?php

require_once "str_basics.php";
require_once "utf8.php";
require_once "smtp.php";

if(isset($_POST['email'])) {
	
	$email_to = "sales@carboncitycreative.com";
	$email_subject = "Test Email";
	
	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validate expected data exists
	if(!isset($_POST['realname']) ||
		!isset($_POST['email']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');		
	}
	
	$realname = $_POST['realname']; // required
	$email_from = $_POST['email']; // required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}$";
  if(!eregi($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
	$string_exp = "^[a-z .'-]+$";
  if(!eregi($string_exp,$realname)) {
  	$error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  
  if(strlen($comments) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\
\
";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Name: ".clean_string($realname)."\
";
	$email_message .= "Email: ".clean_string($email_from)."\
";
	$email_message .= "Comments: ".clean_string($comments)."\
";
	
	
$smtpoptions = array(
  "headers" => GetEmailUserAgent("Thunderbird"),
  "textmessage" => $email_message,
  "server" => "mail.website.com",
  "port" => 25,
  "secure" => false,
  "username" => "loginusername",
  "password" => "*******",
  "usedns" => false
);

SendEmail($email_from, $email_to, $email_subject, $smtpoptions);
?>

Sorry, automatic email handling is currently receiving maintenance, please send your message to email@domain.com
<br />
<a href="index.html">back</a>
<?
}
?>

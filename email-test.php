<?php




$to = 'carnahandouglas@gmail.com';
$subject = 'This is a test subject';
$message = 'This is a test email from my php code';
$sendmail = mail($to,$subject,$message);




if($sendmail) {
echo 'sent';
} else {
echo 'failed';
}




?>
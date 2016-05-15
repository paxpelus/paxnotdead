<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	

$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";

send_mail("Contact from paxnotdead.com", $message);


function send_mail($subject,$msg) {
 $api_key="key-1ea86a2ef8d67a66077bb7723535c1a5";/* Api Key got from https://mailgun.com/cp/my_account */
 $domain ="paxnotdead.com";/* Domain Name you given to Mailgun */
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
 curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/'.$domain.'/messages');
 curl_setopt($ch, CURLOPT_POSTFIELDS, array(
  'from' => 'PaxNotDead <noreply@paxnotdead.com>',
  'to' => 'panagiotis.iatrou@gmail.com',
  'subject' => $subject,
  'html' => $msg
 ));
 $result = curl_exec($ch);
 curl_close($ch);
 return $result;
}

?>
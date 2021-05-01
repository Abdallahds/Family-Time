<html>
<head>
<style>
            input[type='submit']
			{
				background-color:#99ff99;
				width:150px;
				height:40px;
				
			}
			
			input
			{
				border-radius:12px;
				border-color:black;
			}

			input[type='email']
			{
			width:300px;
			height:30px;
			}

			input:hover[type='email']
			{
				background-color:#00ff00;
			}
			input:hover[type='submit']
			{
			background-color:#00ff00;
			width:170px;
			height:50px;
			}
</style>
</head>
<center>
<h1>
"Help us by invite your friends"
</h1>

<fieldset>
<form method="post">
your friend's EMAIL:<input type="email" name="email" required/>
<input type="submit" name="send" value="Send"/>
</form>
</fieldset>
</center>

</html>
<?php
if(isset($_POST['send']))
{
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'familytimeproject1@gmail.com';          // SMTP username
$mail->Password = 'Abdallah@123'; // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('familytimeproject1@gmail.com', 'Family time website');
$mail->addReplyTo('familytimeproject1@gmail.com', 'Family Time');
$mail->addAddress($_POST['email']);   // Add a recipient


$mail->isHTML(true); 

$bodyContent = '<h1>Hi my friend , check out our social media website www1.familytime.com</h1>';

$mail->Subject = 'Family time websit';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent,thank you very much for your support';
}
}
?>
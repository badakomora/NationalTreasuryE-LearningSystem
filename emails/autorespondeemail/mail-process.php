<?php
include_once 'database.php';
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$city_name = $_POST['city_name'];
$email = $_POST['email'];

/* sql query for inserting data into database */

mysqli_query($conn,"insert into employee (first_name,last_name,city_name,email) values ('$first_name','$last_name','$city_name','$email')") or die(mysqli_error());
require_once 'mailer/class.phpmailer.php';
/* creates object */
$mail = new PHPMailer(true);
$mailid = $email;
$subject = "Thank u";
$text_message = "Hello";
$message = "Thank You for Contact with us.";

try
{
$mail->IsSMTP();
$mail->isHTML(true);
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "files.000webhost.com";
$mail->Port = '21';
$mail->AddAddress($mailid);
$mail->Username ="poamdailynews";
$mail->Password ="(F3fiR7#hKB9_ea or R]5)lpl$@cn>/=cZ";
$mail->SetFrom('divyasundarsahu@gmail.com','Divyasundar Sahu');
$mail->AddReplyTo("divyasundarsahu@gmail.com","Divyasundar Sahu");
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AltBody = $message;
if($mail->Send())
{
echo "Thank you for register u got a notification through the mail you provide";
}
}
catch(phpmailerException $ex)
{
$msg = "
".$ex->errorMessage()."
";
}
?>
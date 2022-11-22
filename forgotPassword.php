<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
//Load Composer's autoloader
require 'vendor/autoload.php';

include('connection.php');

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$inputs = $decodedData['email'];
//$inputs = "zerihuntegenu5@gmail.com";


$SQL = "SELECT * FROM users WHERE email = '$inputs' || username = '$inputs' limit 1";
$commitSQL = mysqli_query($conn, $SQL);
$checkRow = mysqli_num_rows($commitSQL);
if($checkRow >0){

 while($featchEmail = mysqli_fetch_assoc($commitSQL)){
  $token=  $featchEmail['authentication_key'];
$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail -> isSMTP();
$mail -> Host = 'smtp.gmail.com';
$mail -> SMTPAuth = true;
$mail -> Username = 'p2bethiopia@gmail.com';
$mail -> Password = 'egqknjzjfqicjset';
$mail -> SMTPSecure = 'ssl';
$mail -> Port = 465;
$mail ->setFrom('p2bethiopia@gmail.com');
$mail ->addAddress($featchEmail['email']);
$mail ->isHTML(true);
$mail ->Subject = 'Place to be Ethiopia';
$mail ->Body = "
<div style='width: 100%;  text-align:center;'>
<div style='padding:12px; align-self: center'>
<h2 style='color:#333333;'> Password Reset</h2>
<p> If you lost your password or wish to reset it,
use link below</p>
<a href=http://app.p2b-ethiopia.com/ResetPassword.php?token=$token>Click Here</a>

<p>If you did not receive the mail check your spam folder</p>
<p style='width: 300px; font-size:12px; color: #535353; font-family: 'Roboto'; font-weight:400'>If you did not request password reset you can safely ignore this email,
 only a person with a access to your email can reset you account password.</p>
</div>
</div>
";
$mail-> Send();
$message = "succeed";

}
}
else {
  $message = "Entry match isn't found";
}

$response[]=array("message"=>$message);
echo json_encode($response);
 ?>

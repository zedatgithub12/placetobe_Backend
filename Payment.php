<?php
require 'vendor/autoload.php';
include "connection.php";
// include 'telebirr/src/Telebirr.php';


$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

// $TicketId =$decodedData["id"];
// $TicketType = $decodedData["type"];
// $UserId = $decodedData["userId"];
// $Username= $decodedData["username"];
// $Phone = $decodedData["phone"];
// $EventId = $decodedData["eventId"];
// $EventName = $decodedData["eventName"];
// $EachPrice =$decodedData["eachprice"];
// $quantity = $decodedData["quantity"];
// $agent = $decodedData["agent"];

$EachPrice =500;
$quantity = 3;
$EventName ="Tobiya";



$agent = 1;
$pay1 = new Melaku\Telebirr\Telebirr(
   $PUBLICKEY = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmmJ9lOK/6ucsyEFo0hhtL3MO1+yEcAZ4QMdi3FFck88BNKbJVLzkgol3LaDgsUgmrllR8nlYTJfq2jIoIVDvNljpetPZoO8mOqCAZXMG0oq+uJGQ/+p/rGSLceX8VnegttDw2ktZqghavQK4P6gqR4dfv7HL1GUP8uD+FPRZxqQhXQSdix1h1+D+eFiW7SeZJz+wCOevVVK22gp4F9T5rw7f3ZspITg4YhSRsmUxE5ApY7XITKjWjsvEIz9qLPECfBO5U2PGmVGAcHG5ClTP1Dbq3h0NyjAV76K0eHbCXJiBh0/YIK+l4ADeDwMgZylrUnpJ0iVjEIX4gql3rMlLVQIDAQAB",
   $APPKEY = "351b2f5ef9ce419aa7829b5d37436e9a",
   $APPID = "c046f0b9cf494583b14eec31c2e87070",
   $API = "http://196.188.120.3:11443/ammapi/service-openup/toTradeWebPay",
   $SHORTCODE ="220188",
   $NOTIFYURL="http://app.p2b-ethiopia.com/telebirr",
   $RETURNURL="https://www.p2b-ethiopia.com",
   $TIMEOUT='30',
   $RECIVER ="AFRO MINA DIGITAL TECHNOLOGIES PLC",
   $totalAmount = $EachPrice * $quantity,
   $subject = $EventName,
 );
 //var_dump($pay1->getPyamentUrl());

if($agent == 2){
  echo "chapa";
}
else {
  //header("Location:" . $pay1->getPyamentUrl());
  echo $pay1->getPyamentUrl();
}



?>

<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

 $eventId = $decodedData['eventId'];
 $userId=$decodedData['userId'];
// $eventId = 88;
// $userId=98;
$cancelFlag = 1;
$CancelQuery = "UPDATE events SET cancelled= '$cancelFlag' WHERE event_id ='$eventId' AND userId = '$userId' Limit 1";
$Commit= mysqli_query($conn, $CancelQuery);

if($Commit){
  $message = "succeed";
  //echo $message;
}
else {
  $message = "cannot cancel";
    //echo $message;
}

$response[] = array("message"=> $message);
echo json_encode($response);
 ?>

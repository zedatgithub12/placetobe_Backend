<?php
include 'connection.php';

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$eventId= $decodedData['eventId'];
$userId= $decodedData['userId'];

$poster = $decodedData['poster'];
$eventName = $decodedData['title'];
$organizer = $decodedData['organizer'];

$startDate = $decodedData['SDate'];
$startTime = $decodedData['STime'];
$endDate = $decodedData['EDate'];
$endTime = $decodedData['ETime'];

$address = $decodedData['Address'];
$entraceFee = $decodedData['fee'];
$phone = $decodedData['phone'];
$latitude = $decodedData['latitude'];
$longitude = $decodedData['longitude'];

$redirectLink = $decodedData['link'];
$eventDescription = $decodedData['description'];

  //update event
$UpdateEvent = "UPDATE events SET event_image='$poster', event_name='$eventName', event_description='$eventDescription', start_date='$startDate', start_time='$startTime', end_date='$endDate', end_time='$endTime', event_organizer='$organizer', event_address='$address',
 address_latitude='$latitude', address_longitude='$longitude', contact_phone='$phone', redirectUrl='$redirectLink',event_entrance_fee='$entraceFee' WHERE event_id = '$eventId' and userId='$userId'";
 $commit = mysqli_query($conn, $UpdateEvent);
 if($commit){
   $message = "succeed";
 }
 else {
   $message = "cannot update!";
 }

 $response[] = array("message" => $message);
 echo json_encode($response);
 ?>

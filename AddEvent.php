<?php
include 'connection.php';

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$status = $decodedData['status'];
$userId= $decodedData['userId'];
$featuredImage = $decodedData['picture'];
$eventName = $decodedData['name'];
$evenDescription = $decodedData['about'];
$startDate = $decodedData['startD'];
$startTime = $decodedData['startT'];
$endDate = $decodedData['endD'];
$endTime = $decodedData['eTime'];
$organizer = $decodedData['eventOrganizers'];
$categories = $decodedData['eventCategories'];
$address = $decodedData['eventVenuesAddress'];
$entraceFee = $decodedData['eventFee'];
$latitude = $decodedData['latitude'];
$longitude = $decodedData['longitude'];
$phone = $decodedData['organizerPhone'];
$redirectLink = $decodedData['redirectUrl'];
$venue = "_";

//check wether the record is in the database or not

$checkEvent = "SELECT * from events WHERE event_name = '$eventName' && start_date = '$startDate'";
$executeSQL = mysqli_query($conn,$checkEvent);
$checkEventRow = mysqli_num_rows($executeSQL);

if($checkEventRow != 0){
  $message = "You have already added!";
}
else {

  //if there is no event with the same name and date insert the event to the database
$addEvent = "INSERT INTO events(event_status, userId, event_image, event_name, event_description, start_date, start_time, end_date, end_time, category,event_organizer, event_venue, event_address,address_latitude, address_longitude, contact_phone, redirectUrl,event_entrance_fee )
 VALUES ('$status','$userId','$featuredImage', '$eventName', '$evenDescription','$startDate', '$startTime','$endDate','$endTime', '$categories','$organizer', '$venue', '$address','$latitude', '$longitude', '$phone', '$redirectLink', '$entraceFee')";

 $commit = mysqli_query($conn, $addEvent);

 if($commit){
   $message = "successfully Added";
 }
 else {
   $message = "Not added try again later!";
 }
}
 $response[] = array("message" => $message);
 echo json_encode($response);
 ?>

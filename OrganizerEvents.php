<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userId = $decodedData['userId'];
$status = 1;
$todayEvent = "SELECT * FROM events WHERE userId = '$userId' AND event_status = '$status' ORDER BY start_date DESC";
//commit select action on the database
 $commit = mysqli_query($conn, $todayEvent);
 //check if there is a column with same record
 $checkRow = mysqli_num_rows($commit);

 if($checkRow > 0){
   while($FeatchedEvents[] = mysqli_fetch_assoc($commit)){
    $message = "succeed";
    $event = $FeatchedEvents;
}
 }
 else {
     $message = "no event";
     $event = null;
 }
//we count the number of event user published

// response is sent to app in array format

 $response[] = array("message" => $message,"Events"=> $event);
    echo json_encode($response);
    mysqli_close($conn);
 ?>

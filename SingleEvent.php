<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

 $eventId = $decodedData['eventId'];
// $eventId = 90;
$Event = "SELECT * FROM events WHERE event_id = '$eventId' LIMIT 1";
//commit select action on the database
 $commit = mysqli_query($conn, $Event);
 //check if there is a column with same record
 $checkRow = mysqli_num_rows($commit);

 if($checkRow > 0){
   while($FeatchedEvents = mysqli_fetch_assoc($commit)){
    $message = "succeed";
    $SingleEvent = $FeatchedEvents;

      $startTime = substr($FeatchedEvents["start_time"], 0, 5);

      $EndTime = substr($FeatchedEvents["end_time"], 0,5);
}
 }
 else {
     $message = "no event";
     $SingleEvent = null;
     $startTime = null;
       $EndTime = null;
 }
//we count the number of event user published
 $response[] = array("message" => $message,"event"=> $SingleEvent, "StartTime"=> $startTime, "EndTime"=>$EndTime);
    echo json_encode($response);
   mysqli_close($conn);
 ?>

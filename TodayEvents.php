<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$today = date("Y-m-d");
$status = 1;
$todayEvent = "SELECT * FROM events WHERE start_date <= '$today' and  end_date >= '$today'  and event_status = '$status';";
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

// response is sent to app in array format

 $response[] = array("message" => $message,"Events"=> $event);
    echo json_encode($response);
    mysqli_close($conn);
 ?>

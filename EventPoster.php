<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

$eventId = $decodedData['eventId'];
$status = 0;
$SelectQuery = "SELECT event_image FROM events WHERE event_id='$eventId'";
$CommitQuery = mysqli_query($conn, $SelectQuery);
$row = mysqli_num_rows($CommitQuery);

if($row > 0){
  while($featchPoster[] = mysqli_fetch_assoc($CommitQuery)){
    $message ="succeed";
    $Poster = $featchPoster;
  }
}
else {
  $message = "no poster";
    $Poster = null;
}

$response[]= array("message"=> $message,"poster"=>$Poster);

echo json_encode($response);
mysqli_close($conn);
 ?>

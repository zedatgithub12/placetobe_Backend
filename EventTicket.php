<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

$eventId = $decodedData['eventId'];
$status = 1;
$today = date("Y-m-d");

$SQLQuery = "SELECT * FROM tickets WHERE event_id= '$eventId' AND status ='$status' AND expiredate >= '$today'";
$CommitQuery = mysqli_query($conn, $SQLQuery);
$row = mysqli_num_rows($CommitQuery);

if($row >0){
  while($featchTickets[] = mysqli_fetch_assoc($CommitQuery)){
      $Tickets = $featchTickets;

      $message = "succeed";
  }
}
else {
  $Tickets = null;
  $message = "no tickets";
}

$response[] = array("message" => $message,"tickets"=> $Tickets);
   echo json_encode($response);
   mysqli_close($conn);

?>

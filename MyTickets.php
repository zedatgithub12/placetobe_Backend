<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

$id = $decodedData['id'];
$status = 0;
$SelectQuery = "SELECT * FROM tickets WHERE userId='$id'  ORDER BY id DESC";
$CommitQuery = mysqli_query($conn, $SelectQuery);
$row = mysqli_num_rows($CommitQuery);

if($row > 0){
  while($fetchTicket[] = mysqli_fetch_assoc($CommitQuery)){
    $message ="succeed";
    $myTickets = $fetchTicket;
  }
}
else {
  $message = "no ticket";
    $myTickets = null;
}

$response[]= array("message"=> $message,"Tickets"=>$myTickets);

echo json_encode($response);

 ?>

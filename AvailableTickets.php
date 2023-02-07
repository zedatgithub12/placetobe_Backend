<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

$status = 1;
$SelectQuery = "SELECT * FROM tickets WHERE status='$status' && currentamount > '1' ORDER BY id DESC";
$CommitQuery = mysqli_query($conn, $SelectQuery);
$row = mysqli_num_rows($CommitQuery);

if($row > 0){
  while($fetchTicket[] = mysqli_fetch_assoc($CommitQuery)){
    $message ="succeed";
    $Tickets = $fetchTicket;
  }
}
else {
  $message = "no ticket";
    $Tickets = null;
}

$response[]= array("message"=> $message,"tickets"=>$Tickets);

echo json_encode($response);

 ?>

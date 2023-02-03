<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

$id = $decodedData['userId'];
$status = 0;
$SelectQuery = "SELECT * FROM soldtickets WHERE userId='$id'  ORDER BY id DESC";
$CommitQuery = mysqli_query($conn, $SelectQuery);
$row = mysqli_num_rows($CommitQuery);

if($row > 0){
  while($fetchTicket[] = mysqli_fetch_assoc($CommitQuery)){
    $message ="succeed";
    $ticket = $fetchTicket;
  }
}
else {
  $message = "no ticket";
    $ticket = null;
}

$response[]= array("message"=> $message,"ticket"=>$ticket);

echo json_encode($response);

 ?>

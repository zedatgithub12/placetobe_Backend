<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userId= $decodedData['userId'];
$EventId = $decodedData['eventId'];
$EventName = $decodedData['eventName'];
$EventImage = $decodedData['eventImage'];
$TicketType = $decodedData['type'];
$TicketPrice = $decodedData['price'];
$OrgionalPrice = $decodedData['price'];
$TicketAmount = $decodedData['Amount'];
$AddedAmount = $decodedData['Amount'];
$AddedDate = $today = date("Y-m-d");
$ExpireDate = $decodedData['expireDate'];
$status = 0;

$SqlQuery = "SELECT * FROM tickets WHERE event_id = '$EventId' and TicketType = '$TicketType'";
$CommitQuery = mysqli_query($conn, $SqlQuery);

$row = mysqli_num_rows($CommitQuery);

if($row > 0){
   $message = "exist";
}
else {
  $InsertQuery = "INSERT INTO tickets (userId, event_id,event_name,event_image,tickettype,currentprice,origionalprice,currentamount, origionalamount, addeddate,expiredate,status)
  VALUES ('$userId','$EventId','$EventName','$EventImage','$TicketType', '$TicketPrice','$OrgionalPrice','$TicketAmount','$AddedAmount','$AddedDate','$ExpireDate','$status')";
  $CommitInsertQuery = mysqli_query($conn, $InsertQuery);

  if($CommitInsertQuery){
    $message = "succeed";
  }
  else {
        $message = "cannot add";
  }
}
$response[] = array("message" => $message);
echo json_encode($response);
 ?>

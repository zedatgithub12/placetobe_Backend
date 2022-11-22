<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);


$ticketId = $decodedData['ticketId'];
$userId = $decodedData['userId'];
$TicketPrice = $decodedData['price'];
$ExpireDate = $decodedData['expireDate'];
$status = $decodedData['tstatus'];

$SqlQuery = "UPDATE tickets SET currentprice = '$TicketPrice', expiredate = '$ExpireDate', status = '$status'
 WHERE id = '$ticketId' and userId = '$userId'";
$CommitQuery = mysqli_query($conn, $SqlQuery);

if($CommitQuery){
   $message = "succeed";
}
else {
$message = "not updated";
}
$response[] = array("message" => $message);
echo json_encode($response);
 ?>

<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$ticketId = $decodedData['id'];
$numberOfTicket = $decodedData['quantity'];
$timer = $decodedData['timer'];
$rsvpId = $decodedData['rsvp'];
$userId = $decodedData['user'];
$AddedDate = $today = date("Y-m-d");

// $ticketId = "39";
// $numberOfTicket = 2;
// $timer = "initial";
// $rsvpId = "2";
// $userId = "98";
// $AddedDate = $today = date("Y-m-d");
// when the payment is made the code the status column of the reservation table will be changed from 0 to 1
//0 represent the payment is processing
//1 represent the payment is settled
//2 represent the payment process is halt of the time is elapsed

if($timer === "paymentDone"){
  //return the ticket to the tickets table
    $updatersv = "UPDATE reservations SET status = '1' WHERE ticketId = '$rsvpId' && userId = '$userId' limit 1";
    $commitAborted = mysqli_query($conn, $updatersv);

    if($commitAborted){
      $returnTicket = "UPDATE tickets SET currentamount = currentamount +'$numberOfTicket' WHERE id = '$ticketId'";
      $returnCommit = mysqli_query($conn, $returnTicket);
    }
}

// the block of code below check if the checkout time elapsed and the payment is not done
// and return the reserved ticket to database

else if($timer === "elapsed"){
  //return the ticket to the tickets table
    // $updatersv = "UPDATE reservations SET status = '2' WHERE ticketId = '$rsvpId' && userId = '$userId' limit 1";
    // $commitAborted = mysqli_query($conn, $updatersv);
    //
    // if($commitAborted){
      $returnTicket = "UPDATE tickets SET currentamount = currentamount +'$numberOfTicket' WHERE id = '$ticketId'";
      $returnCommit = mysqli_query($conn, $returnTicket);
      $message = "elapsed";
    //}
}

else {
$SQL = "SELECT * FROM tickets WHERE id='$ticketId' limit 1";
$commit = mysqli_query($conn,$SQL);
$row = mysqli_num_rows($commit);

//check if the row existed
if($row > 0){
//featch associated array of the ticket information
 while($ticket = mysqli_fetch_assoc($commit)){

  if($ticket["currentamount"] < $numberOfTicket && $ticket["currentamount"] >0){// check if the amount of ticket is non zero
  $message = "less quantity found";
}
//check ticket current amount is greater than issued amount and greater than zero
 else if($ticket["currentamount"] > 0 && $ticket["currentamount"] > $numberOfTicket && $timer === "initial"){

 $Reserve ="INSERT INTO reservations(userId,ticketId,quantity,addedDate) VALUES ('$userId','$ticketId','$numberOfTicket','$AddedDate')";
 $commitReserve = mysqli_query($conn, $Reserve);
 //
 if($commitReserve){
     $alterTicket = "UPDATE tickets SET currentamount = currentamount-'$numberOfTicket' WHERE id = '$ticketId'";
     $commitAlter = mysqli_query($conn, $alterTicket);
     if($commitAlter){
       $message = "start timer";
     }
 }

}
}
}
else {
  $message = "checkout Issue";
}
}


$response[] = array("message"=>$message);
echo json_encode($response);
mysqli_close($conn);
?>

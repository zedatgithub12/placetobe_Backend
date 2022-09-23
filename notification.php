<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userID = $decodedData['userId'];

$Subscription = "SELECT followed_id FROM follow WHERE follower_id = '$userID'";
$commitRequest = mysqli_query($conn, $Subscription);
$checkRow = mysqli_num_rows($commitRequest);

if($checkRow > 0){
   while ($organizers = mysqli_fetch_assoc($commitRequest)) {

     $organizer = $organizers;
    $ArrToString = implode( "||",$organizer);
     //echo $ArrToString;

    //select event which is posted by organizers user is following
    $status = 1;
    $OrganizersEvent = "SELECT * FROM events WHERE userId = '$ArrToString' && event_status='$status' ORDER BY start_date DESC";
    $commitNotice = mysqli_query($conn, $OrganizersEvent);
    $Row = mysqli_num_rows($commitNotice);

    if($Row > 0){
      while ($eventNotice[] = mysqli_fetch_assoc($commitNotice)) {
        $EventNotification = $eventNotice;
        $message = "succeed";
      }
    }
    else {
      $message = "There is no event yet";
              $EventNotification = null;
    }
   }
}
else {
  $message = "follow organizers";
$EventNotification = null;
}

$response[] = array("message" => $message,"Notification"=> $EventNotification );
   echo json_encode($response);
   mysqli_close($conn);
 ?>

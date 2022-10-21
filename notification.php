<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);


    //select event which is posted by organizers user is following
    $today = date("Y-m-d");
    $status = 1;
    $OrganizersEvent = "SELECT * FROM events WHERE event_status='$status' ORDER BY addedDate DESC";
    $commitNotice = mysqli_query($conn, $OrganizersEvent);
    $Row = mysqli_num_rows($commitNotice);

    if($Row > 0){
      while ($eventNotice[] = mysqli_fetch_assoc($commitNotice)) {

          // echo json_encode($eventNotice);
        $EventNotification = $eventNotice;
        $message = "succeed";
      }
    }
    else {
      $message = "There is no event yet";
              $EventNotification = null;
    }


$response[]= array("message" => $message,"Notification"=> $EventNotification);
echo json_encode($response);
   mysqli_close($conn);
 ?>

<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

//$eventId = '90';
$eventId= $decodedData['eventId'];
$followerId = $decodedData['followerId'];
//$followerId = '98';

$User = "SELECT userId FROM events WHERE event_id = '$eventId' limit 1";
$commitUser = mysqli_query($conn, $User);
$UserRow = mysqli_num_rows($commitUser);

if($UserRow >0){
   //echo $commitUser;
  while($featchUser = mysqli_fetch_assoc($commitUser)){

    $userId = $featchUser["userId"];

    $UserDetail = "SELECT * FROM users WHERE userId = '$userId' limit 1";
    $commitUserDetail = mysqli_query($conn, $UserDetail);
    $row = mysqli_num_rows($commitUserDetail);

    if($row > 0){
      while($fetchOrganizer = mysqli_fetch_assoc($commitUserDetail)){
       $profile = $fetchOrganizer;
       $message = "succeed";
       $organizerId = $fetchOrganizer["userId"];
     }
    }
    else {
       $profile=null;
      $message = "error finding organizer";
    }
  }
}
else {
  $profile=null;
 $message = "error finding organizer";
}

$following = "SELECT * from follow WHERE follower_id = '$followerId' && followed_id = '$organizerId'";
$commitCheck = mysqli_query($conn, $following);
$checkRow = mysqli_num_rows($commitCheck);
//check if the user is already following the followed user
if($checkRow > 0){
  $follow = "Following";
}
else {
    $follow = "Follow";
}

$response[] = array("message" => $message, "profile" =>$profile, "follow" => $follow);
echo json_encode($response);
  mysqli_close($conn);
?>

<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

//$userId = 98;
$userId = $decodedData['userId'];
$followerSQL = "SELECT follower_id FROM follow WHERE followed_id = '$userId' ORDER BY follow_id DESC";
$followerQuery= mysqli_query($conn, $followerSQL);
$followerRow = mysqli_num_rows($followerQuery);

if($followerRow>0){
  while($followerArray = mysqli_fetch_assoc($followerQuery)){

        $followers = implode("&&",$followerArray);
    //echo json_encode($followers);
  $featchCommand = "SELECT * FROM users WHERE userId= '$followers'";
  $featchQuery = mysqli_query($conn, $featchCommand);
  $featchedRow = mysqli_num_rows($featchQuery);

  if($featchedRow > 0){
     $FollowersArray[] = mysqli_fetch_assoc($featchQuery);
     $TotalFollowers  = $FollowersArray;
     $message = "succeed";
  }
else {
  $TotalFollowers  = null;
  $message = "not featched";
}
}
}
else {
  $TotalFollowers  = null;
  $message = "no follower yet";
}

$response[] = array("message"=>$message, "followers"=>$TotalFollowers);
echo json_encode($response);
mysqli_close($conn);


 ?>

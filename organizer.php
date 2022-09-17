<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

//$userIdentity = '67';
$organizerId= $decodedData['userId'];
$followerId = $decodedData['followerId'];

$Query = "SELECT * FROM users WHERE userId = '$organizerId';";
$commit = mysqli_query($conn, $Query);
$checkRow = mysqli_num_rows($commit);

if($checkRow >0){
 while($fetchOrganizer = mysqli_fetch_array($commit)){
   $profile = $fetchOrganizer['profile'];
   $username = $fetchOrganizer['username'];
   $category = $fetchOrganizer['category'];

   $message = "succeed";
 }

}
else {
   $profile=null;
      $username=null;
         $category=null;
  $message = "error finding organizer";
}
//fetching organizer information end here and after now
// we check wether user is following organizer or not


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

$response[] = array("message" => $message, "profile" =>$profile, "username"=>$username, "category" =>$category, "follow" => $follow);
echo json_encode($response);
  mysqli_close($conn);
?>

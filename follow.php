<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$followerId =$decodedData['followerId'];
$organizerId = $decodedData['organizerId'];

$follow_user = "SELECT * from follow WHERE follower_id = '$followerId' && followed_id = '$organizerId'";
$commitCheck = mysqli_query($conn, $follow_user);
$checkRow = mysqli_num_rows($commitCheck);
//check if the user is already following the followed user
if($checkRow > 0){
  $message = "Following";

$unfollow = "DELETE FROM follow WHERE follower_id = '$followerId' AND followed_id = '$organizerId'";
$commitUnfollowing = mysqli_query($conn, $unfollow);

if($commitUnfollowing){
  $message = "Follow";
}
else {
    $message = "Following";
}

}
else{
$Query = "INSERT INTO follow(follower_id,followed_id) VALUES ('$followerId','$organizerId')";
$commitFollowing = mysqli_query($conn, $Query);
if($commitFollowing){
  $message = "Following";
}
else {
    $message = "Follow";
}
}




$response[] = array("message" => $message);
echo json_encode($response);
 ?>

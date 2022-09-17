<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userID = $decodedData['id'];

$eventSQL = "SELECT COUNT(*) FROM events WHERE userId = '$userID'";
$submitQuery = mysqli_query($conn, $eventSQL );
$checkRow = mysqli_num_rows($submitQuery);

if($checkRow > 0){
$userEvent = mysqli_fetch_assoc($submitQuery);
$message = "succeed";
$events = implode( "",$userEvent);

}
else {
  $message="no event";
  $events = null;
}
//retrive number of followers user have in the database
$followerSQL = "SELECT COUNT(follower_id) FROM follow WHERE followed_id = '$userID'";
$followerQuery= mysqli_query($conn, $followerSQL);
$followerRow = mysqli_num_rows($followerQuery);

if($followerRow>0){
$followerArray = mysqli_fetch_assoc($followerQuery);
    $followers = implode( "",$followerArray);

}
else {
      $follower = null;
}
//retrive number of organizer user following

$organizer = "SELECT COUNT(followed_id)FROM follow WHERE follower_id = '$userID'";
$organizerQuery = mysqli_query($conn, $organizer);
$organizerRow = mysqli_num_rows($organizerQuery);

if($organizerRow > 0){
    $organizerArray = mysqli_fetch_assoc($organizerQuery);
    $following = implode( "",$organizerArray);
}
else {
  $following = null;
}
$response[] = array("message"=>$message, "events"=>$events, "followers"=>$followers, "following"=>$following);
    echo json_encode($response);
mysqli_close($conn);
 ?>

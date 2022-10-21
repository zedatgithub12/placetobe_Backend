<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userID = $decodedData['organizerId'];

$orgFollowers = "SELECT COUNT(follower_id)FROM follow WHERE followed_id = '$userID'";
$submitQuery = mysqli_query($conn, $orgFollowers );
$checkRow = mysqli_num_rows($submitQuery);

if($checkRow > 0){
$FCount = mysqli_fetch_assoc($submitQuery);
$message = "succeed";
$followers = implode( "",$FCount);

}
else {
  $message="no follower";
  $followers = null;
}
$response[] = array("message"=>$message, "followers"=>$followers);
    echo json_encode($response);
mysqli_close($conn);
?>

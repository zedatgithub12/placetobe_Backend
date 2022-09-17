<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userId = $decodedData['userId'];

$Followers = "SELECT COUNT(follower_id) FROM follow WHERE followed_id = '$userId'";
$commitCount  = mysqli_query($conn, $followers);


 ?>

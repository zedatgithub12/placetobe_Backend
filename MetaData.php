<?php
include 'connection.php';

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userId = $decodedData['userId'];
$selectQuery = "SELECT * FROM users WHERE userId='$userId'";
$commitSelect = mysqli_query($conn, $selectQuery);
$row = mysqli_num_rows($commitSelect);
if($row >0){
   while($user[] = mysqli_fetch_assoc($commitSelect)){
     $userInfo = $user;
     $message= "succeed";
   }
 }
   else {
     $message = "failed";
     $userInfo = null;
   }
   $response[] = array("message"=>$message, "user"=> $userInfo);
   echo json_encode($response);
 ?>

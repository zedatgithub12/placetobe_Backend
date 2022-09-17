<?php
include 'connection.php';

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userId = $decodedData['userId'];
$firstName = $decodedData['firstName'];
$middleName = $decodedData['middleName'];
$lastName = $decodedData['lastName'];
$birthDate = $decodedData['birthDate'];
$gender = $decodedData['gender'];
$username = $decodedData['username'];
$category = $decodedData['category'];
$phone = $decodedData['Phone'];

$selectQuery = "SELECT * FROM users WHERE userId='$userId'";
$commitSelect = mysqli_query($conn, $selectQuery);
$row = mysqli_num_rows($commitSelect);
if($row >0){

  $updateCommand = "UPDATE users SET first_name = '$firstName', middle_name='$middleName', last_name='$lastName',
  username = '$username', gender='$gender', birthDate='$birthDate', category='$category', phone='$phone' WHERE  userId = $userId";
   $commitUpdate = mysqli_query($conn, $updateCommand);
   if($commitUpdate){
     $message = "successfully updated";
   }
   else {
     $message = "Couldn't Update retry!";
   }


 }
   else {
     $message = "retry Update";

   }
   $response[] = array("message"=>$message);
   echo json_encode($response);
 ?>

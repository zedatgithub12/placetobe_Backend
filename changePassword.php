<?php
include 'connection.php';

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userId = $decodedData['userId'];
$oldPassword = md5($decodedData['oldPassword']);
$newPassword = md5($decodedData['newPassword']);

// First select user password from database
$CheckUser = "SELECT password FROM users WHERE password = '$oldPassword' AND userId = '$userId' limit 1";
$commitSelect = mysqli_query($conn, $CheckUser);
$row = mysqli_num_rows($commitSelect);

if($row >0){
  // if there is a record with an id of userid and passwor === oldpassword we directly goes to updating user information

  $ChangePassword = "UPDATE users SET password='$newPassword' WHERE userId ='$userId'";
  $CommitChange = mysqli_query($conn, $ChangePassword);

  if($CommitChange){
    $message = "Password Updated";
  }
  else {
    $message = "Error Occured Retry Later";
  }
}
else {
    $message = "Old Password Doesn't Match";
}

// we send response to a requesting server
$response[] = array("message"=> $message);
echo  json_encode($response);

 ?>

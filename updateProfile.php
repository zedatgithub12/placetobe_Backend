<?php
include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userId = $decodedData['userIdentity'];
$profileName = $decodedData['profileName'];

$UpdateProfile = "UPDATE users SET profile = '$profileName' WHERE userId='$userId'";
$commitChange = mysqli_query($conn,$UpdateProfile);

if($commitChange){
$message = "Updated";
}
else {
  $message = "not updated!";
}
$response[] = array("message" => $message);
echo json_encode($response);
 ?>

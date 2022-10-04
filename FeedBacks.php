<?php
include('connection.php');

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$name = $decodedData['name'];
$emailAddress = $decodedData['email'];
$phone = $decodedData['phone'];
$feedback = $decodedData['feedback'];
if(!empty($name || $emailAddress || $feedback)){

$sqlQuery = "INSERT INTO feedback(name, email, phone, comment) VALUES ('$name','$emailAddress', '$phone', '$feedback')";
$commit = mysqli_query($conn, $sqlQuery);

if($commit){
  $message = "succeed";
}
else {
  $message = "not sent";
}
}
else {
    $message = "not sent";
}
$response[] = array("message"=>$message);
echo json_encode($response);

mysqli_close($conn);
 ?>

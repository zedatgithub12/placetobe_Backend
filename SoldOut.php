<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);

$id= $decodedData['id'];

$soldout = 3;
$SQLQuery = "UPDATE tickets SET status = '$soldout' WHERE id='$id' LIMIT 1";
$CommitQuery= mysqli_query($conn, $SQLQuery);

if($CommitQuery){
  $message = "succeed";

}
else {
    $message = "not updated";

}

$response[] = array("message"=>$message);
echo json_encode($response);
 ?>

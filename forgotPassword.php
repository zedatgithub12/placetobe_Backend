<?php
include('connection.php');

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$inputs = $decodedData['email'];

$SQL = "SELECT * FROM users WHERE email = '$inputs' || username = '$inputs' limit 1";
$commitSQL = mysqli_query($conn, $SQL);
$checkRow = mysqli_num_rows($commitSQL);
if($checkRow >0){
 $message = "succeed";

}
else {
  $message = "Entry match isn't found";
}

$response[]=array("message"=>$message);
echo json_encode($response);
 ?>

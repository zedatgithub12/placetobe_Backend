<?php
include 'connection.php';


$sqlQuery = "SELECT version FROM app_info";

$commitsqlQuery = mysqli_query($conn, $sqlQuery);
$row = mysqli_num_rows($commitsqlQuery);

if($row >0){
  while($featchedInfo = mysqli_fetch_assoc($commitsqlQuery)){
    $message = "succeed";
    $version = $featchedInfo;
  }
}
else {
      $message = "not featched";
  $version=null;
}

$response[] = array("message"=> $message, "version"=>$version);
echo json_encode($response);
mysqli_close($conn);

 ?>

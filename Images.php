<?php
include 'connection.php';

$status = 1;
$sqlQuery = "SELECT image FROM featured_events WHERE status= '$status'";
$commitSql = mysqli_query($conn, $sqlQuery);
$row = mysqli_num_rows($commitSql);

if($row >0){
  while($featchImages[] = mysqli_fetch_assoc($commitSql)){
  $images = $featchImages;
  $message = "succeed";
}
}
else {
  $images = null;
  $message = "there no image";
}

$response[] = array("message"=> $message, "images"=>$images);
echo json_encode($response);
mysqli_close($conn);
 ?>

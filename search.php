<?php

include 'connection.php';

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$searchQuery = $decodedData['searchInput'];
$status = 1;
$today = date("Y-m-d");
$searchedEvent = "SELECT * FROM events WHERE event_name LIKE '$searchQuery%' && end_date >= '$today' && event_status = '$status' ORDER BY start_date DESC";
//commit select action on the database
 $commit = mysqli_query($conn, $searchedEvent );
 //check if there is a column with same record
 $checkRow = mysqli_num_rows($commit);

 if($checkRow > 0){
   while($serchResult[] = mysqli_fetch_assoc($commit)){
    $message = "succeed";
    $Search = $serchResult;
}
 }
 else {
     $message = "no event";
     $Search = null;
 }
// response is sent to app in array formaber
 $response[] = array("message" => $message,"Filtered"=> $Search );
    echo json_encode($response);
    mysqli_close($conn);
?>

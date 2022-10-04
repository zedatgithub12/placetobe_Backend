<?php
include('connection.php');

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$googleId = $decodedData['id'];
$userEmail = $decodedData['email'];


$SQL = "SELECT * FROM  users WHERE email='$userEmail' AND google_Id ='$googleId' limit 1";

$login = mysqli_query($conn,$SQL);
$verify = mysqli_num_rows($login);

if($verify != 0){
    while($featcheduser[] = mysqli_fetch_assoc($login)){
       $message = "succeed";
       $user = $featcheduser;
  }
}
    else {
        $message = "There is problem signIn with Google";
         $user= null;
    }

    $response[] = array("message" => $message,"user" =>$user);

    echo json_encode($response);
    mysqli_close($conn);
?>

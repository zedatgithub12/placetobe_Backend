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
  $googleId = $decodedData['id'];
  $userEmail = $decodedData['email'];
  $userName = $decodedData['name'];
  $kidName =$decodedData['kidName'];
  $fatherName = $decodedData['fatherName'];
  $category = $decodedData['category'];
  $token = $decodedData['token'];
  $profile = "maleProfile.jpg";

  $insertQuery = "INSERT INTO users( email, username,profile, google_Id, first_name, middle_name, category, authentication_key) VALUES('$userEmail','$userName','$profile','$googleId','$kidName','$fatherName', '$category', '$token')";

  $commit = mysqli_query($conn, $insertQuery);

  if($commit){
        $record = "SELECT * from users WHERE email = '$userEmail'";
        $fetchRecord = mysqli_query($conn, $record);

        while($registeredUser[] = mysqli_fetch_assoc($fetchRecord)){
          $message = "successfully Registered";
         $user = $registeredUser;
     }

}
}
/*
    else {
        $message = "There is problem signIn with Google";
         $user= null;
    }
*/
    $response[] = array("message" => $message,"user" =>$user);

    echo json_encode($response);
    mysqli_close($conn);
?>

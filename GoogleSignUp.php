<?php

include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$email = $decodedData['email'];
$userName = $decodedData['name'];
$googleId= $decodedData['id'];
$kidName =$decodedData['kidName'];
$fatherName = $decodedData['fatherName'];
$category = $decodedData['category'];
$token = $decodedData['token'];
$profile = "maleProfile.jpg";


$SQL = "SELECT * from users WHERE email = '$email'";

$execSQL = mysqli_query($conn, $SQL);
$checkMail = mysqli_num_rows($execSQL);

if($checkMail != 0){
    $message = "The email address is already registered";
  }
else {
    $insertQuery = "INSERT INTO users( email, username,profile, google_Id, first_name, middle_name, category, authentication_key) VALUES('$email','$userName','$profile','$googleId','$kidName','$fatherName', '$category', '$token')";

    $commit = mysqli_query($conn, $insertQuery);

    if($commit){
          $record = "SELECT * from users WHERE email = '$email'";
          $fetchRecord = mysqli_query($conn, $record);

          while($registeredUser[] = mysqli_fetch_assoc($fetchRecord)){
            $message = "successfully Registered";
           $user = $registeredUser;
       }

    }
    else {
        $message = "you cannot register now. Please try again later";
    }

}
$response[] = array("message" => $message, "user"=> $user);

    echo json_encode($response);
?>

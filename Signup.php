<?php

include 'connection.php';
$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$email = $decodedData['Email'];
$userName = $decodedData['User'];
$password = md5($decodedData['passwords']);
$category = $decodedData['category'];
$token = $decodedData['token'];

$SQL = "SELECT * from users WHERE email = '$email'";

$execSQL = mysqli_query($conn, $SQL);
$checkMail = mysqli_num_rows($execSQL);

if($checkMail != 0){
    $message = "The email address is already registered";
  }
else {
    $insertQuery = "INSERT INTO users( email, username, password,category, authentication_key) VALUES('$email','$userName','$password', '$category', '$token')";

    $commit = mysqli_query($conn, $insertQuery);

    if($commit){

        $message = "successfully Registered";
    }
    else {
        $message = "you cannot register now. Please try again later";
    }

}
$response[] = array("message" => $message);

    echo json_encode($response);
?>

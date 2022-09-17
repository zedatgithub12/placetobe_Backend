<?php
include('connection.php');

$encodedData = file_get_contents('php://input');
$decodedData = json_decode($encodedData, true);

$userEmail = $decodedData['Email'];
$userPassword = md5($decodedData['password']);

$SQL = "SELECT * FROM  users WHERE email='$userEmail'";

$login = mysqli_query($conn,$SQL);
$verify = mysqli_num_rows($login);

if($verify != 0){

    $featcheduser = mysqli_fetch_array($login);

if($featcheduser['email'] == $userEmail && $featcheduser['password'] == $userPassword )
{
 $message = "succeed";
 $userId = $featcheduser['userId'];
  $email = $featcheduser['email'];
 $firstName = $featcheduser['first_name'];
  $middleName = $featcheduser['middle_name'];
   $lastName = $featcheduser['last_name'];
    $username = $featcheduser['username'];
     $gender = $featcheduser['gender'];
      $profile = $featcheduser['profile'];
       $category = $featcheduser['category'];
        $phone = $featcheduser['phone'];
         $userToken = $featcheduser['authentication_key'];
          $status = $featcheduser['status'];
}
    else if($featcheduser['email'] != $userEmail){
      $message = "email error";
    }
    else if($featcheduser['password'] != $userPassword ){

        $message = "Password your entered doesn't match";
    }
}
    else {
        $message = "There is no such account";
    }

    $response[] = array("message" => $message,"userId" =>$userId, "email" => $email, "First_Name" => $firstName,
     "Middle_Name" => $middleName, "lastName" => $lastName, "username" => $username, "gender"=>$gender, "profile" => $profile, "category" => $category, "phone" => $phone, "userToken" => $userToken, "status" => $status);

    echo json_encode($response);

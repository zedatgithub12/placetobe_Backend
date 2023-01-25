<?php
include "connection.php";
$encodedData = file_get_contents("php://input");
$decodedData = json_decode($encodedData, true);




?>

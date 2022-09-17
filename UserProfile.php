<?php

  if(!empty($_FILES['profile']['name']))
  {

    $target_dir = "assets/";
    if (!file_exists($target_dir))
    {
      mkdir($target_dir, 0755);
    }
    $target_file =
      $target_dir .basename($_FILES['profile']['name']);
    $imageFileType =
      strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if file already exists
    if (file_exists($target_file)) {
         $message = "The file already exist";
      die();
    }

    if (
      move_uploaded_file(
        $_FILES['profile']['tmp_name'], $target_file))
        {
          //when user update a profile we save the picture inside asset folder and save image name in the database
      
      $message = "successfully uploaded!";
    }
  }

  else {
    $message = "Sorry, there was an error uploading your file.";
    }

  $response[] = array("message" => $message);
  echo json_encode($response);

?>

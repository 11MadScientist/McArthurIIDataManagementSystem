<?php

session_start();
include('../autoloader.inc.php');

if(isset($_POST['img-submit']))
{
  // if accessed through url alteration, go back to login form
  // if($_SESSION['user_id']==null)
  // {
  //   header("Location: login.php");
  //   exit();
  // }


  $file = $_FILES['img-profile'];
  $filename = $_FILES['img-profile']['name'];
  $fileTmpName = $_FILES['img-profile']['tmp_name'];
  $fileSize = $_FILES['img-profile']['size'];
  $fileError = $_FILES['img-profile']['error'];
  $fileType = $_FILES['img-profile']['type'];

  $fileExt = explode('.', $filename);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');

  if(in_array($fileActualExt, $allowed))
  {
    if($fileError === 0)
    {
      if($fileSize < 1002400)
      {

        $imgData =addslashes(file_get_contents($_FILES['img-profile']['tmp_name']));
  	    $imageProperties = getimageSize($_FILES['img-profile']['tmp_name']);
        $obj = new ProfilePic();
        $confid = $obj->pic_upload($_SESSION['user_id'], $imageProperties, $imgData);

       header("Location: ../EditProfile.php?success");

        exit();
      }
      else
      {
        echo $fileSize;
         echo "file is bigger than 1mb";
      }
    }
    else
    {
      echo "there was an error in uploading the file";
    }
  }
  else
  {
    echo "invalid filetype";
  }

}


elseif(isset($_POST['currentpass-submit']))
{
  $currpass = $_POST['currpass'];
  $userObj = new User();
  $user = $userObj->idChecker($_SESSION['user_id']);

  $passcheck = password_verify($currpass, $user['pass_word']);

  if($passcheck == false)
  {
    header("Location: ../EditProfile.php?error=incorrectPassword");
    exit();
  }
  elseif($passcheck == true)
  {
    $_SESSION['passcheck'] = "success";
    header("Location: ../EditProfile.php?success=passwordCorrect");
    exit();
  }

}

elseif(isset($_POST['changepass-submit']))
{
  $newpass = $_POST['newpass'];
  $confpass = $_POST['confpass'];

  if($newpass !== $confpass)
  {
    header("Location: ../EditProfile.php?error=passwordMismatch");
    exit();
  }
  elseif($newpass === $confpass)
  {
    $hashedpass = password_hash($newpass, PASSWORD_DEFAULT);
    $obj = new User();
    $obj->changePass($_SESSION['user_id'], $hashedpass);
    unset($_SESSION['passcheck']);
    header("Location: ../EditProfile.php?success=passwordChangedSuccessfully");
    exit();
  }

  $userObj = new User();
  $user = $userObj->idChecker($_SESSION['user_id']);

  $passcheck = password_verify($currpass, $user['pass_word']);

  if($passcheck == false)
  {
    echo $currpass;
    header("Location: ../EditProfile.php?error=incorrectPassword");
    exit();
  }
  elseif($passcheck == true)
  {
    $_SESSION['passcheck'] = "success";
    header("Location: ../EditProfile.php?success=passwordCorrect");
    exit();
  }

}


elseif(isset($_POST['cancelpass-submit']))
{
  unset($_SESSION['passcheck']);
  header("Location: ../EditProfile.php");
  exit();

}

elseif(isset($_POST['submit']))
{
  echo "hello world";
}

elseif(isset($_POST['formpass-submit']))
{


}

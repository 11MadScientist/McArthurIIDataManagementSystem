<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['currentpass-submit']))
{
  $currpass = $_POST['currpass'];
  $userObj = new User();
  $user = $userObj->idChecker($_SESSION['user_id']);

  $passcheck = password_verify($currpass, $user['pass_word']);

  if($passcheck == false)
  {
    header("Location: ../changePass.php?error=incorrectPassword");
    exit();
  }
  elseif($passcheck == true)
  {
    $_SESSION['passcheck'] = "success";
    header("Location: ../changePass.php?success=passwordCorrect");
    exit();
  }

}

elseif(isset($_POST['changepass-submit']))
{
  $newpass = $_POST['newpass'];
  $confpass = $_POST['confpass'];

  if($newpass !== $confpass)
  {
    header("Location: ../changePass.php?error=passwordMismatch");
    exit();
  }
  elseif($newpass === $confpass)
  {
    $hashedpass = password_hash($newpass, PASSWORD_DEFAULT);
    $obj = new User();
    $obj->changePass($_SESSION['user_id'], $hashedpass);
    unset($_SESSION['passcheck']);
    header("Location: ../changePass.php?success=passwordChangedSuccessfully");
    exit();
  }

  $userObj = new User();
  $user = $userObj->idChecker($_SESSION['user_id']);

  $passcheck = password_verify($currpass, $user['pass_word']);

  if($passcheck == false)
  {
    echo $currpass;
    header("Location: ../changePass.php?error=incorrectPassword");
    exit();
  }
  elseif($passcheck == true)
  {
    $_SESSION['passcheck'] = "success";
    header("Location: ../changePass.php?success=passwordCorrect");
    exit();
  }

}


elseif(isset($_POST['cancelpass-submit']))
{
  unset($_SESSION['passcheck']);
  header("Location: ../changePass.php");
  exit();

}

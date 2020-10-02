<?php

if(isset($_POST['login-user']))
{
  $email = $_POST['email'];
  $pass = $_POST['pass'];


  echo $email;
  echo $pass;



  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {

    header("Location: ../login.php?error=invalidEmail");
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {

    header("Location: ../login.php?error=incorrectPassword&");
    exit();
  }

  else
  {

  }
  header("Location: ../dashboard.php");
  exit();


}
else
{
  header("Location: ../login.php");
  exit();
}

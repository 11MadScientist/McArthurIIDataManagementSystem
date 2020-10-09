<?php
include('../autoloader.inc.php');

if(isset($_POST['submit-next']))
{
  $fname =  $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $level = $_POST['level'];
  $confpass = $_POST['confpass'];

  if($_POST['level'] === null)
  {
    header("Location: ../register.php?error=nullposition&fname=".$fname."&lname".$lname."&email=".$email);
    exit();
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z]*$/", $fname) && !preg_match("/^[a-zA-Z]*$/", $lname))
  {
    header("Location: ../register.php?error=invalidemailfirstnamelastname");
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    header("Location: ../register.php?error=invalidemail&fname=".$fname."&lname".$lname);
    exit();
  }
  else if(!preg_match("/^[a-zA-Z]*$/", $fname))
  {
    header("Location: ../register.php?error=invalidfirstname&lname".$lname."&email=".$email);
    exit();
  }
  else if(!preg_match("/^[a-zA-Z]*$/",$lname))
  {
    header("Location: ../register.php?error=invalidlastname&fname=".$fname."&email=".$email);
    exit();
  }
  else if($pass !== $confpass)
  {
    header("Location: ../register.php?error=passwordmissmatch&fname=".$fname."&lname".$lname."&email=".$email);
    exit();
  }
  else
  {
    $obj = new User();
    $same =$obj->emailChecker($email);

    if($same != null)
    {
      header("Location: ../register.php?error=emailtaken&fname=".$fname."&lname".$lname);
      exit();
    }
  }

  $hashedpass = password_hash($pass, PASSWORD_DEFAULT);
  $obj = new User();
  $obj->setUserInfo($hashedpass, $lname, $fname, $level, $email);

  $id =$obj->emailChecker($email);
  session_start();
  $_SESSION['user_id'] = $id['user_id'];


  header("Location: ../register2.php?fullyoperational");
  exit();


}
else
{
  header("Location: ../login.php");
  exit();
}

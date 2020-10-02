<?php
if(isset($_POST['submit-registry']))
{
  $fname =  $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $confpass = $_POST['confpass'];

  echo $fname;
  echo $lname;
  echo $email;
  echo $pass;
  echo $confpass;


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

  header("Location: ../login.php?success=signedupsuccessfully");
  exit();


}
else
{
  header("Location: ../login.php");
  exit();
}

<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['req-delete']))
{
  if(!isset($_POST['request']))
  {
    header("Location: ../Requests.php?error=empty");
    exit();
  }
  $obj = new User();
  foreach($_POST['request'] as $id)
  {
    $obj->deleteUser($id);
  }
  header("Location: ../Personnel.php?success=deletedSuccessfully");
  exit();

}

else
{
  header("Location: ../logout.form.php");
  exit();
}

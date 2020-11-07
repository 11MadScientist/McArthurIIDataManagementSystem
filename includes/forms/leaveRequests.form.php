<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['decline-req']))
{
  if(!isset($_POST['request']))
  {
    header("Location: ../Requests.php?error=empty");
    exit();
  }
    $obj = new Leave();
  foreach($_POST['request'] as $id)
  {
    $obj->deleteLeave($id);
  }
  header("Location: ../LeaveRequests.php?success=deletedSuccessfully");
  exit();

}

if(isset($_POST['accpt-req']))
{
  if(!isset($_POST['request']))
  {
    header("Location: ../Requests.php?error=empty");
    exit();
  }
  foreach($_POST['request'] as $id)
  {

    $obj = new Leave();
    $obj->acceptLeave($id);


  }
  header("Location: ../LeaveRequests.php?success=accptSuccessfully");
  exit();


}
else
{
  header("Location: ../logout.form.php");
  exit();
}

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
    $obj = new Training();
  foreach($_POST['request'] as $id)
  {
    $obj->deleteTraining($id);
  }
  header("Location: ../trainingRequests.php");
  exit();

}

if(isset($_POST['accpt-req']))
{
  if(!isset($_POST['request']))
  {
    header("Location: ../trainingRequests.php");
    exit();
  }
  foreach($_POST['request'] as $id)
  {
    $obj = new Training();
    $obj->acceptTraining($id);
  }
  header("Location: ../trainingRequests.php");
  exit();


}
else
{
  header("Location: ../logout.form.php");
  exit();
}

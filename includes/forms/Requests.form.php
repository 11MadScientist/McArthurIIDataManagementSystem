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
  foreach($_POST['request'] as $id)
  {

    $obj = new User();
    $obj->deleteReq($id);
    header("Location: ../Requests.php?success=deletedSuccessfully");
    exit();
  }




}

if(isset($_POST['accpt-req']))
{
  if(!isset($_POST['request']))
  {
    header("Location: ../Requests.php?error=empty");
    exit();
  }
  $obj = new User();
  foreach($_POST['request'] as $id)
  {
    $obj->setStatus($id);
  }
  header("Location: ../Requests.php?success=accptSuccessfully");
  exit();




}

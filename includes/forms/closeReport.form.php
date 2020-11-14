<?php
session_start();
include('../autoloader.inc.php');

if(isset($_GET['status']) and isset($_GET['id']))
{
  $obj = new Reports();

  if($_GET['status'] == 'Open')
  {
    $obj->closeReport($_GET['id']);
  }
  elseif($_GET['status'] == 'Close')
  {
    $obj->openReport($_GET['id']);
  }
  else
  {
      header("Location: logout.form.php?success=ModifiedSuccessfully");
  }

  if(isset($_GET['dead']))
  {
    header("Location: ../metDeadline.php?success=ModifiedSuccessfully");
    exit();
  }
    header("Location: ../reportFiles.php?success=ModifiedSuccessfully");
}
else
{
    header("Location: logout.form.php?success=ModifiedSuccessfully");
}

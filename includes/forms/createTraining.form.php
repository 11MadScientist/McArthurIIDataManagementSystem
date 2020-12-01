<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['req-submit']))
{
  $date = $_POST['start_date'];
  $dm_number = $_POST['dm_number'];
  $year = $_POST['year'];

  if(strlen($dm_number) > 4)
  {
    header("Location: ../emergencyEvents.php?error=Invalid_dm
    &training_date=".$date."&year=".$year);
    exit();
  }

  $trainObj = new Training();
  $trainObj->createTraining($_SESSION['user_id'], $date, $dm_number, $year);

  header("Location: ../emergencyEvents.php?success=Trainingsubmitted");
  exit();
}

else
{
  header("Location: ../logout.form.php");
  exit();
}

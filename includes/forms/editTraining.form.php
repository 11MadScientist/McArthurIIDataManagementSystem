<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['req-submit']))
{
  $date = $_POST['start_date'];
  $dm_number = $_POST['dm_number'];
  $year = $_POST['year'];
  $id = $_POST['id'];
  echo $id;

  if(strlen($dm_number) > 4)
  {
    header("Location: ../emergencyEvents.php?error=Invalid_dm
    &training_date=".$date."&year=".$year);
    exit();
  }

  $trainObj = new Training();
  $trainObj->editTraining($id, $date, $dm_number, $year);

  header("Location: ../emergencyEvents.php?success=Trainingsubmitted");
  exit();
}

elseif(isset($_POST['delete']))
{
  $id = $_POST['id'];
  $trainObj = new Training();
  $trainObj->deleteTraining($id);

  header("Location: ../emergencyEvents.php?success=Trainingdeleted");
  exit();
}

else
{
  header("Location: ../logout.form.php");
  exit();
}

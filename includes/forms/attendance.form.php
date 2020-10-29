<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['timein_amsubmit']))
{
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d");
  $time = date("h:i:sa");
  $status = $_POST['status'];

  if(date("H:i:s") > date("H:i:s", strtotime("08:00:00am")))
  {
    $status = "Late";
  }
  echo $date;
  echo $_SESSION['user_id'];
  echo $time;
  $obj = new Attendance();
  $obj->submitTimeAm($_SESSION['user_id'],$date, $time, $status);

  header("Location: ../attendance.php?success&time=".$time."&status=".$status);
}

elseif(isset($_POST['timeout_amsubmit']))
{
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d");
  $time = date("h:i:sa");
  $status = $_POST['status'];


  $obj = new Attendance();
  $obj->submitTimeOutAm($_SESSION['user_id'],$date, $time);

  header("Location: ../attendance.php?success&time=".$time."&status=".$status);
}

elseif(isset($_POST['timein_pmsubmit']))
{
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d");
  $time = date("h:i:sa");
  $status = $_POST['status'];

  if(date("H:i:s") > date("H:i:s", strtotime("01:00:00pm")))
  {
    $status = "Late";
  }


  $obj = new Attendance();
  $obj->submitTimeInPm($_SESSION['user_id'],$date, $time, $status);

  header("Location: ../attendance.php?success&time=".$time."&status=".$status);
}

elseif(isset($_POST['timeout_pmsubmit']))
{
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d");
  $time = date("h:i:sa");
  $status = $_POST['status'];


  $obj = new Attendance();
  $obj->submitTimeOutPm($_SESSION['user_id'],$date, $time);

  header("Location: ../attendance.php?success&time=".$time."&status=".$status);
}

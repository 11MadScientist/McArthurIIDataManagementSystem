<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['submitAttn']))
{
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d");
  $time = date("h:i:sa");
  $status = $_POST['status'];
  $obj = new Attendance();
  $obj->submitAttn($_SESSION['user_id'],$date, $time, $status);

  header("Location: ../attendance.php?success&time=".$time."&status=".$status);



}
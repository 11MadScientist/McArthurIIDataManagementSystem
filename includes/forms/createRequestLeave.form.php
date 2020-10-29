<?php
  session_start();
  include('../autoloader.inc.php');


  if(isset($_POST['req-submit']))
  {
    $leaveType = $_POST['leaveType'];
    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
    $end_date = date('Y-m-d', strtotime($_POST['end_date']));

    if($start_date > $end_date)
    {
      header("Location: ../RequestLeave.php?error=invalidDateTime&leaveType=".$leaveType);
      exit();
    }

    $obj = new Leave();
    $obj->submitLeave($_SESSION['user_id'],$leaveType, $start_date, $end_date);

    header("Location: ../RequestLeave.php?success=RequestSubmitted");
    exit();



}
 else
 {
     header("Location: ../forms/logout.form.php");
     exit();
 }

?>

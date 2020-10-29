<?php
  session_start();
  include('../autoloader.inc.php');

if(isset($_POST['delete']))
{
  echo "string";
  $obj = new Leave();
  $obj->deleteLeave($_POST['id']);

  header("Location: ../LeaveRequestList.php");
  exit();
}

  if(isset($_POST['req-submit']))
  {
    $id = $_POST['id'];
    $leaveType = $_POST['leaveType'];
    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
    $end_date = date('Y-m-d', strtotime($_POST['end_date']));

    if($start_date > $end_date)
    {
      header("Location: ../RequestLeave.php?error=invalidDateTime&id=".$id."&leaveType=".$leaveType);
      exit();
    }

    $obj = new Leave();
    $obj->editLeave($id,$_SESSION['user_id'],$leaveType, $start_date, $end_date);

    header("Location: ../RequestLeave.php?success=RequestSubmitted&id=".$id);
    exit();



}
 else
 {
     // header("Location: ../forms/logout.form.php");
     // exit();
 }

?>

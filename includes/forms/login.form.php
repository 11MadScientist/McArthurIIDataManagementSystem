<?php
include('../autoloader.inc.php');

if(isset($_POST['login-user']))
{
  $email = $_POST['email'];
  $pass = $_POST['pass'];


  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    header("Location: ../login.php?error=invalidEmail");
    exit();
  }

  else
  {
    $userObj = new User();
    $user = $userObj->emailChecker($email);

    if($user == null)
    {
      header("Location: ../login.php?error=nosuchemail");
      exit();
    }
    elseif($user['status'] == null)
    {
      header("Location: ../login.php?error=notActivated&email=".$email);
      exit();
    }
    else
    {
      $passcheck = password_verify($pass, $user['pass_word']);

      if($passcheck == false)
      {
        header("Location: ../login.php?error=incorrectPassword&email=".$email);
        exit();
      }
      elseif($passcheck == true)
      {
          session_start();
          $_SESSION['user_id'] = $user['user_id'];
          $_SESSION['user_fname'] = $user['f_name'];
          $_SESSION['user_mname'] = $user['m_name'];
          $_SESSION['user_lname'] = $user['l_name'];
          $_SESSION['user_email'] = $user['email'];
          $_SESSION['designation'] = $user['designation'];
          $_SESSION['status'] = $user['status'];
          $_SESSION['day'] = date('Y-m-d',strtotime('today'));

          $obj = new AddInfo();
          $res = $obj->getStation($_SESSION['user_id']);
          $_SESSION['station'] = $res['station'];

          $objNotif = new Notifications();
          // CHECKS IF NOTIFICATION TABLE IS EMPTY
          // $rowCount = mysqli_num_rows($objNotif->notifChecker());
          if($objNotif->isNotifTableEmpty()){
              $objUser = new User();
              $objAnn = new Announcement();
              $objReport = new Reports();
              $objEvent = new Events();
              $resultUser = $objUser->getAllUserId();
              foreach($resultUser as $user)
              {
                  // INSERTING ANNOUNCEMENTS DATA
                  $resultAnn = $objAnn->getAllAnn();
                  foreach($resultAnn as $ann)
                  {
                      $objNotif->insertNotif($user['user_id'], 'announcement', $ann['id'], 'unread', $ann['date_created']);
                  }
                  // INSERTING EVENTS DATA
                  $resultEvent = $objEvent->getEventsAll();
                  foreach($resultEvent as $event)
                  {
                      $objNotif->insertNotif($user['user_id'], 'event', $event['id'], 'unread', $event['created']);
                  }
                  // INSERTING REPORTS DATA
                  $resultReport = $objReport->getAllReports();
                  foreach($resultReport as $rep)
                  {
                      $objNotif->insertNotif($user['user_id'], 'report', $rep['report_id'], 'unread', $rep['date_created']);
                  }
              }
          }
          header("Location: ../dashboard.php?success");
          exit();
      }
      else
      {
        header("Location: ../login.php?error=incorrectPassword&email =".$email);
        exit();
      }
    }
  }



}
else
{
  header("Location: ../login.php");
  exit();
}

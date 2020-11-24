<?php
  session_start();
  include('../autoloader.inc.php');
  date_default_timezone_set('Asia/Manila');

  if(isset($_POST['event-submit']))
  {

    $end_date = date('Y-m-d H:i:s', strtotime($_POST['end_date'].$_POST['end_time']));
    $title = $_POST['title'];
    $description = $_POST['description'];

    $obj = new Reports();
    $duplicate = $obj->checkTitle($title);

    if($duplicate?? null !== null)
    {
        header("Location: ../createReport.php?error=duplicateTitle&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
        "&description=".$description."&event-img=".$_FILES['event-img']);
        exit();
    }

    if(date('Y-m-d H:i:s') > $end_date)
    {
      header("Location: ../createReport.php?error=invalidDateTime&title=".$title.
      "&description=".$description."&event-img=".$_FILES['event-img']);
      exit();
    }


    $obj->createReports($_SESSION['user_id'],$title, $description, $end_date);
    $confid = $obj->getId($title);

    // LOOP FOR GETTING ALL THE USERS REGISTERED EXCEPT THE ADMINISTRATOR
    $objNotif = new Notifications();
    $objUser = new User();
    $resultUser = $objUser->getAllUserId();
    while($rowUser = mysqli_fetch_array($resultUser))
    {
      // INSERTING EVENTS DATA INTO NOTIFICATIONS TABLE
      $result = $obj->getAllReports();
      while($row = mysqli_fetch_array($result))
      {
        if($row['report_id'] == $confid['report_id'])
          $objNotif->insertNotif($rowUser['user_id'], 'report', $row['report_id'], 'unread', $row['date_created']);
      }
    }

//image upload code

    if($_FILES['event-img']['name'] != null)
    {

      $file = $_FILES['event-img'];
      $filename = $_FILES['event-img']['name'];
      $fileTmpName = $_FILES['event-img']['tmp_name'];
      $fileSize = $_FILES['event-img']['size'];
      $fileError = $_FILES['event-img']['error'];
      $fileType = $_FILES['event-img']['type'];
      $nm = explode('.', $filename);
      $fileExt = explode('.', $filename);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('docx', 'pdf', 'rtf', 'xlsx', 'xlsm');

      if(in_array($fileActualExt, $allowed))
      {

        if($fileError === 0)
        {

          if($fileSize < 16777215)
          {

            $imgData =addslashes(file_get_contents($_FILES['event-img']['tmp_name']));
            $imageProperties = getimageSize($_FILES['event-img']['tmp_name']);
            $obj = new Reports();
            $obj->insertSample($confid['report_id'], $nm[1], $imgData);

            mkdir('Reports/'.$title);
            header("Location: ../reports-main.php?success=eventCreated");
            exit();

          }
          else
          {
            echo $fileSize;
            header("Location: ../createReport.php?error=fileSizeTooBig&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
            "&description=".$description."&event-img=".$_FILES['event-img']."&title=".$title);
            exit();

          }
        }
        else
        {
          echo "there was an error in uploading the file";
          header("Location: ../createReport.php?error=errorInUploadingFile&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
          "&description=".$description."&title=".$title);
          exit();
        }
      }

      else
      {
        echo "invalid filetype";
      }
    }
    elseif($_FILES['event-img']['name'] == null)
    {
      mkdir('Reports/'.$title);
      header("Location: ../reports-main.php?success=eventCreated");
      exit();
    }

 }
 else
 {
     header("Location: ../forms/logout.form.php");
     exit();
 }

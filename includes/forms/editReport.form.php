<?php
  session_start();
  include('../autoloader.inc.php');
  date_default_timezone_set('Asia/Manila');

  if(isset($_POST['delete-report']))
  {

    $title = $_POST['title'];
    $is = scandir('Reports/'.$title);

    if($is[2]?? null != null)
    {
      header("Location: ../createReport.php?error=folderNotEmpty&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time']."&title=".$title.
      "&description=".$description."&event-img=".$_FILES['event-img']."&id=".$_POST['id']);
      exit();
    }
    else
    {
      $obj = new Reports();
      rmdir('Reports/'.$title);
      $obj->deleteReport($_POST['id']);
      header("Location: ../reports-main.php?success=ReportDeleted");
      exit();
    }

  }


  elseif(isset($_POST['event-submit']))
  {

    $end_date = date('Y-m-d H:i:s', strtotime($_POST['end_date'].$_POST['end_time']));
    $title = $_POST['title'];
    $description = $_POST['description'];


    if(date('Y-m-d H:i:s') > $end_date)
    {
      header("Location: ../createReport.php?error=invalidDateTime&title=".$title.
      "&description=".$description."&event-img=".$_FILES['event-img']."&id=".$_POST['id']);
      exit();
    }

    $obj = new Reports();
    $obj->editReports($_POST['id'],$_SESSION['user_id'],$title, $description, $end_date);
    rename('Reports/'.$_POST['old_title'],'Reports/'.$title);
//image upload code

    if($_FILES['event-img']['name'] != null)
    {

      $file = $_FILES['event-img'];
      $filename = $_FILES['event-img']['name'];
      $fileTmpName = $_FILES['event-img']['tmp_name'];
      $fileSize = $_FILES['event-img']['size'];
      $fileError = $_FILES['event-img']['error'];
      $fileType = $_FILES['event-img']['type'];

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
            $obj->insertSample($_POST['id'], $fileType, $imgData);

            header("Location: ../reports-main.php?success=eventCreated&id=".$confid['id']);
            exit();

          }
          else
          {
            echo $fileSize;
            header("Location: ../createReport.php?error=fileSizeTooBig&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
            "&description=".$description."&event-img=".$_FILES['event-img']."&title=".$title."&id=".$_POST['id']);
            exit();

          }
        }
        else
        {
          echo "there was an error in uploading the file";
          header("Location: ../createReport.php?error=errorInUploadingFile&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
          "&description=".$description."&title=".$title."&id=".$_POST['id']);
          exit();
        }
      }

      else
      {
        echo "invalid filetype";
        header("Location: ../createReport.php?error=invalidTypeofFile&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
        "&description=".$description."&title=".$title."&id=".$_POST['id']);
        exit();
      }
    }
    elseif($_FILES['event-img']['name'] == null)
    {
      header("Location: ../reports-main.php?success=ReportDeleted");
      exit();
    }

 }
 else
 {
     header("Location: ../forms/logout.form.php");
     exit();
 }

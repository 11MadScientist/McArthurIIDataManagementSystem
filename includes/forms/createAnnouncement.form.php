<?php
  session_start();
  include('../autoloader.inc.php');



  if(isset($_POST['ann-submit']))
  {

    $title = $_POST['title'];
    $description = $_POST['description'];

    $obj = new Announcement();
    $duplicate = $obj->checkTitle($title);

    if($duplicate?? null !== null)
    {
        header("Location: ../CreateAnnouncement.php?error=duplicateTitle&description=".$description."&event-img=".$_FILES['event-img']);
        exit();
    }

    $obj = new Announcement();
    $obj->createAnn($_SESSION['user_id'],$title, $description);
    $confid = $obj->getId($title);




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

      $allowed = array('jpg', 'jpeg', 'png');

      if(in_array($fileActualExt, $allowed))
      {

        if($fileError === 0)
        {

          if($fileSize < 16777215)
          {

            $imgData =addslashes(file_get_contents($_FILES['event-img']['tmp_name']));
            $imageProperties = getimageSize($_FILES['event-img']['tmp_name']);
            $confid = $obj->getId($title);
            $obj->insertImg($confid['id'], $imageProperties, $imgData);

            header("Location: ../CreateAnnouncement.php?success=eventCreated&id=".$confid['id']);
            exit();

          }
          else
          {
            echo $fileSize;
            header("Location: ../CreateAnnouncement.php?error=imageSizeTooBig&description=
            ".$description."&event-img=".$_FILES['event-img']."&title=".$title);
            exit();

          }
        }
        else
        {
          echo "there was an error in uploading the file";
          header("Location: ../CreateAnnouncement.php?error=errorInUploadingFile&description=
          ".$description."&event-img=".$_FILES['event-img']."&title=".$title);
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
      header("Location: ../CreateAnnouncement.php?success=announcementCreated&id=".$confid['id']);
      exit();
    }

 }
 else
 {
     header("Location: ../forms/logout.form.php");
     exit();
 }

<?php
  session_start();
  include('../autoloader.inc.php');


  if(isset($_POST['delete-event']))
  {

    $id = $_POST['id'];
    $event = new Announcement();
    $event->delImg($id);
    $event->delAnn($id);
    echo "<script>alert('Event Deleted Successfully')</script>";
    header("Location: ../Announcements.php?success=deletedsuccessfully");
    exit();


  }

  if(isset($_POST['ann-submit']))
  {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $obj = new Announcement();
    $obj->editAnn($id, $_SESSION['user_id'], $title, $description);

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
            $obj = new Announcement();
            $obj->editImg($id, $imageProperties, $imgData);

            header("Location: ../CreateAnnouncement.php?success=announcementEdited&id=".$id);
            exit();

          }
          else
          {
            echo $fileSize;
            header("Location: ../CreateAnnouncement.php?error=imageSizeTooBig&start_date=".$_POST['start_date'].
            "&start_time=".$_POST['start_time']."&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
            "&description=".$description."&event-img=".$_FILES['event-img']."&title=".$title."&id=".$id);
            exit();

          }
        }
        else
        {
          echo "there was an error in uploading the file";
          header("Location: ../CreateAnnouncement.php?error=errorInUploadingFile&start_date=".$_POST['start_date'].
          "&start_time=".$_POST['start_time']."&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
          "&description=".$description."&event-img=".$_FILES['event-img']."&title=".$title."&id=".$id);
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
      header("Location: ../CreateAnnouncement.php?success=announcementEdited&id=".$id);
      exit();
    }


 }
 else
 {
     header("Location: ../forms/logout.form.php");
     exit();
 }

?>

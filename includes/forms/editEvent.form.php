<?php
  session_start();
  include('../autoloader.inc.php');

  if(isset($_POST['event-submit']))
  {
    $id = $_POST['id'];
    $start_date = date('Y-m-d H:i:s', strtotime($_POST['start_date']. $_POST['start_time']));
    $end_date = date('Y-m-d H:i:s', strtotime($_POST['end_date'].$_POST['end_time']));
    $title = $_POST['title'];
    $description = $_POST['description'];

    if($start_date > $end_date)
    {
      header("Location: ../CreateEvent.php?error=invalidDateTime&title=".$title.
      "&description=".$description."&event-img=".$_FILES['event-img']."&id=".$id);
      exit();
    }



    $obj = new Events();
    $obj->editEvent($id,$_SESSION['user_id'],$start_date, $end_date, $title, $description);



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
            $obj = new Events();
            $confid = $obj->getId($title);
            echo $confid['id'];
            $obj->imgUpdate($confid['id'], $imageProperties, $imgData);

            header("Location: ../CreateEvent.php?success=eventEdited&id=".$id);
            exit();

          }
          else
          {
            echo $fileSize;
            header("Location: ../CreateEvent.php?error=imageSizeTooBig&start_date=".$_POST['start_date'].
            "&start_time=".$_POST['start_time']."&end_date=".$_POST['end_date']."&end_time=".$_POST['end_time'].
            "&description=".$description."&event-img=".$_FILES['event-img']."&title=".$title."&id=".$id);
            exit();

          }
        }
        else
        {
          echo "there was an error in uploading the file";
          header("Location: ../CreateEvent.php?error=errorInUploadingFile&start_date=".$_POST['start_date'].
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
      header("Location: ../CreateEvent.php?success=eventEdited&id=".$id);
      exit();
    }


 }

?>

<?php
session_start();
include('../autoloader.inc.php');

if(isset($_POST['img-submit']))
{
  if($_SESSION['user_id']==null)
  {
    header("Location: login.php");
    exit();
  }


  $file = $_FILES['img-profile'];
  $filename = $_FILES['img-profile']['name'];
  $fileTmpName = $_FILES['img-profile']['tmp_name'];
  $fileSize = $_FILES['img-profile']['size'];
  $fileError = $_FILES['img-profile']['error'];
  $fileType = $_FILES['img-profile']['type'];

  $fileExt = explode('.', $filename);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');

  if(in_array($fileActualExt, $allowed))
  {
    if($fileError === 0)
    {
      if($fileSize < 1002400)
      {

        $imgData =addslashes(file_get_contents($_FILES['img-profile']['tmp_name']));
  	    $imageProperties = getimageSize($_FILES['img-profile']['tmp_name']);
        $obj = new ProfilePic();
        $confid = $obj->pic_upload($_SESSION['user_id'], $imageProperties, $imgData);

       header("Location: ../register2.php?success");

        exit();
      }
      else
      {
        echo $fileSize;
         echo "file is bigger than 1mb";
      }
    }
    else
    {
      echo "there was an error in uploading the file";
    }
  }
  else
  {
    echo "invalid filetype";
  }

}

elseif(isset($_POST['submit-registry']))
{
  if($_SESSION['user_id']==null)
  {
    header("Location: login.php");
    exit();
  }

  $designation =  $_POST['desig'];
  $station = $_POST['station'];
  $dateofbirth = $_POST['dateofbirth'];
  $civilstatus = $_POST['civil-stat'];
  $highesteducattn = $_POST['high-educ'];
  $major = $_POST['major'];
  $orig_appointment = $_POST['orig-appointment'];
  $dateofpromo = $_POST['lat-promotion'];
  $contactnum = $_POST['contact-num'];
  $fbacct = $_POST['fb-username'];

  if($_POST['desig'] == null)
  {
    header("Location: ../register2.php?error=nodesignation&station=".$station."&dateofbirth="
    .$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&major=".$major.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct);
    exit();
  }
  if($_POST['civil-stat'] == null)
  {
    header("Location: ../register2.php?error=noCivilStatus&station=".$station."&dateofbirth="
    .$dateofbirth."&desig=".$designation."&highesteducattn=".$highesteducattn."&major=".$major.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct);
    exit();
  }
  elseif(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST['contact-num']))
  {
    header("Location: ../register2.php?error=invalidContactNumber&station=".$station."&dateofbirth="
    .$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&major=".$major.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&desig=".$designation."&fbacct=".$fbacct);
    exit();
  }

  $obj = new AddInfo();

  $obj->setAddInfo($_SESSION['user_id'], $designation, $station, $dateofbirth, $civilstatus, $highesteducattn, $major, $orig_appointment, $dateofpromo, $contactnum, $fbacct);
  header("Location: ../login.php?success=signedupsuccessfully");
  session_unset();
  session_destroy();

  exit();
}

else
{
  header("Location: ../login.php");
  exit();
}

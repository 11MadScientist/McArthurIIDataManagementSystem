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
  $age = $_POST['age'];
  $station = $_POST['station']?? "1";
  $dateofbirth = $_POST['dateofbirth'];
  $civilstatus = $_POST['civil-stat'];
  $highesteducattn = $_POST['high-educ'];
  $specification = $_POST['specification'];
  $orig_appointment = $_POST['orig-appointment'];
  $dateofpromo = $_POST['lat-promotion'];
  $contactnum = $_POST['contact-num'];
  $fbacct = $_POST['fb-username'];

  if($age < 0 or $age >160 or preg_match("/[a-zA-Z]/"))
  {
    header("Location: ../register2.php?error=invalidAge&station=".$station."&dateofbirth="
    .$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct);
    exit();
  }

  if($_POST['civil-stat'] == null)
  {
    header("Location: ../register2.php?error=noCivilStatus&station=".$station."&dateofbirth="
    .$dateofbirth."&age=".$age."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct);
    exit();
  }

  if($station === null or $station == "1")
  {
    header("Location: ../register2.php?error=noSchoolAssigned&civilstatus=".$civilstatus."&dateofbirth="
    .$dateofbirth."&age=".$age."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct);
    exit();
  }
  elseif(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST['contact-num']))
  {
    header("Location: ../register2.php?error=invalidContactNumber&station=".$station."&dateofbirth="
    .$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&age=".$age."&fbacct=".$fbacct);
    exit();
  }

  $obj = new AddInfo();

  $obj->setAddInfo($_SESSION['user_id'], $age, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct);
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

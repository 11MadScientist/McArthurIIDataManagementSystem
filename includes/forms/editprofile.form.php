<?php

session_start();
include('../autoloader.inc.php');


if(isset($_POST['formpass-submit']))
{
// picture going to database
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


  // end of picture code
  $fname =  $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $desig = $_POST['desig'];
  $grade = $_POST['grade'];
  $station = $_POST['station'];
  $dateofbirth = $_POST['dateofbirth'];
  $civilstatus = $_POST['civil-stat'];
  $highesteducattn = $_POST['high-educ'];
  $specification = $_POST['specification'];
  $orig_appointment = $_POST['orig-appointment'];
  $dateofpromo = $_POST['lat-promotion'];
  $contactnum = $_POST['contact-num'];
  $fbacct = $_POST['fb-username'];


  if($_POST['civil-stat'] == null)
  {
    header("Location: ../EditProfile.php?error=noCivilStatus&station=".$station."&dateofbirth="
    .$dateofbirth."&grade=".$grade."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct.
    "&fname=".$fname."&mname=".$mname."&lname=".$lname."&email=".$email."&desig=".$desig);
    exit();
  }
  if($station === null or $station == "1")
  {
    header("Location: ../EditProfile.php?error=noSchoolAssigned&civilstatus=".$civilstatus."&dateofbirth="
    .$dateofbirth."&grade=".$grade."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct.
    "&fname=".$fname."&mname=".$mname."&lname=".$lname."&email=".$email."&desig=".$desig);
    exit();
  }
  elseif(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST['contact-num']))
  {
    header("Location: ../EditProfile.php?error=invalidContactNumber&station=".$station."&dateofbirth="
    .$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&grade=".$grade."&fbacct=".$fbacct.
    "&fname=".$fname."&mname=".$mname."&lname=".$lname."&email=".$email."&desig=".$desig);
     exit();
  }


  if($desig === null or $desig == " ")
  {
    header("Location: ../EditProfile.php?error=nullposition&fname=".$fname."&mname=".$mname."&lname=".$lname."&email=".$email."
    &station=".$station."&dateofbirth=".$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct."&grade=".$grade);
    exit();
  }

  else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    header("Location: ../EditProfile.php?error=invalidemail&fname=".$fname."&mname=".$mname."&lname".$lname."&desig=".$desig.
    "&station=".$station."&dateofbirth=".$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
    "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct."&grade=".$grade);
    exit();
  }
  else if(!preg_match("/^[a-zA-Z\s]*$/", $fname))
  {
    header("Location: ../EditProfile.php?error=invalidfirstname&lname=".$lname."&mname=".$mname."&email=".$email."&desig=".$desig.
           "&station=".$station."&dateofbirth=".$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
           "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct."&grade=".$grade);
           exit();
  }
  else if(!preg_match("/^[a-zA-Z]*$/",$lname))
  {
    header("Location: ../EditProfile.php?error=invalidlastname&fname=".$fname."&mname=".$mname."&email=".$email."&desig=".$desig.
           "&station=".$station."&dateofbirth=".$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
           "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct."&grade=".$grade);
    exit();
  }
  else if(!preg_match("/^[a-zA-Z]*$/",$mname))
  {
    header("Location: ../EditProfile.php?error=invalidmiddlename&fname=".$fname."&lname=".$lname."&email=".$email."&desig=".$desig.
    "&station=".$station."&dateofbirth=".$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
     "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct."&grade=".$grade);
    exit();
  }

  else
  {
    $obj = new User();
    $same =$obj->realEmailChecker($email, $_SESSION['user_id']);

    if($same != null)
    {
      header("Location: ../EditProfile.php?error=emailtaken&fname=".$fname."&mname=".$mname."&lname=".$lname."&desig=".$desig.
      "&station=".$station."&dateofbirth=".$dateofbirth."&civilstatus=".$civilstatus."&highesteducattn=".$highesteducattn."&specification=".$specification.
       "&orig_appointment=".$orig_appointment."&dateofpromo=".$dateofpromo."&contactnum=".$contactnum."&fbacct=".$fbacct."&grade=".$grade);
       exit();
    }
  }
  $obj = new User();
  $obj->updateUserInfo($_SESSION['user_id'],$lname, $mname, $fname, $desig, $email);

  $obj1 = new AddInfo();
  $obj1->updateAddInfo($_SESSION['user_id'], $grade, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct);

  $_SESSION['user_fname'] = $fname;
  $_SESSION['user_mname'] = $mname;
  $_SESSION['user_lname'] = $lname;
  $_SESSION['user_email'] = $email;
  $_SESSION['designation'] = $desig;
  header("Location: ../Profile.php?success=ProfileEditedSuccessfully");
  exit();

}
else {
  session_unset();
  session_destroy();
  header("Location: ../login.php");
  exit();
}

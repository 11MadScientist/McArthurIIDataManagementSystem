<?php
session_start();
include('../autoloader.inc.php');


if(isset($_POST['delete-rep']))
{
  if(!isset($_POST['report_id']))
  {
    header("Location: ../Reports.php?id=".$_POST['report_id']);
    exit();
  }

  $obj = new Reports();
  $rep = $obj->getSpecificReport($_POST['report_id']);
  $res = $obj->getSubmittedReport($_POST['id'], $_POST['report_id']);
  unlink('Reports/'.$rep['report_title'].'/'.$res['file_name'].$res['file_type']);
  $obj->deleteSubmittedReport($_POST['id'], $_POST['report_id']);
  header("Location: ../Reports.php?id=".$_POST['report_id']);
  exit();
}


//       refers to the file array in formData.append()
//                  V
//                  V    refers to the filename uploaded
//                  V       V
//                  V       V
//                  V       V
elseif(isset($_FILES['file']['name']))
{
    //uploading the files in the upload folder which is a new folder created by me
    foreach($_FILES['file']['name'] as $keys => $values)
    {
         // SAVE TO THE UPLOAD FOLDER DIRECTLY       INDEX IN FILE ARRAY
         //
          $obj = new Reports();
          $res = $obj->getSubmittedReport($_POST['id'], $_POST['report_id']);
          unlink('Reports/'.$_POST['filename'].'/'.$res['file_name'].$res['file_type']);

         $nm = explode('.', $values);
         if(move_uploaded_file($_FILES['file']['tmp_name'][$keys], 'Reports/'.$_POST['filename'].'/'.$nm[0].'_'.$_POST['id'].'.'.$nm[1]))
         {

           $obj->submitReport($_POST['id'], $_POST['report_id'], $nm[0].'_'.$_POST['id'], '.'.$nm[1]);
           // echo 'submittedReportsView.php?foldername='.$_POST['filename'].'&filename='.$nm[0].'_'.$_POST['id'].'&filetype='.$nm[1];
           echo 'forms/Reports/'.$_POST['filename'].'/'.$nm[0].'_'.$_POST['id'].'.'.$nm[1];
         }
         else
         {
              echo "File Upload Error";
         }
    }
}

?>

 <?php   
 
 $output = '';  
 if(isset($_FILES['file']['name'][0]))  
 {  
      //uploading the files in the upload folder which is a new folder created by me
      foreach($_FILES['file']['name'] as $keys => $values)  
      {  
           if(move_uploaded_file($_FILES['file']['tmp_name'][$keys], 'upload/' . $values))  
           {  
                $output .= '<div class=col-md-3"><img src="upload/'.$values.'" class="img-responsive" /></div>';  
           }  
      }  
 }  
 echo $output;  
 ?>  

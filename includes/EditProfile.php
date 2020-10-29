<?php
  session_start();
  include('autoloader.inc.php');

  if($_SESSION['user_id'] == null)
  {
    header("Location: ../login.php");
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>McArthurII District Attendance</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/editprofile.css" rel="stylesheet" />
        <script src="js/profileLoader.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>


        </script>
    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div></div>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">

                  <div class="profile-box">

                    <div class="group-box">
                      <div class="group">
                        <div class="text">

                          <form action="forms/editprofile.form.php" method="post" enctype="multipart/form-data">
                            <label class = "pic-lbl" ><u>Upload Profile Picture</u></label>
                             <input onchange="readURL(this);" class = "input" name="img-profile" type="file">


                        </div>

                        <div class="images">
                          <?php
                           $conn = mysqli_connect("localhost", "root", "", "mddb");

                           $obj = new ProfilePic();
                           $result = $obj->get_profile($_SESSION['user_id']);
                              $row = mysqli_fetch_array($result);
                                if($row != null)
                                 {
                           ?>
                                    <img class = "image" src="imageView.php?user_id=<?php echo $row["user_id"]; ?>" id="blah" src="#"/>
                           <?php
                                 }

                                 else
                                 {
                           ?>
                                    <img id="blah" src="#" onerror="this.src='forms/profpic-uploads/unknown.jpg';"  class = "image" src="forms/profpic-uploads/unknown.jpg">
                           <?php
                                 }
                                   mysqli_close($conn);
                            ?>
                        </div>
                      </div>
                    </div>
                    <!-- sql command for the profile picture -->

                     <!-- sql command for the add info -->
                     <?php
                       $obj = new AddInfo();
                       $info = $obj->getAddInfo($_SESSION['user_id']?? '');
                      ?>

                      <!-- horizontal rule -->
                      <div class="horizontal-rule">
                      </div>


                    <!-- name information -->
                   <div class="name">
                     <p class="category"><u> User Information</u></p>
                     <?php if(isset($_GET['error']))
                           {
                             if($_GET['error'] == "invalidemailfirstnamemiddlenamelastname")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Invalid Email Address & Name must not contain any number/symbols!</p>';
                             }
                             elseif($_GET['error'] == "invalidfirstname")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>First Name must not contain any numbers and symbols!</p>';
                             }
                             elseif($_GET['error'] == "invalidmiddlename")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Middle Name must not contain any numbers and symbols!</p>';
                             }
                             elseif($_GET['error'] == "invalidlastname")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Last Name must not contain any numbers and symbols!</p>';
                             }

                           }

                     ?>
                     <ul>

                       <div class="name-content">
                         <i class = "fas fa-user"></i>
                         <label for="inputLastName">Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                         <?php
                             if(isset($_GET['lname']))
                             {
                               echo '<input value = "'.$_GET['lname'].'" class="text-box" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required />';
                             }
                             else
                             {
                               if(isset($_SESSION['user_lname']))
                               {
                                   echo '<input value = "'.$_SESSION['user_lname'].'" class="text-box" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required />';
                               }
                               else
                               {
                                   echo '<input class="text-box" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required />';
                               }
                             }
                          ?>
                       </div>

                       <div class="name-content">
                         <i class="fas fa-chalkboard-teacher"></i>
                         <label for="inputFirstName">First Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                         <!--firstname-->
                         <?php
                             if(isset($_GET['fname']))
                             {
                                echo '<input value = "'.$_GET['fname'].'" class="text-box" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />';
                             }
                             else
                             {
                               if(isset($_SESSION['user_fname']))
                               {
                                   echo '<input value = "'.$_SESSION['user_fname'].'" class="text-box" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />';
                               }
                               else
                               {
                                   echo '<input class="text-box" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />';
                               }
                             }
                          ?>
                       </div>

                       <div class="name-content">
                         <i class = "fas fa-heart"></i>
                         <label class="small mb-1" for="inputMiddleName">Middle Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                         <!--middle name-->
                         <?php
                             if(isset($_GET['mname']))
                             {
                               echo '<input value = "'.$_GET['mname'].'" class="text-box" name = "mname" id="inputMiddleName" type="text" placeholder="Enter middle name" required/>';
                             }
                             else
                             {
                               if(isset($_SESSION['user_mname']))
                               {
                                   echo '<input value = "'.$_SESSION['user_mname'].'" class="text-box" name = "mname" id="inputMiddleName" type="text" placeholder="Enter middle name" required/>';
                               }
                               else
                               {
                                   echo '<input class="text-box" name = "mname" id="inputMiddleName" type="text" placeholder="Enter Middle name" required/>';
                               }
                             }
                          ?>

                       </div>


                      <div class="name-content">
                        <i class = "fas fa-clock"></i>
                           <label for="grade">Grade/Subject:</label>
                           <!--his specification subject-->
                           <?php
                              if(isset($_GET['grade']))
                              {
                                echo '<input class="text-box" value = "'.$_GET['grade'].'" name = "grade" id="grade" type="text" placeholder="Enter Grade/Subject" required/>';
                              }
                              else
                              {
                                if($info['grade']?? null != null)
                                {
                                  echo '<input class="text-box" value = "'.$info['grade'].'" name = "grade" id="grade" type="text" placeholder="Enter Grade/Subject" required/>';
                                }
                                else
                                {
                                    echo '<input class="text-box" name = "grade" id="grade" type="text" placeholder="Enter Grade/Subject" required/>';
                                }
                              }

                            ?>


                      </div>


                     </ul>
                   </div>


                   <!-- horizontal rule -->
                   <div class="horizontal-rule">
                   </div>
                   <!-- contact information -->
                   <div class="contact">
                     <p class="category"><u>Contact Information</u></p>
                     <?php if(isset($_GET['error']))
                           {
                             if($_GET['error'] == "invalidemail")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Invalid Email Address!</p>';
                             }
                             elseif($_GET['error'] == "emailtaken")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Email is already taken!</p>';
                             }
                             elseif($_GET['error'] == "invalidContactNumber")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Please follow number format 0##-####-####!</p>';
                             }
                           }

                     ?>
                     <ul>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class = "fas fa-address-book"></i>
                           <label class="small mb-1" for="contactnum">Contact Number:&nbsp;&nbsp; </label>
                           <?php
                               if(isset($_GET['contactnum']))
                               {
                                 echo '<input onkeypress = "numSyntax()" value = "'.$_GET['contactnum'].'" class="text-box" type="tel" name = "contact-num" id="contactnum" placeholder="use format: 0##-####-####" required/>';
                               }
                               else
                               {
                                 if($info['contact_num']?? null != null)
                                 {
                                     echo '<input onkeypress = "numSyntax()" value = "'.$info['contact_num'].'" class="text-box" type="tel" name = "contact-num" id="contactnum" placeholder="use format: 0##-####-####" required/>';
                                 }
                                 else
                                 {
                                     echo '<input onkeypress = "numSyntax()" type="tel" class="text-box" name = "contact-num" id="contactnum" placeholder="use format: 0##-####-####" required/>';
                                 }
                               }
                            ?>
                            <script type="text/javascript">
                              function numSyntax()
                              {
                                var x = document.getElementById("contactnum").value;
                                if(x.length == 3 || x.length == 8)
                                {
                                  document.getElementById("contactnum").value = x+"-";
                                }
                                else if(x.length == 13)
                                {
                                  document.getElementById("contactnum").value = x.slice(0, -1);
                                  alert("Too much numbers!");
                                }
                                else if(x.length > 14)
                                {
                                  document.getElementById("contactnum").value = 0;
                                  alert("Too much numbers!");
                                }

                              }
                            </script>
                         </div>
                       </div>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class = "fab fa-facebook-f"></i>
                           <label for="inputConfirmPassword">FB UserName: &nbsp;&nbsp;&nbsp;</label>
                           <!--fb username-->
                           <?php
                                if(isset($_GET['fbacct']))
                                {
                                  echo '<input value = "'.$_GET['fbacct'].'" type="text" class="text-box" name = "fb-username" id="inputConfirmPassword"  placeholder="Enter FB UserName" required/>';
                                }
                                else
                                {
                                  if($info['fb_acct']?? null != null)
                                  {
                                      echo '<input value = "'.$info['fb_acct'].'" type="text" class="text-box" name = "fb-username" id="inputConfirmPassword"  placeholder="Enter FB UserName" required/>';
                                  }
                                  else
                                  {
                                      echo '<input type="text" class="text-box" name = "fb-username" id="inputConfirmPassword"  placeholder="Enter FB UserName" required/>';
                                  }
                                }

                            ?>

                         </div>
                       </div>

                       <div class="divider-block">
                         <div class="contact-content">
                           <i class="fas fa-envelope"></i>
                           <label for="inputEmailAddress">Email Address:&nbsp;</label>
                           <!--email address-->
                           <?php
                              if(isset($_GET['email']))
                              {
                                echo '<input value = "'.$_GET['email'].'" class="text-box" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>';
                              }
                              else
                              {
                                if($_SESSION['user_email']?? null != null)
                                {
                                    echo '<input value = "'.$_SESSION['user_email'].'" class="text-box" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>';
                                }
                                else
                                {
                                    echo '<input class="text-box" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>';
                                }
                              }

                            ?>
                         </div>
                       </div>
                     </ul>
                   </div>

                   <!-- horizontal rule -->
                   <div class="horizontal-rule">
                   </div>

                   <!-- individual information -->
                   <div class="contact">
                     <p class="category"><u>Individual Information</u></p>
                     <?php if(isset($_GET['error']))
                           {
                             if($_GET['error'] == "nodesignation")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Please choose a position!</p>';
                             }
                             elseif($_GET['error'] == "noCivilStatus")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Please choose Civil Status!</p>';
                             }
                             elseif($_GET['error'] == "noSchoolAssigned")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Choose a School!</p>';
                             }
                           }

                     ?>
                     <ul>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class = "fas fa-address-book"></i>
                           <label for="inputLastName">Specification:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                           <!--his Specification subject-->
                           <?php
                            if(isset($_GET['specification']))
                            {
                              echo '<input value = "'.$_GET['specification'].'" class="text-box"name = "specification" id="inputLastName" type="text" placeholder="Enter Specification" required/>';
                            }
                            else
                            {
                              if($info['specification']?? null != null)
                              {
                                  echo '<input value = "'.$info['specification'].'" class="text-box"name = "specification" id="inputLastName" type="text" placeholder="Enter Specification" required/>';
                              }
                              else
                              {
                                  echo '<input class="text-box" name = "specification" id="inputLastName" type="text" placeholder="Enter Specification" required/>';
                              }
                            }

                            ?>
                         </div>

                           <div class="contact-content">
                             <i class = "fas fa-cog"></i>
                             <div class="demo">
                                 <label for="position" >Designation:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                 <div class="dropdown-container">
                                   <?php
                                      if(isset($_GET['desig']))
                                      {
                                        echo '<select name = "desig" id = "position" required>
                                          <option hidden value="Supervisor">Supervisor</option>
                                          <option value="Teacher I">Teacher I</option>
                                          <option value="Teacher II">Teacher II</option>
                                          <option value="Teacher III">Teacher III</option>
                                          <option value="Master Teacher I">Master Teacher I</option>
                                          <option value="Master Teacher II">Master Teacher II</option>
                                          <option value="Master Teacher III">Master Teacher III</option>
                                          <option value="Head Teacher I">Head Teacher I</option>
                                          <option value="Head Teacher II">Head Teacher II</option>
                                          <option value="Head Teacher III">Head Teacher III</option>
                                          <option value="Principal I">Principal I</option>
                                          <option value="Principal II">Principal II</option>
                                          </select>
                                          <script>
                                          function myFunction()
                                          {
                                            document.getElementById("position").value = "'.$_GET['desig'].'";
                                          }
                                          myFunction();
                                          </script>';
                                      }
                                      else
                                      {
                                        $userobj = new User();
                                        $userInfo = $userobj->idChecker($_SESSION['user_id']);
                                            if($userInfo['designation']?? null != null)
                                            {
                                                echo '<select name = "desig" id = "position" required>
                                                  <option hidden value="Supervisor">Supervisor</option>
                                                  <option value="Teacher I">Teacher I</option>
                                                  <option value="Teacher II">Teacher II</option>
                                                  <option value="Teacher III">Teacher III</option>
                                                  <option value="Master Teacher I">Master Teacher I</option>
                                                  <option value="Master Teacher II">Master Teacher II</option>
                                                  <option value="Master Teacher III">Master Teacher III</option>
                                                  <option value="Head Teacher I">Head Teacher I</option>
                                                  <option value="Head Teacher II">Head Teacher II</option>
                                                  <option value="Head Teacher III">Head Teacher III</option>
                                                  <option value="Principal I">Principal I</option>
                                                  <option value="Principal II">Principal II</option>
                                                  </select>
                                                  <script>
                                                  function myFunction()
                                                  {
                                                    document.getElementById("position").value = "'.$userInfo['designation'].'";
                                                  }
                                                  myFunction();
                                                  </script>';


                                            }

                                        else
                                        {
                                            echo '<select name = "desig" id = "position" required>
                                              <option disabled hidden>Choose here</option>
                                              <option value="Teacher I">Teacher I</option>
                                              <option value="Teacher II">Teacher II</option>
                                              <option value="Teacher III">Teacher III</option>
                                              <option value="Master Teacher I">Master Teacher I</option>
                                              <option value="Master Teacher II">Master Teacher II</option>
                                              <option value="Master Teacher III">Master Teacher III</option>
                                              <option value="Head Teacher I">Head Teacher I</option>
                                              <option value="Head Teacher II">Head Teacher II</option>
                                              <option value="Head Teacher III">Head Teacher III</option>
                                              <option value="Principal I">Principal I</option>
                                              <option value="Principal II">Principal II</option>
                                              </select>';
                                        }


                                     }
                                    ?>
                                    <div class="select-icon">
                                      <svg focusable="false" viewBox="0 0 104 128" width="25" height="35" class="icon">
                                        <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
                                      </svg>
                                    </div>
                           </div>
                         </div>
                         <div class="divider-inline2">
                           <div class="contact-content">
                             <i class = "fas fa-school"></i>
                             <label for="inputFirstName">School Assigned:</label>
                             <!--name of school user is in-->
                             <div class="dropdown-container">
                               <?php
                                   if(isset($_GET['station']))
                                   {
                                     echo '<select name = "station" id = "station" required>
                                       <option disabled value = "1" hidden>Choose here</option>
                                       <option value="Batug E.S">Batug E.S</option>
                                       <option value="CM Closa E.S">CM Closa E.S</option>
                                       <option value="Danao E.S">Danao E.S</option>
                                       <option value="Kiling E.S">Kiling E.S</option>
                                       <option value="Liwayway E.S">Liwayway E.S</option>
                                       <option value="Maya E.S">Maya E.S</option>
                                       <option value="Oguisan E.S">Oguisan E.S</option>
                                       <option value="Olmedo E.S">Olmedo E.S</option>
                                       <option value="Palale C.S">Palale C.S</option>
                                       <option value="Salvacion E.S">Salvacion E.S</option>
                                       <option value="San Antonio E.S">San Antonio E.S</option>
                                       <option value="San Pedro E.S">San Pedro E.S</option>
                                       <option value="San Vicente E.S">San Vicente E.S</option>
                                       <option value="Tin-awan E.S">Tin-awan E.S</option>
                                       <option value="Villa Imelda E.S">Villa Imelda E.S</option>
                                       </select>
                                       <script>
                                       function myFunction()
                                       {
                                         document.getElementById("station").value = "'.$_GET['station'].'";
                                       }
                                       myFunction();
                                       </script>';

                                   }
                                   else
                                   {
                                     if($info['station']?? "1" != "1")
                                     {

                                         echo '<select name = "station" id = "station" required>
                                           <option disabled value = "1" hidden>Choose here</option>
                                           <option value="Batug E.S">Batug E.S</option>
                                           <option value="CM Closa E.S">CM Closa E.S</option>
                                           <option value="Danao E.S">Danao E.S</option>
                                           <option value="Kiling E.S">Kiling E.S</option>
                                           <option value="Liwayway E.S">Liwayway E.S</option>
                                           <option value="Maya E.S">Maya E.S</option>
                                           <option value="Oguisan E.S">Oguisan E.S</option>
                                           <option value="Olmedo E.S">Olmedo E.S</option>
                                           <option value="Palale C.S">Palale C.S</option>
                                           <option value="Salvacion E.S">Salvacion E.S</option>
                                           <option value="San Antonio E.S">San Antonio E.S</option>
                                           <option value="San Pedro E.S">San Pedro E.S</option>
                                           <option value="San Vicente E.S">San Vicente E.S</option>
                                           <option value="Tin-awan E.S">Tin-awan E.S</option>
                                           <option value="Villa Imelda E.S">Villa Imelda E.S</option>
                                           </select>
                                           <script>
                                           function myFunction()
                                           {
                                             document.getElementById("station").value = "'.$info['station'].'";
                                           }
                                           myFunction();
                                           </script>';


                                     }
                                     else
                                       {
                                         echo '<select name = "station" id = "station" required>
                                           <option disabled  value = "1" hidden>Choose here</option>
                                           <option value="Batug E.S">Batug E.S</option>
                                           <option value="CM Closa E.S">CM Closa E.S</option>
                                           <option value="Danao E.S">Danao E.S</option>
                                           <option value="Kiling E.S">Kiling E.S</option>
                                           <option value="Liwayway E.S">Liwayway E.S</option>
                                           <option value="Maya E.S">Maya E.S</option>
                                           <option value="Oguisan E.S">Oguisan E.S</option>
                                           <option value="Olmedo E.S">Olmedo E.S</option>
                                           <option value="Palale C.S">Palale C.S</option>
                                           <option value="Salvacion E.S">Salvacion E.S</option>
                                           <option value="San Antonio E.S">San Antonio E.S</option>
                                           <option value="San Pedro E.S">San Pedro E.S</option>
                                           <option value="San Vicente E.S">San Vicente E.S</option>
                                           <option value="Tin-awan E.S">Tin-awan E.S</option>
                                           <option value="Villa Imelda E.S">Villa Imelda E.S</option>
                                           </select>
                                           <script>
                                           function myFunction()
                                           {
                                             document.getElementById("station").value = 1;
                                           }
                                           myFunction();
                                           </script>';
                                       }

                                   }
                                ?>
                                <div class="select-icon">
                                  <svg focusable="false" viewBox="0 0 104 128" width="25" height="35" class="icon">
                                    <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
                                  </svg>
                                </div>
                           </div>

                           <div class="contact-content">
                             <i class = "fas fa-rings-wedding"></i>
                             <div class="demo">
                                 <label for="position">Civil Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                 <div class="dropdown-container">
                                   <?php
                                       if(isset($_GET['civilstatus']))
                                       {
                                         echo '<select  name = "civil-stat" id = "civil" required>
                                                 <option disabled hidden>Choose here</option>
                                                 <option value="Single">Single</option>
                                                 <option value="Married">Married</option>
                                               </select>
                                               <script>
                                               function myFunction()
                                               {
                                                 document.getElementById("civil").value = "'.$_GET['civilstatus'].'";
                                               }
                                               myFunction();
                                               </script>
                                               ';
                                       }
                                       else
                                       {
                                         if($info['civil_status']?? null != null)
                                         {
                                             echo '<select  name = "civil-stat" id = "civil" required>
                                                     <option disabled hidden>Choose here</option>
                                                     <option value="Single">Single</option>
                                                     <option value="Married">Married</option>
                                                   </select>
                                                   <script>
                                                   function myFunction()
                                                   {
                                                     document.getElementById("civil").value = "'.$info['civil_status'].'";
                                                   }
                                                   myFunction();
                                                   </script>
                                                   ';
                                         }
                                         else
                                         {
                                           echo '<select name = "civil-stat" required>
                                                   <option selected disabled hidden>Choose here</option>
                                                   <option value="Single">Single</option>
                                                   <option value="Married">Married</option>
                                                 </select>';
                                         }
                                       }
                                    ?>

                                   <div class="select-icon">
                                     <svg focusable="false" viewBox="0 0 104 128" width="25" height="35" class="icon">
                                       <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
                                     </svg>
                                   </div>
                                   </div>
                               </div>
                           </div>
                         </div>

                         <div class="divider-block">
                           <div class="contact-content">
                             <i class="fas fa-graduation-cap"></i>
                             <label class="small mb-1" for="inputLastName">Highest Educational<br> Attainment:</label>
                             <!--his Highest educational attainment-->
                             <?php
                                 if(isset($_GET['highesteducattn']))
                                 {
                                   echo '<input value = "'.$_GET['highesteducattn'].'" class="text-box" name = "high-educ" id="inputLastName" type="text" placeholder="Enter highest attainment" required/>';
                                 }
                                 else
                                 {
                                   if($info['highest_educ_attainment']?? null != null)
                                   {
                                     echo '<input value = "'.$info['highest_educ_attainment'].'" class="text-box" name = "high-educ" id="inputLastName" type="text" placeholder="Enter highest attainment" required/>';
                                   }
                                   else
                                   {
                                       echo '<input class="text-box" name = "high-educ" id="inputLastName" type="text" placeholder="Enter highest attainment" required/>';
                                   }
                                 }
                              ?>
                           </div>
                       </div>

                     </ul>
                   </div>

                   <!-- horizontal rule -->
                   <div class="horizontal-rule">
                   </div>
                   <!-- contact information -->
                   <div class="contact">
                     <p class="category"><u>Dates Information</u></p>
                     <ul>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class = "fas fa-birthday-cake"></i>
                           <label for="inputConfirmPassword">Date of Birth:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                           <!--date of birth-->
                           <?php
                               if(isset($_GET['dateofbirth']))
                               {
                                 echo '<input value = "'.$_GET['dateofbirth'].'" type="date" class="text-box" name = "dateofbirth" id="inputConfirmPassword"  placeholder="Enter date of birth" required/>';
                               }
                               else
                               {
                                 if($info['date_of_birth']?? null != null)
                                 {
                                   echo '<input value = "'.$info['date_of_birth'].'" type="date" class="text-box" name = "dateofbirth" id="inputConfirmPassword"  placeholder="Enter date of birth" required/>';
                                 }
                                 else
                                 {
                                     echo '<input type="date" class="text-box" name = "dateofbirth" id="inputConfirmPassword"  placeholder="Enter date of birth" required/>';
                                 }
                               }
                            ?>
                         </div>
                       </div>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class="fas fa-calendar-alt"></i>
                           <label for="inputConfirmPassword">Date of Latest Promotion:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                           <!--date of latest promotion-->
                           <?php
                               if(isset($_GET['dateofpromo']))
                               {
                                  echo '<input value = "'.$_GET['dateofpromo'].'" type = "date" class="text-box" name = "lat-promotion" id="inputConfirmPassword" required/>';
                               }
                               else
                               {
                                 if($info['date_of_latest_promo']?? null != null)
                                 {
                                     echo '<input value = "'.$info['date_of_latest_promo'].'" type = "date" class="text-box" name = "lat-promotion" id="inputConfirmPassword" required/>';
                                 }
                                 else
                                 {
                                     echo '<input type = "date" class="text-box" name = "lat-promotion" id="inputConfirmPassword" required/>';
                                 }
                               }
                            ?>
                         </div>
                       </div>
                       <div class="divider-block">
                         <div class="contact-content">
                           <i class = "fas fa-calendar"></i>
                           <label for="inputPassword">Date of Original Appointment:</label>
                           <!--date of original appointment-->
                           <?php
                               if(isset($_GET['orig_appointment']))
                               {
                                 echo '<input value = "'.$_GET['orig_appointment'].'" type="date" class="text-box" name = "orig-appointment" id="inputPassword" required/>';
                               }
                               else
                               {
                                 if($info['date_of_orig_appointment']?? null != null)
                                 {
                                   echo '<input value = "'.$info['date_of_orig_appointment'].'" type="date" class="text-box" name = "orig-appointment" id="inputPassword" required/>';
                                 }
                                 else
                                 {
                                     echo '<input type="date" class="text-box" name = "orig-appointment" id="inputPassword" required/>';
                                 }
                               }
                            ?>

                         </div>

                       </div>
                     </ul>
                   </div>


                      <button class = "btn-primary formpassbtn" type="submit" name="formpass-submit">Submit Form</button>
                </div>

                  </form>


              </div>

          </main>
        <?php include('footer.php') ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
    </body>
</html>

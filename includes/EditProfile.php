<?php
  session_start();
  include('autoloader.inc.php');

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
                             <input class = "input" name="img-profile" type="file"  required>
                             <button class = "btn-primary button " type="submit" name="img-submit">UPLOAD IMAGE</button>
                          </form>
                        </div>

                        <div class="images">
                          <?php
                          if($_SESSION['user_id']?? null != null)
                          {
                           $conn = mysqli_connect("localhost", "root", "", "mddb");

                           $obj = new ProfilePic();
                           $result = $obj->get_profile($_SESSION['user_id']);
                            if($result != null)
                            {
                                 while($row = mysqli_fetch_array($result))
                                 {
                           ?>

                                    <img class = "image" src="imageView.php?user_id=<?php echo $row["user_id"]; ?>" />
                           <?php
                                 }
                                  mysqli_close($conn);

                            }
                          }
                            else
                             {
                               ?>

                                   <img class = "profile-pic" src="forms/profpic-uploads/unknown.jpg">
                           <?php
                             }
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

                      <!-- Password change -->
                        <div class="contact">
                          <p class = "category"><u>Change Password</u></p>
                            <?php if(isset($_GET['error']))
                                  {
                                    if(($_GET['error'] == "incorrectPassword"))
                                          echo '<p class="error "><i class = "fas fa-exclamation-triangle"></i>Incorrect Password! </p>';

                                    elseif($_GET['error'] == "passwordMismatch")
                                          echo '<p class="error "><i class = "fas fa-exclamation-triangle"></i>NewPassword ConfirmPassword Mismatch! </p>';
                                  }
                                  elseif(isset($_GET['success']))
                                  {
                                    if($_GET['success'] == "passwordCorrect")
                                    echo '<p class="success" ><i class="fas fa-check"></i>Correct Password!</p>';

                                    elseif($_GET['success'] == "passwordChangedSuccessfully")
                                    echo '<p class="success" ><i class="fas fa-check"></i>Changed Password Successfully!</p>';
                                  }


                            ?>
                          <ul>

                            <div class="name-content">

                              <form action="forms/editprofile.form.php" method="post" id = "currpassform">
                                <i class = "fas fa-user"></i>
                                <label class="small mb-1" for="currentpass">Enter Current Password:</label>
                                <?php
                                        echo '<input class="text-box" name = "currpass" id="currentpass" type="password" placeholder="Enter Current Password" required />';
                                 ?>
                                 <button class = "btn-primary passbtn" type="submit" name="currentpass-submit">OK</button>
                              </form>
                              <?php
                                 if($_SESSION['passcheck']?? '' == "success")
                                 {
                               ?>
                               <script type="text/javascript">
                                   function showBox() {
                                                       var T = document.getElementById("currpassform");
                                                       T.style.display = "none";  // <-- Set it to block
                                                       }
                                   showBox();
                               </script>
                               <?php
                                 }
                                ?>

                            </div>

                            <div class="newpass" id = "newpassbox" style="display: none">
                              <?php
                                 if($_SESSION['passcheck']?? '' == "success")
                                 {
                               ?>
                               <script type="text/javascript">
                                   function showBox() {
                                                       var T = document.getElementById("newpassbox");
                                                       T.style.display = "block";  // <-- Set it to block


                                                       }
                                   showBox();
                               </script>
                               <?php
                                 }
                                ?>
                              <form class="" action="forms/editprofile.form.php" method="post" id = "changepassform">
                                <div class="name-content">
                                  <i class="fas fa-chalkboard-teacher"></i>
                                  <label for="newpass">Enter New Password:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                  <?php
                                          echo '<input class="text-box" name = "newpass" id="newpass" type="password" placeholder="Enter New Password" autofocus required />';
                                   ?>

                                 </div>

                                <div class="name-content">
                                  <i class = "fas fa-heart"></i>
                                  <label  for="confnewpass">Confirm New Password:</label>
                                  <?php
                                          echo '<input class="text-box" name = "confpass" id="confnewpass" type="password" placeholder="Confirm New Password" required />';
                                   ?>
                              </div>
                              <script type="text/javascript">
                                function cancel()
                                {
                                  var T = document.getElementById("newpass");
                                  T.value = "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq";
                                  var T = document.getElementById("confnewpass");
                                  T.value = "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq";
                                }
                              </script>
                              <button onclick="cancel()" class = "btn-primary changepassbtn" type="submit" name="cancelpass-submit">Cancel</button>
                              <button class = "btn-primary changepassbtn" type="submit" name="changepass-submit">Change Password</button>
                              </form>


                            </div>
                          </ul>
                      </div>
                      <!-- horizontal rule -->
                      <div class="horizontal-rule">
                      </div>

                  <form action="forms/editprofile.form.php" method="post">
                    <!-- name information -->
                   <div class="name">
                     <p class="category"><u> User Information</u></p>
                     <?php if(isset($_GET['error']))
                           {
                             if(($_GET['error'] == "incorrectPassword"))
                                   echo '<p class="error "><i class = "fas fa-exclamation-triangle"></i>Incorrect Password! </p>';

                             elseif($_GET['error'] == "passwordMismatch")
                                   echo '<p class="error "><i class = "fas fa-exclamation-triangle"></i>NewPassword ConfirmPassword Mismatch! </p>';
                           }
                           elseif(isset($_GET['success']))
                           {
                             if($_GET['success'] == "passwordCorrect")
                             echo '<p class="success" ><i class="fas fa-check"></i>Correct Password!</p>';

                             elseif($_GET['success'] == "passwordChangedSuccessfully")
                             echo '<p class="success" ><i class="fas fa-check"></i>Changed Password Successfully!</p>';
                           }


                     ?>
                     <ul>

                       <div class="name-content">
                         <i class = "fas fa-user"></i>
                         <label for="inputLastName">Last Name:&nbsp;&nbsp;&nbsp;</label>
                         <?php
                             if(isset($_SESSION['user_lname']))
                             {
                                 echo '<input value = "'.$_SESSION['user_lname'].'" class="text-box" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required />';
                             }
                             else
                             {
                                 echo '<input class="text-box" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required />';
                             }
                          ?>
                       </div>

                       <div class="name-content">
                         <i class="fas fa-chalkboard-teacher"></i>
                         <label for="inputFirstName">First Name: &nbsp;</label>
                         <!--firstname-->
                         <?php
                             if(isset($_SESSION['user_fname']))
                             {
                                 echo '<input value = "'.$_SESSION['user_fname'].'" class="text-box" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />';
                             }
                             else
                             {
                                 echo '<input class="text-box" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />';
                             }
                          ?>
                       </div>

                       <div class="name-content">
                         <i class = "fas fa-heart"></i>
                         <label class="small mb-1" for="inputMiddleName">Middle Name: &nbsp;&nbsp;</label>
                         <!--middle name-->
                         <?php
                             if(isset($_SESSION['user_mname']))
                             {
                                 echo '<input value = "'.$_SESSION['user_mname'].'" class="text-box" name = "mname" id="inputMiddleName" type="text" placeholder="Enter middle name" required/>';
                             }
                             else
                             {
                                 echo '<input class="text-box" name = "mname" id="inputMiddleName" type="text" placeholder="Enter Middle name" required/>';
                             }
                          ?>

                       </div>
                       <div class="name-content">
                         <div class="demo">
                             <label for="position" style="font-size: 80%;">Choose a Position:</label>
                             <div class="dropdown-container">
                               <?php
                                       echo '
                                       <select name = "level" id = "level" required>
                                         <option disabled hidden>Choose here</option>
                                         <option id ="1" value="teacher">Teacher</option>
                                         <option id ="2" value="principal">Principal</option>
                                         </select>
                                         <script>
                                         function myFunction()
                                         {
                                           document.getElementById("level").value = "'.$_SESSION['user_level'].'";
                                         }
                                         myFunction();
                                         </script>
                                         ';



                                ?>

                               <div class="select-icon">
                                 <svg focusable="false" viewBox="0 0 104 128" width="25" height="35" class="icon">
                                   <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
                                 </svg>
                               </div>
                               </div>
                           </div>

                       </div>
                     </ul>
                   </div>


                   <!-- horizontal rule -->
                   <div class="horizontal-rule">
                   </div>
                   <!-- contact information -->
                   <div class="contact">
                     <p class="category"><u>Contact Information</u></p>
                     <ul>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class = "fas fa-address-book"></i>
                           <label class="small mb-1" for="inputPassword">Contact Number:&nbsp;&nbsp; </label>
                           <?php
                               if($info['contact_num']?? null != null)
                               {
                                   echo '<input value = "'.$info['contact_num'].'" class="text-box" type="tel" name = "contact-num" id="inputPassword" placeholder="use format: 0##-####-####" required/>';
                               }
                               else
                               {
                                   echo '<input type="tel" class="text-box" name = "contact-num" id="inputPassword" placeholder="use format: 0##-####-####" required/>';
                               }
                            ?>
                         </div>
                       </div>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class = "fab fa-facebook-f"></i>
                           <label for="inputConfirmPassword">FB UserName: &nbsp;&nbsp;&nbsp;</label>
                           <!--fb username-->
                           <?php
                               if($info['fb_acct']?? null != null)
                               {
                                   echo '<input value = "'.$info['fb_acct'].'" type="text" class="text-box" name = "fb-username" id="inputConfirmPassword"  placeholder="Enter FB UserName" required/>';
                               }
                               else
                               {
                                   echo '<input type="text" class="text-box" name = "fb-username" id="inputConfirmPassword"  placeholder="Enter FB UserName" required/>';
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
                               if($_SESSION['user_email']?? null != null)
                               {
                                   echo '<input value = "'.$_SESSION['user_email'].'" class="text-box" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>';
                               }
                               else
                               {
                                   echo '<input class="text-box" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>';
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
                     <ul>
                       <div class="divider-inline2">
                         <div class="contact-content">
                           <i class = "fas fa-address-book"></i>
                           <label for="inputLastName">Specification:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                           <!--his major subject-->
                           <?php
                               if($info['major']?? null != null)
                               {
                                   echo '<input value = "'.$info['major'].'" class="text-box"name = "major" id="inputLastName" type="text" placeholder="Enter Major" required/>';
                               }
                               else
                               {
                                   echo '<input class="text-box" name = "major" id="inputLastName" type="text" placeholder="Enter Major" required/>';
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
                                           if($_GET['desig'] != null)
                                           {
                                             if($_SESSION['user_level'] == "teacher")
                                             {
                                               echo '<select  name = "desig" id = "position" required>
                                                 <option value="Teacher I">Teacher I</option>
                                                 <option value="Teacher II">Teacher II</option>
                                                 <option value="Teacher III">Teacher III</option>
                                                 <option value="Master Teacher I">Master Teacher I</option>
                                                 <option value="Master Teacher II">Master Teacher II</option>
                                                 <option value="Master Teacher III">Master Teacher III</option>
                                                 <option value="Head Teacher I">Head Teacher I</option>
                                                 <option value="Head Teacher II">Head Teacher II</option>
                                                 <option value="Head Teacher III">Head Teacher III</option>
                                                 </select>
                                                 <script>
                                                 function myFunction()
                                                 {
                                                   document.getElementById("position").value = "'.$_GET['desig'].'";
                                                 }
                                                 myFunction();
                                                 </script>';
                                             }
                                             elseif($_SESSION['user_level'] == "principal")
                                             {
                                               echo '<select value = "'.$_GET['desig'].'" name = "desig" id = "position" required>
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
                                           }
                                       }
                                       else
                                       {
                                         if($_SESSION['user_level'] == "teacher")
                                         {
                                           echo '<select name = "desig" id = "position" required>
                                             <option value="Teacher I">Teacher I</option>
                                             <option value="Teacher II">Teacher II</option>
                                             <option value="Teacher III">Teacher III</option>
                                             <option value="Master Teacher I">Master Teacher I</option>
                                             <option value="Master Teacher II">Master Teacher II</option>
                                             <option value="Master Teacher III">Master Teacher III</option>
                                             <option value="Head Teacher I">Head Teacher I</option>
                                             <option value="Head Teacher II">Head Teacher II</option>
                                             <option value="Head Teacher III">Head Teacher III</option>
                                             </select>';
                                         }
                                         elseif($_SESSION['user_level'] == "principal")
                                         {
                                           echo '<select name = "desig" id = "position" required>
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
                                   if($info['station']?? null != null)
                                   {

                                       echo '<select name = "station" id = "station" required>
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
                                       </select>';
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
                             <!--his major subject-->
                             <?php
                                 if($info['highest_educ_attainment']?? null != null)
                                 {
                                     echo '<input value = "'.$info['highest_educ_attainment'].'" class="text-box" name = "high-educ" id="inputLastName" type="text" placeholder="Enter highest attainment" required/>';
                                 }
                                 else
                                 {
                                     echo '<input class="text-box" name = "high-educ" id="inputLastName" type="text" placeholder="Enter highest attainment" required/>';
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
                               if($info['date_of_birth']?? null != null)
                               {
                                   echo '<input value = "'.$info['date_of_birth'].'" type="date" class="text-box" name = "dateofbirth" id="inputConfirmPassword"  placeholder="Enter date of birth" required/>';
                               }
                               else
                               {
                                   echo '<input type="date" class="text-box" name = "dateofbirth" id="inputConfirmPassword"  placeholder="Enter date of birth" required/>';
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
                               if($info['date_of_latest_promo'])
                               {
                                   echo '<input value = "'.$info['date_of_latest_promo'].'" type = "date" class="text-box" name = "lat-promotion" id="inputConfirmPassword" required/>';
                               }
                               else
                               {
                                   echo '<input type = "date" class="text-box" name = "lat-promotion" id="inputConfirmPassword" required/>';
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
                               if($info['date_of_orig_appointment'])
                               {
                                   echo '<input value = "'.$info['date_of_orig_appointment'].'" type="date" class="text-box" name = "orig-appointment" id="inputPassword" required/>';
                               }
                               else
                               {
                                   echo '<input type="date" class="text-box" name = "orig-appointment" id="inputPassword" required/>';
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

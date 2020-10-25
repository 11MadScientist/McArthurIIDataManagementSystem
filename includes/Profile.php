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
        <link href="css/profile.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div></div>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">

                  <div class="profile-box">


                    <!-- sql command for the profile picture -->

                    <?php
                      $prof_id;
                      if(isset($_GET['id']))
                      {
                        $prof_id = $_GET['id'];
                      }
                      else
                      {
                        $prof_id = $_SESSION['user_id'];
                        echo '  <a id ="editlink" href="EditProfile.php"><u>Edit Profile</u></a>';
                      }



                     $conn = mysqli_connect("localhost", "root", "", "mddb");

                     $obj = new ProfilePic();
                     $result = $obj->get_profile($prof_id);
                        $row = mysqli_fetch_array($result);
                          if($row != null)
                           {
                     ?>
                              <img class = "profile-pic" src="imageView.php?user_id=<?php echo $row["user_id"]; ?>" />
                     <?php
                           }

                           else
                           {
                     ?>
                              <img class = "profile-pic" src="forms/profpic-uploads/unknown.jpg">
                     <?php
                           }
                             mysqli_close($conn);
                      ?>


                     <!-- sql command for the add info -->
                     <?php
                      $objUser = new User();
                      $userInfo = $objUser->idChecker($prof_id);

                      $obj = new AddInfo();
                      $info = $obj->getAddInfo($prof_id?? '');

                      ?>
                      <!-- name information -->
                     <div class="name">

                       <ul>
                         <p><u> User Information</u></p>
                         <div class="name-content">
                           <i class = "fas fa-user"></i>
                           <span>Last Name:</span>
                           <span class = "content"><?php echo $userInfo['l_name']?? ''; ?></span>
                         </div>

                         <div class="name-content">
                           <i class="fas fa-chalkboard-teacher"></i>
                           <span>First Name:</span>
                           <span class = "content"><?php  echo $userInfo['f_name']?? ''; ?></span>
                         </div>

                         <div class="name-content">
                           <i class = "fas fa-heart"></i>
                           <span>Middle Name:</span>
                           <span class = "content"><?php echo $userInfo['m_name']?? ''; ?></span>
                         </div>
                         <div class="name-content">
                           <i class = "fas fa-clock"></i>
                           <span>Grade:</span>
                           <span class = "content"><?php echo $info['grade']?? ''; ?></span>
                         </div>


                       </ul>
                     </div>
                     <!-- horizontal rule -->
                     <div class="horizontal-rule">
                     </div>
                     <!-- contact information -->
                     <div class="contact">
                       <p><u>Contact Information</u></p>
                       <ul>
                         <div class="divider-inline1">
                           <div class="contact-content">
                             <i class = "fas fa-address-book"></i>
                             <span>Contact Number:</span>

                             <span class = "content"><?php echo $info['contact_num']?? ''; ?></span>
                           </div>
                         </div>
                         <div class="divider-inline1">
                           <div class="contact-content">
                             <i class = "fab fa-facebook-f"></i>
                             <span>Facebook:</span>
                             <span class = "content"><?php echo $info['fb_acct']?? ''; ?></span>
                           </div>
                         </div>

                         <div class="divider-block">
                           <div class="contact-content">
                             <i class="fas fa-envelope"></i>
                             <span>Email Address:</span>
                             <span class = "content"><?php  echo $userInfo['email']?? ''; ?></span>
                           </div>
                         </div>
                       </ul>
                     </div>

                     <!-- horizontal rule -->
                     <div class="horizontal-rule">
                     </div>

                     <!-- individual information -->
                     <div class="contact">
                       <p><u>Individual Information</u></p>
                       <ul>
                         <div class="divider-inline1">
                           <div class="contact-content">
                             <i class = "fas fa-address-book"></i>
                             <span>Specification:</span>
                             <span class = "content"><?php echo $info['specification']?? ''; ?></span>
                           </div>

                             <div class="contact-content">
                               <i class = "fas fa-cog"></i>
                               <span>Designation:</span>
                               <span class = "content"><?php echo $userInfo['designation']?? ''; ?></span>
                             </div>
                           </div>
                           <div class="divider-inline1">
                             <div class="contact-content">
                               <i class = "fas fa-school"></i>
                               <span>School Assigned:</span>
                               <span class = "content"><?php echo $info['station']?? ''; ?></span>
                             </div>

                             <div class="contact-content">
                               <i class = "fas fa-rings-wedding"></i>
                               <span>Civil Status:</span>
                               <span class = "content"><?php echo $info['civil_status']?? ''; ?></span>
                             </div>
                           </div>

                           <div class="divider-block">
                             <div class="contact-content">
                               <i class="fas fa-graduation-cap"></i>
                               <span>Highest Educational Attainment:</span>
                               <span class = "content"><?php  echo $info['highest_educ_attainment']?? ''; ?></span>
                             </div>
                         </div>

                       </ul>
                     </div>

                     <!-- horizontal rule -->
                     <div class="horizontal-rule">
                     </div>
                     <!-- contact information -->
                     <div class="contact">
                       <p><u>Dates Information</u></p>
                       <ul>
                         <div class="divider-inline1">
                           <div class="contact-content">
                             <i class = "fas fa-birthday-cake"></i>
                             <span>Date of Birth:</span>
                             <span class = "content"><?php echo $info['date_of_birth']?? ''; ?></span>
                           </div>
                         </div>
                         <div class="divider-inline1">
                           <div class="contact-content">
                             <i class="fas fa-calendar-alt"></i>
                             <span>Date of Latest Promotion:</span>
                             <span class = "content"><?php  echo $info['date_of_latest_promo']?? ''; ?></span>
                           </div>
                         </div>
                         <div class="divider-block">
                           <div class="contact-content">
                             <i class = "fas fa-calendar"></i>
                             <span>Date of Original Appointment:</span>
                             <span class = "content"><?php echo $info['date_of_orig_appointment']?? ''; ?></span>
                           </div>

                         </div>
                       </ul>
                     </div>


                  </div>



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

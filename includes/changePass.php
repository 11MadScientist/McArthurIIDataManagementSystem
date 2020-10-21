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
        <script src="js/imageLoader.js"></script>

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

                              <form action="forms/changePass.form.php" method="post" id = "currpassform">
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
                              <form class="" action="forms/changePass.form.php" method="post" id = "changepassform">
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
                    </div>
                  </main>

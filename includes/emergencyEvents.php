<?php
session_start();
if($_SESSION['user_id'] ==  null)
{
  header("Location: forms/logout.form.php");
  exit();
}
if(isset($_POST['edit']) and !isset($_POST['request']))
{
  header("Location: LeaveRequestList.php?error=noData");
  exit();
}
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
         <title>McArthurII District RequestLeave</title>
         <link href="css/styles.css" rel="stylesheet" />
         <link href="css/emergencyEvent.css" rel="stylesheet" />
         <link href="css/lee.css" rel="stylesheet" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

         <!-- time picker -->
         <script src="js/imageLoader.js"></script>

     </head>
     <body class="sb-nav-fixed">
       <?php include('topbar.php'); ?>
       <?php include('sidebar.php'); ?>
       <div></div>
       <div id="layoutSidenav_content">
           <main>
               <div class="container-fluid">
                   <h1 class="mt-4">Training event</h1>
                   <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                       <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                       <li class="breadcrumb-item active"><a href="attendance.php">Attendance</a></li>
                       <li class="breadcrumb-item active"><a href="TrainingList.php">TrainingList</a></li>
                       <li class="breadcrumb-item active">Training Event</li>
                   </ol>

                   <div class="createEvent-box">
                     <p class="header">Training Event Details</p>
                     <?php
                         if(isset($_GET['error']))
                         {

                             if($_GET['error'] == "invalidDateTime")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Invalide Date-Time Input!</p>';
                             }

                         }
                         elseif(isset($_GET['success']))
                         {

                           if($_GET['success'] == "Trainingsubmitted")
                           {
                             echo '<p class="success"><i class = "fas fa-check"></i>Training data sent successfully!</p>';
                           }
                           if($_GET['success'] == "Trainingdeleted")
                           {
                             echo '<p class="success"><i class = "fas fa-check"></i>Training data successfully deleted!</p>';
                           }
                         }

                         // retrieving information if id is present
                         $realid;
                         if(isset($_GET['id']))
                         {
                           $obj = new Monitoring();
                           $info = $obj->getIndivTraining($_GET['id']);

                         }
                         elseif(isset($_POST['request']))
                         {

                           foreach($_POST['request'] as $id)
                           {
                             $realid = $id;
                             $obj = new Monitoring();
                             $info = $obj->getIndivTraining($id);
                           }

                         }


                    if(isset($_GET['id']))
                    {
                      echo '<form id="form" action="forms/editTraining.form.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="'.$_GET['id'].'">';

                    }
                    elseif(isset($_POST['request']))
                    {
                      echo '<form id="form" action="forms/editTraining.form.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="'.$realid.'">';

                    }
                    else
                    {
                      echo '<form class="" action="forms/createTraining.form.php" method="post" enctype="multipart/form-data">';
                    }
                      ?>

                    <a href="TrainingList.php" class = " back" type="submit" name="event-submit"><i class="fas fa-arrow-left"></i>Back</a>

                       <div class="date" style="">
                         <label for="startdate">Date: &nbsp;</label>
                         <?php
                            if(isset($_POST['request']) or isset($_GET['id']))
                            {
                                echo '<input value ='.$info['training_date'].' type="date" class="date-time" name="start_date" id = "startdate" value="" required>';
                            }
                            else
                            {
                              if(isset($_GET['training_date']))
                              {
                                echo '<input value ='.$_GET['training_date'].' type="date" class="date-time" name="start_date" id = "startdate" value="" required>';
                              }
                              else
                              {
                                echo '<input type="date" class="date-time" name="start_date" id = "startdate" value="" required>';
                              }
                            }
                          ?>
                        </div>

                       <label class="block-head" style="display:block;" for="title">Division Memorandum Number:</label>
                       <div class="start">
                         <label for="startdate">DM Number:&nbsp;</label>
                         <?php
                            if(isset($_POST['request']) or isset($_GET['id']))
                            {
                                echo '<input value ='.$info['dm_number'].' type="text" class="texts" name="dm_number" id = "startdate" value="" required>';
                            }
                            else
                            {
                              if(isset($_GET['dm_number']))
                              {
                                echo '<input value ='.$_GET['dm_number'].' type="text" class="texts" name="dm_number" id = "startdate" value="" required>';
                              }
                              else
                              {
                                echo '<input type="text" class="texts" name="dm_number" id = "startdate" value="" required>';
                              }
                            }
                          ?>

                        </div>
                        <div class="end">
                          <label for="enddate">, s.&nbsp;</label>
                          <?php
                            if(isset($_POST['request']) or isset($_GET['id']))
                            {
                                echo '<input type="text" class="texts" name="year" id = "enddate" value='.$info['year'].' required>';
                            }
                            else
                            {
                              if(isset($_GET['year']))
                              {
                                echo '<input type="text" class="texts" name="year" id = "enddate" value='.$_GET['year'].'required>';
                              }
                              else
                              {
                                 echo '<input type="text" class="texts" name="year" id = "enddate" required>';
                              }
                            }
                           ?>
                         </div>

                       <div class="buttons" style="display: block;">
                         <?php
                          if(isset($_POST['request']) or isset($_GET['id']))
                          {
                            echo '<button onclick="return warning()" id="delete" class = "delete" type="submit" name="delete">Delete</button>';
                          }
                          ?>
                          <script>
                          function warning()
                          {

                            var result = confirm("Want to delete?");
                            if(!result)
                            {

                                alert('Submission Canceled');
                                return false;

                            }
                          }
                          </script>

                         <button class = "btn-primary passbtn" type="submit" name="req-submit">Submit</button>
                       </div>
                     </form>
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
         <script>
           function submit(str) {
             alert(`You have successfully submitted your RequestLeave! Timestamp: ${str}`)
           }
         </script>
     </body>
 </html>

<?php
session_start();
if($_SESSION['status'] !=  'Administrator')
{
  header("Location: forms/logout.form.php");
  exit();
}
include('autoloader.inc.php');
 ?>
 !DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8" />
         <meta http-equiv="X-UA-Compatible" content="IE=edge" />
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
         <meta name="description" content="" />
         <meta name="author" content="" />
         <title>McArthurII District CreateReport</title>
         <link href="css/styles.css" rel="stylesheet" />
         <link href="css/createEvent.css" rel="stylesheet" />
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
                   <h1 class="mt-4">CreateReport</h1>
                   <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                       <li class="breadcrumb-item active">CreateReport</li>
                       <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                   </ol>

                   <div class="createEvent-box">
                     <p class="header">Report Details</p>
                     <?php
                         if(isset($_GET['error']))
                         {
                             if($_GET['error'] == "duplicateTitle")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Title already exists!</p>';
                             }
                             elseif($_GET['error'] == "fileSizeTooBig")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Image uploaded is too big!</p>';
                             }
                             elseif($_GET['error'] == "errorInUploadingFile")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>There was an error in uploading Image!</p>';
                             }
                             elseif($_GET['error'] == "invalidDateTime")
                             {
                               echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Invalid Date-Time Input!</p>';
                             }

                         }
                         elseif(isset($_GET['success']))
                         {

                           if($_GET['success'] == "reportCreated")
                           {
                             echo '<p class="success"><i class = "fas fa-check"></i>Report Successfully Created!</p>';
                           }
                           if($_GET['success'] == "reportEdited")
                           {
                             echo '<p class="success"><i class = "fas fa-check"></i>Report Successfully Edited!</p>';
                           }
                         }

                         // retrieving information if id is present
                         if(isset($_GET['id']))
                         {
                           $obj = new Events();
                           $info = $obj->getOneEvent($_GET['id']);
                           $start = explode(' ', $info['end_date']);
                           $end = explode(' ', $info['end_date']);
                         }


                    if(isset($_GET['id']))
                    {
                      echo '<form id="form" action="forms/editReport.form.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="'.$_GET['id'].'">';

                    }
                    else
                    {
                      echo '<form class="" action="forms/createReport.form.php" method="post" enctype="multipart/form-data">';
                    }
                      ?>

                    <a href="reports-main.php" class = " back" type="submit" name="report-submit"><i class="fas fa-arrow-left"></i>Back</a>



                       <label class="block-head" style="display:block;" for="title">Title:</label>
                       <?php
                          if(isset($_GET['id']))
                          {
                             echo '<input class="title" type="" id="title" name="title" required value ="'.$info['title'].'">';

                          }
                          else
                          {
                            if(isset($_GET['title']))
                            {
                                echo '<input class="title" type="text" id="title" name="title" required value = "'.$_GET['title'].'">';
                            }
                            else
                            {
                                echo '<input class="title" type="text" id="title" name="title" required>';
                            }
                          }
                        ?>


                       <label class="block-head" for="description">Description:</label>
                       <?php
                          if(isset($_GET['id']))
                          {
                            echo '<textarea class="desc" type="text" id="description" name="description" required></textarea>
                            <script>
                               function setData()
                               {
                                 document.getElementById("description").value = "'.$info['description'].'";

                               }
                               setData();
                            </script>';
                          }
                          else
                          {
                            if(isset($_GET['description']))
                            {
                               echo '<textarea class="desc" type="text" id="description" name="description" required></textarea>
                               <script>
                                  function setData()
                                  {
                                    document.getElementById("description").value = "'.$_GET['description'].'";

                                  }
                                  setData();
                               </script>';
                            }
                            else
                            {
                                echo '<textarea class="desc" type="text" id="description" name="description" required></textarea>';
                            }
                          }
                        ?>
                        <div class="start">
                          <label for="startdate">Deadline Date:</label>
                          <?php
                             if(isset($_GET['id']))
                             {
                                 echo '<input value ='.$start[0].' type="date" class="date-time" name="end_date" id = "startdate" value="">';
                             }
                             else
                             {
                               if(isset($_GET['end_date']))
                               {
                                 echo '<input value ='.$_GET['end_date'].' type="date" class="date-time" name="end_date" id = "startdate" value="">';
                               }
                               else
                               {
                                 echo '<input type="date" class="date-time" name="end_date" id = "startdate" value="">';
                               }
                             }
                           ?>

                         </div>

                         <div class = "end">
                          <label for="endtime">Deadline Time:&nbsp;</label>
                          <?php
                             if(isset($_GET['id']))
                             {
                                 echo '<input type="time" class="date-time"  name="end_time" id = "endtime" value='.$end[1].'>';
                             }
                             else
                             {
                               if(isset($_GET['end_time']))
                               {
                                   echo '<input type="time" class="date-time"  name="end_time" id = "endtime" value='.$_GET['end_time'].'>';
                               }
                               else
                               {
                                   echo '<input type="time" class="date-time"  name="end_time" id = "endtime">';
                               }
                             }
                           ?>

                        </div>


                       <label style="display:block;" for = eventimage>Upload Reference File:</label>
                        <input onchange="readURL(this);" class = "event-img" name="event-img" id = "eventimage" type="file" >

                        <?php
                            if(isset($_GET['id']))
                            {
                              ?>
                                <img class = "main" src="eventImgView.php?id=<?php echo $_GET["id"]; ?>"  id="blah" src="#" onerror="showImg();"  />
                              <?php
                            }
                            else
                            {
                              echo '<img id="blah" src="#" alt="your image" onerror="showImg()"/>';
                            }
                         ?>
                         <script>
                           function showImg()
                           {
                             document.getElementById("blah").style.display = "none";
                           }
                         </script>




                       <div class="buttons">
                         <?php
                          if(isset($_GET['id']))
                          {
                            echo '<button onclick="return warning()" id="delete" class = "delete" type="submit" name="delete-event">Delete</button>';
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

                         <button class = "btn-primary passbtn" type="submit" name="event-submit">OK</button>
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
             alert(`You have successfully submitted your CreateEvent! Timestamp: ${str}`)
           }

         </script>
     </body>
 </html>

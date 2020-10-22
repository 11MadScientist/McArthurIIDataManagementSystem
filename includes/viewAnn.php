<?php
session_start();
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
         <title>McArthurII District Announcement</title>
         <link href="css/styles.css" rel="stylesheet" />
         <link href="css/createEvent.css" rel="stylesheet" />
         <link href="css/viewEvent.css" rel="stylesheet" />

         <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

         <!-- image loader script -->
         <script src="js/imageLoader.js"></script>

     </head>
     <body class="sb-nav-fixed">
       <?php include('topbar.php'); ?>
       <?php include('sidebar.php'); ?>
       <div></div>
       <div id="layoutSidenav_content">
           <main>
               <div class="container-fluid">
                   <h1 class="mt-4">Announcement</h1>
                   <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                       <li class="breadcrumb-item active">Announcement</li>
                       <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                   </ol>

                   <div class="createEvent-box">
                     <p style="margin-top: 40px;">Announcement</p>
                     <?php
                          $obj = new Announcement();
                          $info = $obj->getSingleAnn($_GET['id']);
                          $obj1 = new User();
                          $creator = $obj1->idChecker($info['user_id'])

                      ?>


                       <div style="width:100%;" class="start">
                         <label for="startdate">Date Created:</label>
                          <p style="margin-right:20%;" class="info" id = "startdate"><?php echo date('Y-M-d h:ia', strtotime($info['date_created']));?></p>

                          <label for="startdate">Created By:</label>
                           <p class="info" href="#" id = "startdate"><a href="Profile.php?id=<?php echo $info['user_id'] ?>"><?php echo $creator['f_name']." "
                           .$creator['l_name'];?></a></p>
                        </div>

                       <label style="display:block;" for="title">Title</label>
                          <p class="main"><?php echo $info['title']?></p>


                       <label for="description">Description</label>
                        <p class="main"><?php echo $info['description']?></p>


                       <label style="display:block;" for = eventimage><u>Event Image</u></label>
                        <img class = "main" src="annImgView.php?id=<?php echo $_GET["id"]; ?>"  id="blah" src="#" alt="your image" onerror="showImg();"/>
                        <script>
                          function showImg()
                          {
                            document.getElementById("blah").style.display = "none";
                          }
                        </script>

                       <a href="Announcements.php" class = "btn-primary passbtn" type="submit" name="event-submit">Back</a>


                       <a href="CreateAnnouncement.php?id=<?php echo $_GET['id']; ?>" class = "btn-primary passbtn" type="submit" name="event-submit">Edit</a>
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

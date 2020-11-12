<?php
session_start();
if($_SESSION['user_id'] == null)
{
  header("Location: forms/logout.form.php");
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
         <title>McArthurII District ViewEvent</title>
         <link href="css/styles.css" rel="stylesheet" />
         <!-- <link href="css/createEvent.css" rel="stylesheet" /> -->
         <link href="css/viewEvent.css" rel="stylesheet" />

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
                   <h1 class="mt-4">View Event</h1>
                     <?php
                          $obj = new Events();
                          $info = $obj->getOneEvent($_GET['id']);
                          $start = explode(' ', $info['start_date']);
                          $end = explode(' ', $info['end_date']);
                      ?>
                   <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                       <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                       <li class="breadcrumb-item active"><a href="Events.php">Events</a></li>
                       <li class="breadcrumb-item active"><?php echo $info['title']?></li>
                   </ol>

                   <div class="createEvent-box">
                     <p class = "header">Event Details</p>
                     <?php
                         $conn = mysqli_connect("localhost", "root", "", "mddb");

                         $obj = new Events();
                         $result = $obj->get_eventImg($_GET['id']);
                            $row = mysqli_fetch_array($result);
                              if($row != null)
                               {
                         ?>
                                  <img class = "main" src="eventImgView.php?id=<?php echo $_GET["id"]; ?>"  id="blah" src="#" alt="your image" onerror="showImg();"/>
                         <?php
                               }

                               else
                               {
                         ?>
                                  <img id="blah" />
                         <?php
                               }
                                 mysqli_close($conn);
                          ?>
                     <div class="content_box">
                     <label class="block-head" style="display:block;" for="title">Title</label>
                     <div class="info1">
                       <p class="main"><?php echo $info['title']?> </p>
                     </div>

                       <div class="start">
                         <label>Start Date:</label>
                           <p class="info" ><?php echo date('Y-M-d', strtotime($start[0]));?></p>

                         <label for="starttime">Start Time:&nbsp;</label>
                         <p class="info" ><?php echo date('H:i:sa', strtotime($start[1]));?></p>

                        </div>

                        <div class="end">
                          <label for="enddate">End Date:</label>
                          <p class="info"><?php echo date('Y-M-d', strtotime($end[0]));?></p>

                          <label for="endtime">End Time:&nbsp;</label>
                          <p class="info"><?php echo date('H:i:sa', strtotime($end[1]));?></p>
                        </div>

                          <label class="block-head" for="description">Description</label>
                          <div class="info2">
                            <p class="main"><?php echo $info['description']?></p>
                          </div>

                      <script>
                          function showImg()
                          {
                            document.getElementById("blah").style.display = "none";
                          }
                      </script>

                       <a href="Events.php" class = "btn-primary passbtn" type="submit" name="event-submit">Back</a>

                       <?php
                          if($_SESSION['status'] == 'Administrator')
                          {
                            ?>
                              <a href="CreateEvent.php?id=<?php echo $_GET['id']; ?>" class = "btn-primary passbtn" type="submit" name="event-submit">Edit</a>
                            <?php
                          }
                        ?>
                     </div>

                   </div>


               </div>
                <?php include('footer.php') ?>
           </main>

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
             alert(`You have successfully submitted your ViewEvent! Timestamp: ${str}`)
           }
         </script>
     </body>
 </html>

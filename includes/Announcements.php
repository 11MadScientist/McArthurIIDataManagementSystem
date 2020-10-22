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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/events.css">

    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div></div>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">
                  <h1 class="mt-4">Announcements</h1>
                  <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                      <li class="breadcrumb-item active">Announcements</li>
                      <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                  </ol>

                  <div class="buttons">

                    <a class="create-event btn-primary" name="create-event" href = "CreateAnnouncement.php">Create Announcement</a>
                  </div>

                  <table style='width:100%;' class='display table table-hover center' cellspacing='0'>
                    <col style="width:10%">
	                   <col style="width:20%">
	                    <col style="width:30%">
                    <thead>
                      <p class="tag">Announcements</p>
                      <tr style="text-align: center; vertical-align: middle;">
                        <th><i class='fas fa-calendar-alt' style='font-size:15px'></i> Date Created</th>
                        <th><i class='fas fa-exclamation-circle' style='font-size:15px'></i> Announcement</th>
                        <th><i class='fas fa-info' style='font-size:15px'></i> Description</th>

                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      date_default_timezone_set('Asia/Manila');
                      //this is a day counter
                        $month = date('Y-m',strtotime('today'));

                        $obj = new Announcement();
                        $result = $obj->getAllAnn();

                        if($result !== null)
                        {
                          while($row = mysqli_fetch_array($result))
                          {
                              echo "<tr style=text-align: center; vertical-align: middle;>
                                    <td>".date('Y-M-d h:ia', strtotime($row['date_created']))."</td>".
                                   "<td><a href=viewAnn.php?id=".$row['id'].">".$row['title']."</a></td>".
                                   "<td>".$row['description']."</td>
                                    </tr>";

                          }
                        }

                       ?>

                    </tbody>
                  </table>



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

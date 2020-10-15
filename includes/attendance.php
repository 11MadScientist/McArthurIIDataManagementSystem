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
    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div></div>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">
                  <h1 class="mt-4">Attendance</h1>
                  <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                      <li class="breadcrumb-item active">Attendance</li>
                      <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                  </ol>

                  <!--ATTENDANCE TABLE-->
                    <table style='width:100%' class='display table table-hover center' cellspacing='0'>
                      <thead>
                        <tr style="text-align: center">
                          <th>Date</th>
                          <th>Time</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          date_default_timezone_set('Asia/Manila');
                          $day = date('M-d',strtotime('today'));
                          $today = date('M-d',strtotime('today'));
                          //echo $day;
                          // loop for getting the 1 week before up to this day
                          for($i= 8; $i > 0; $i--)
                          {
                        ?>
                            <tr>
                              <!-- Getting today to the previous days -->
                              <td>
                                <nobr><?php echo gmdate("l", strtotime('+1 day', strtotime($today)))?></nobr>
                                <br><?php echo date('M-d',strtotime($today));?></br>
                              </td>
                              <td style="text-align:center">
                                <?php
                                  // today determiner
                                  if($day == $today)
                                  {
                                    //attendance for today
                                    echo "<button type='submit' value='submit' name='submitAttendance' class='btn btn-primary'>Submit Attendance</button>";
                                  }
                                  else
                                    //timestamp for the previous days
                                  {
                                    echo "8am-5pm";
                                  }
                                ?>
                              </td>
                              <!-- determine of the status (present or absent) -->
                              <td style="text-align:center">
                                <?php
                                    // today determiner
                                    if($day == $today)
                                    {
                                      //status for today
                                      echo "N/A";
                                    }
                                    else
                                      //status for the previous days
                                    {
                                      echo "Present";
                                    }
                                  ?>
                              </td>
                            </tr>
                            <?php 
                            // day iterator
                            $today = date('M-d', strtotime('-1 day', strtotime($today)));
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

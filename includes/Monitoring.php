<?php
session_start();

if($_SESSION['status'] !=  'Administrator')
{
  header("Location: forms/logout.form.php");
  exit();
}
include('autoloader.inc.php');
date_default_timezone_set('Asia/Manila');
?>


!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <meta name="description" content="" />

        <meta name="author" content="" />

        <title>McArthurII District Monitoring</title>

        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/events.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/table.css">
        <link rel="stylesheet" href="css/monitoring.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

    </head>

    <body class="sb-nav-fixed">

      <?php include('topbar.php'); ?>

      <?php include('sidebar.php'); ?>

      <div></div>

      <div id="layoutSidenav_content">

          <main>

              <div class="container-fluid">

                  <h1 class="mt-4">Monitoring</h1>

                  <ol style = "background-color:#86B898" class="breadcrumb mb-4">

                      <li class="breadcrumb-item active">Monitoring</li>

                      <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>

                  </ol>

                  <div class ="requests">

                    <!--REQUESTS TABLE-->
                    <div class="card-body">
                        <div class="table-responsive">
                          <div class="" style="text-align:center;">
                            <form class="" action="Monitoring.php" method="post">

                            <?php

                                  if(isset($_POST['date']))
                                  {
                                    $_SESSION['day'] = date('Y-m-d',strtotime($_POST['date']));
                                  }

                                  if(isset($_POST['prev']))
                                  {
                                    $_SESSION['day'] = date('Y-m-d', strtotime('-1 day', strtotime($_SESSION['day'])));
                                    echo '<p class="date-project">'.date('M-d-Y', strtotime($_SESSION['day'])).'</p>';
                                  }
                                  elseif(isset($_POST['today']))
                                  {
                                    $_SESSION['day'] = date('Y-m-d',strtotime('today'));
                                    echo '<p class="date-project">'.date('M-d-Y', strtotime($_SESSION['day'])).'</p>';
                                  }
                                  elseif(isset($_POST['next']))
                                  {
                                    $_SESSION['day']= date('Y-m-d', strtotime('+1 day', strtotime($_SESSION['day'])));
                                    echo '<p class="date-project">'.date('M-d-Y', strtotime($_SESSION['day'])).'</p>';
                                  }
                                  elseif(isset($_POST['date']))
                                  {
                                    $_SESSION['day'] = date('Y-m-d',strtotime($_POST['date']));
                                    echo '<p class="date-project">'.date('M-d-Y', strtotime($_SESSION['day'])).'</p>';
                                  }
                                  else
                                  {
                                    echo '<p class="date-project">'.date('M-d-Y', strtotime($_SESSION['day'])).'</p>';
                                  }
                             ?>
                             <button onclick="" class="navigate" type="submit" name="next">Next <i class="fas fa-arrow-right"></i></button>
                             <button onclick="" class="navigate" type="submit" name="today">Today</button>
                             <button class="navigate" type="submit" name="prev"><i class="fas fa-arrow-left"></i> Prev</button>

                          </form>

                          </div>
                          <div class="div-date">
                            <form class="" action="Monitoring.php" method="post">
                              <button class="go" type="submit" name="submit">GO</button>
                              <input class="date" type="date" name="date" value="">
                            </form>

                          </div>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>

                                    <tr>
                                        <th><i class="fas fa-user"></i> Name</th>
                                        <th><i class="fas fa-school"></i> School</th>
                                        <th><i class="fas fa-sun"></i> AM/PM</th>
                                        <th><i class="fas fa-clock"></i> Time In</th>
                                        <th><i class="fas fa-clock"></i> Time Out</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                      $obj = new Monitoring();
                                      $res = $obj->showAttendance($_SESSION['day']);

                                      while($row = mysqli_fetch_array($res))
                                      {

                                        if($row['pm_status'] == null)
                                        {
                                            $row['pm_status'] = 'Absent';
                                        }
                                        if($row['timein_pm'] == false)
                                        {
                                          $row['timein_pm'] = 'No-Time-In';
                                        }
                                        if($row['timeout_pm'] == false)
                                        {
                                          $row['timeout_pm'] = 'No-Time-Out';
                                        }



                                          echo "<tr style=background:#B4F0B4>
                                                <td>".$row['l_name'].", ".$row['f_name']." ". $row['m_name']."</td>".
                                               "<td>".$row['station']."</td>".
                                               "<td>".'PM'."</td>".
                                                "<td>".$row['timein_pm'] ."</td>".
                                                "<td>".$row['timeout_pm'] ."</td>".
                                               "<td>".$row['pm_status']."</td>
                                                </tr>";

                                        // am part
                                        if($row['am_status'] == null)
                                        {
                                            $row['am_status'] = 'Absent';
                                        }
                                        if($row['timein_am'] == false)
                                        {
                                          $row['timein_am'] = 'No-Time-In';
                                        }
                                        if($row['timeout_am'] == false)
                                        {
                                          $row['timeout_am'] = 'No-Time-Out';
                                        }



                                          echo "<tr>
                                                <td>".$row['l_name'].", ".$row['f_name']." ". $row['m_name']."</td>".
                                               "<td>".$row['station']."</td>".
                                               "<td>".'AM'."</td>".
                                                "<td>".$row['timein_am'] ."</td>".
                                                "<td>".$row['timeout_am'] ."</td>".
                                               "<td>".$row['am_status']."</td>
                                                </tr>";

                                      }
                                     ?>


                                </tbody>
                            </table>

                        </div>
                        <div style = "position: static; display:flex; justify-content:center;" name="buttonDiv">

                            <a href = "LeaveRequests.php" value='submit' name='accpt-req' class='btn btn-primary' style="width:35%; border-radius:3px; height:100%;">Leave Requests</a>

                        </div>
                </div>




                  </div>



              </div>

          </main>

        <?php include('footer.php') ?>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>

        <!-- SCRIPT FOR SELECT ALL CHECKBOX -->


    </body>

</html>

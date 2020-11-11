<?php
session_start();
include('autoloader.inc.php');
if($_SESSION['user_id'] == null)
{
  header("Location: forms/logout.form.php");
  exit();
}
 ?>
!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>McArthurII District Attendance</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/attendance.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div></div>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid mt-auto" style="padding-right:0px" >
                  <h1 class="mt-4">Attendance</h1>
                  <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                      <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item active">Attendance</li>
                  </ol>
                  <div class="head">
                  <a href="RequestLeave.php" name='accpt-req' class='but btn-primary'>Request Leave</a>
                  <a href="LeaveRequestList.php" name='accpt-req' class='but btn-primary'>Leave Requests List</a>

                  <!--ATTENDANCE TABLE-->
                    <table style='width:100%'>
                      <col style="width:1%; height:15px">
                      <col style="width:20%; height:15px">
                      <col style=" height:15px">
                      <col style=" height:15px">
                      <col style="width:10%; height:15px">
                      <thead>
                        <tr style="text-align: center; vertical-align: middle;">
                          <th><i class='fas fa-calendar-alt' ></i>  Date</th>
                          <th><i class='fas fa-clock' ></i>  AM/PM</th>
                          <th><i class='fas fa-clock' ></i>  Time-In</th>
                          <th><i class='fas fa-clock' ></i>  Time-Out</th>
                          <th><i class='fas fa-exclamation-circle'></i>  Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          date_default_timezone_set('Asia/Manila');
                          //this is a day counter
                          $day = date('M-d',strtotime('today'));
                          //this is for today
                          $today = date('M-d',strtotime('today'));

                          // loop for getting today up to 1 week before
                          $i = 0;
                          while($i <= 30)
                          {
                            $i++;
                            if(gmdate("l", strtotime('+1 day', strtotime($day))) == 'Saturday' or gmdate("l", strtotime('+1 day', strtotime($day))) == 'Sunday')
                            {
                              $day = date('M-d', strtotime('-1 day', strtotime($day)));
                              continue;
                              echo "<script>alert('hello')</script>";
                            }
                        if($day ==  date('M-d',strtotime('today')) and date("H:i:sa") < date("H:i:sa", strtotime('1:00pm')))
                        { }
                        else
                        {
                        ?>

                        <!-- table row for pm -->
                        <tr style="background:#B4F0B4;">
                          <!-- Getting today to the previous days -->
                          <td style="text-align: center; vertical-align: middle;">
                            <br>
                              <?php
                                //prints the day of the week in the table
                                echo gmdate("l-", strtotime('+1 day', strtotime($day)));
                                //prints the month and day in the table
                                echo date('M-d',strtotime($day));
                              ?>
                            </br>
                          </td>
                          <td style="text-align: center; vertical-align: middle;">
                            <?php echo "PM" ?>
                          </td>
                          <!-- td form time in -->
                          <td style="text-align:center; vertical-align: middle;">
                            <?php
                            $ymd = date('Y-m-d', strtotime($day));
                            $obj = new Attendance();
                            $info = $obj->getTimeAm($_SESSION['user_id'],$ymd);

                              // determines if today is today
                              if($day == $today)
                              {
                                //attendance for today
                                //i dunnno how to insert database here :)
                                  if($info['timein_pm']?? null != null)
                                  {
                                    echo $info['timein_pm'];
                                  }
                                  else
                                  {
                                    $lv = new Monitoring();
                                    $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                    if($in and $in !== false)
                                    {
                                      echo 'On-Leave';
                                      $info['pm_status'] = 'On-Leave';
                                    }
                                    elseif(date("H:i:sa") >= date("H:i:sa", strtotime('1:00pm')) and date("H:i:sa") <= date("H:i:sa", strtotime('6:00pm')))
                                    {
                                      ?>
                                        <form class="" action="forms/attendance.form.php" method="post">
                                            <input type="hidden" name="status" value="Present">
                                            <button type='submit' value='submit' name='timein_pmsubmit' class='sub btn-primary' onclick='submit(\"".$today."\")'>Submit Attendance</button>
                                        </form>

                                      <?php
                                    }
                                    elseif(date("H:i:sa") > date("H:i:sa", strtotime('6:00pm')))
                                    {
                                      echo "No-Time-In";
                                    }
                                  }

                              }
                              else
                                //timestamp for the previous days
                              {
                                $lv = new Monitoring();
                                $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                if($in and $in !== false)
                                {
                                  echo 'On-Leave';
                                  $info['pm_status'] = 'On-Leave';
                                }
                                elseif($info['timein_pm']?? null !== null)
                                {
                                  echo $info['timein_pm'];
                                }
                                elseif($info['timein_pm']?? null === null or $info['timein_pm'] == false)
                                {
                                  echo "No-Time-In";
                                }
                              }
                            ?>
                          </td>
                          <!-- td for timeout -->
                          <td style="text-align:center; vertical-align: middle;">
                            <?php
                            $ymd = date('Y-m-d', strtotime($day));
                            $obj = new Attendance();
                            $info = $obj->getTimeAm($_SESSION['user_id'],$ymd);
                              // determines if today is today
                              if($day == $today)
                              {
                                //attendance for today
                                //i dunnno how to insert database here :)
                                  if($info['timeout_pm']?? null != null)
                                  {
                                    echo $info['timeout_pm'];
                                  }
                                  else
                                  {
                                    $lv = new Monitoring();
                                    $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                    if($in and $in !== false)
                                    {
                                      echo 'On-Leave';
                                      $info['pm_status'] = 'On-Leave';
                                    }
                                    elseif($info['timein_pm']?? null != null and date("H:i:sa") <= date("H:i:sa", strtotime('6:00pm')))
                                    {
                                      ?>
                                        <form class="" action="forms/attendance.form.php" method="post">
                                            <input type="hidden" name="status" value="Present">
                                            <button type='submit' value='submit' name='timeout_pmsubmit' class='sub btn-primary' onclick='submit(\"".$today."\")'>Submit Attendance</button>
                                        </form>

                                      <?php
                                    }
                                    elseif(date("H:i:sa") > date("H:i:sa", strtotime('6:00pm')))
                                    {
                                      echo "No-Time-out";
                                    }

                                  }

                              }
                              else
                                //timestamp for the previous days
                              {
                                $lv = new Monitoring();
                                $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                if($in and $in !== false)
                                {
                                  echo 'On-Leave';
                                  $info['pm_status'] = 'On-Leave';
                                }
                                elseif($info['timeout_pm']?? null !== null)
                                {
                                  echo $info['timeout_pm'];
                                }
                                elseif($info['timeout_pm']?? null === null or $info['timeout_pm'] == false)
                                {
                                  echo "No-Time-out";
                                }

                              }
                            ?>
                          </td>
                          <!-- determine of the status (present or absent) -->
                          <td style="text-align:center; vertical-align: middle;">
                            <?php
                                // today determiner
                                if($day == $today)
                                {
                                  //status for today
                                  if($info['pm_status']?? null != null)
                                  {
                                    echo $info['pm_status'];
                                  }
                                  elseif(($info['pm_status']?? false == false or $info['am_status'] == '') and date("H:i:sa") >= date("H:i:sa", strtotime('6:00pm')))
                                  {
                                    echo "Absent";
                                  }
                                }
                                else
                                  //status for the previous days
                                {
                                  if($info['pm_status']?? null !== null)
                                  {
                                    echo $info['pm_status'];
                                  }
                                  elseif($info['pm_status']?? null === null or $info['pm_status'] == false)
                                  {
                                    echo "Absent";
                                  }
                                }
                              ?>
                          </td>
                        </tr>
                      <?php } ?>

                          <!-- table row for am -->
                            <tr>
                              <!-- Getting today to the previous days -->
                              <td style="text-align: center; vertical-align: middle;">
                                <br>
                                  <?php
                                    //prints the day of the week in the table
                                    echo gmdate("l-", strtotime('+1 day', strtotime($day)));
                                    //prints the month and day in the table
                                    echo date('M-d',strtotime($day));
                                  ?>
                                </br>
                              </td>
                              <td style="text-align: center; vertical-align: middle;">
                                <?php echo "AM" ?>
                              </td>
                              <td style="text-align:center; vertical-align: middle;">
                                <?php
                                $ymd = date('Y-m-d', strtotime($day));
                                $obj = new Attendance();
                                $info = $obj->getTimeAm($_SESSION['user_id'],$ymd);
                                  // determines if today is today
                                  if($day == $today)
                                  {
                                    //attendance for today
                                    //i dunnno how to insert database here :)
                                      if($info['timein_am']?? null != null)
                                      {
                                        echo $info['timein_am'];
                                      }
                                      else
                                      {
                                        $lv = new Monitoring();
                                        $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                        if($in and $in !== false)
                                        {
                                          echo 'On-Leave';
                                          $info['am_status'] = 'On-Leave';
                                        }
                                        elseif($info['timein_am']?? null == null and date("H:i:sa") <= date("H:i:sa", strtotime('12:00pm')))
                                        {
                                            ?>
                                              <form class="" action="forms/attendance.form.php" method="post">
                                                  <input type="hidden" name="status" value="Present">
                                                  <button type='submit' value='submit' name='timein_amsubmit' class='sub btn-primary' onclick='submit(\"".$today."\")'>Submit Attendance</button>
                                              </form>

                                            <?php
                                        }
                                        elseif(date("H:i:sa") > date("H:i:sa", strtotime('12:00pm')))
                                        {
                                          echo "No-Time-In";
                                        }
                                      }
                                  }
                                  else
                                    //timestamp for the previous days
                                  {
                                    $lv = new Monitoring();
                                    $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                    if($in and $in !== false)
                                    {
                                      echo 'On-Leave';
                                      $info['am_status'] = 'On-Leave';
                                    }
                                    elseif($info['timein_am']?? null !== null)
                                    {
                                      echo $info['timein_am'];
                                    }
                                    elseif($info['timein_am']?? null === null or $info['timein_am'] == false)
                                    {
                                      echo "No Time-In";
                                    }
                                  }
                                ?>
                              </td>
                              <td style="text-align:center; vertical-align: middle;">
                                <?php
                                $ymd = date('Y-m-d', strtotime($day));
                                $obj = new Attendance();
                                $info = $obj->getTimeAm($_SESSION['user_id'],$ymd);
                                  // determines if today is today
                                  if($day == $today)
                                  {
                                    //attendance for today
                                    //i dunnno how to insert database here :)
                                      if($info['timeout_am']?? null != null)
                                      {
                                        echo $info['timeout_am'];
                                      }
                                      else
                                      {
                                        $lv = new Monitoring();
                                        $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                        if($in and $in !== false)
                                        {
                                          echo 'On-Leave';
                                          $info['pm_status'] = 'On-Leave';
                                        }
                                        else
                                        {
                                          $lv = new Monitoring();
                                          $in = $lv->getLeave($_SESSION['user_id'], $ymd);
                                          if($in and $in !== false)
                                          {
                                            echo 'On-Leave';
                                            $info['am_status'] = 'On-Leave';
                                          }
                                          elseif($info['timein_am']?? null !== null and date("H:i:sa") <= date("H:i:sa", strtotime('12:00pm')))
                                          {
                                            ?>
                                              <form class="" action="forms/attendance.form.php" method="post">
                                                  <input type="hidden" name="status" value="Present">
                                                  <button type='submit' value='submit' name='timeout_amsubmit' class='sub btn-primary' onclick='submit(\"".$today."\")'>Submit Attendance</button>
                                              </form>

                                            <?php
                                          }
                                          elseif(date("H:i:sa") > date("H:i:sa", strtotime('12:00pm')))
                                          {
                                            echo "No-Time-out";
                                          }
                                        }

                                      }

                                  }
                                  else
                                    //timestamp for the previous days
                                  {
                                    if($info['timeout_am']?? null !== null)
                                    {
                                      echo $info['timeout_am'];
                                    }
                                    elseif($info['timeout_am']?? null === null or $info['timeout_am'] == false)
                                    {
                                      echo "No Time-out";
                                    }

                                  }
                                ?>
                              </td>
                              <!-- determine of the status (present or absent) -->
                              <td style="text-align:center; vertical-align: middle;">
                                <?php
                                    // today determiner
                                    if($day == $today)
                                    {
                                      //status for today
                                      if($info['am_status']?? null != null)
                                      {
                                        echo $info['am_status'];
                                      }
                                      elseif(($info['am_status']?? false  == false or $info['am_status'] == '') and date("H:i:sa") > date("H:i:sa", strtotime('12:00pm')))
                                      {
                                        echo "Absent";
                                      }

                                    }
                                    else
                                      //status for the previous days
                                    {
                                      if($info['am_status']?? null !== null)
                                      {
                                        echo $info['am_status'];
                                      }
                                      elseif($info['am_status']?? null === null or $info['pm_status'] == false or $info['pm_status'] == '')
                                      {
                                        echo "Absent";
                                      }


                                    }
                                  ?>
                              </td>
                            </tr>
                            <?php
                            // day iterator
                            $day = date('M-d', strtotime('-1 day', strtotime($day)));
                          }
                            ?>
                      </tbody>
                    </table>
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
    </body>
</html>

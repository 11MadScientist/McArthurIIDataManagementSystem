<!DOCTYPE html>
<?php session_start();
include('autoloader.inc.php');
 ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>McArthurII District Reports</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/reports-main.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <style>
          .action
          {
            z-index: 1;
            position: absolute;
            left: 90%;
            margin-top: 5px;
          }
        </style>
    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div></div>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">
                  <h1 class="mt-4">Reports</h1>
                  <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                      <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item active">Reports</li>
                  </ol>
                  <?php
                    if($_SESSION['status'] == 'Administrator')
                    {
                      ?>
                      <div style = "position: static; display:flex; justify-content:center;" name="buttonDiv">
                          <a href="createReport.php" type='submit' value='submit' name='createReport' class='btn btn-primary' style="width:45%; height:100%;">Create Report</a>
                      </div>
                      <?php
                    }
                   ?>
                  <div class = "report-main">
                    <div class="spacing" style="width:100%;height:20px;position: relative;">
                    <div name="progress" style="text-align:left; position:absolute; top:25%; left: 85% "><h11>Your progress</h11></div>
                  </div>

                    <div class="list_content" style="position: relative; ">
                      <ul class="report_list" style="list-style-type: none;">
                      <?php
                      $obj = new Reports();
                      $result = $obj->getReport();
                        //LOOP FOR REPORTS LIST (DEPENDENT TO THE DATA OF REPORTS TO BE SUBMITTED)
                        while($row = mysqli_fetch_array($result))
                        {

                      ?>
                          <!-- LIST ROW -->
                          <li>
                            <div class="list_div" style="width: 100%; height: 10%; padding-bottom: 20px; " >
                              <!-- NAME DIV -->
                              <div style="width:92%; border-bottom: 2px dotted grey; padding-bottom: 5px">

                                <!-- LINK TO REPORT SUBMISSION PHP -->
                                  <!-- ICON -->
                                  <i class='fas fa-file' style='font-size:25px; padding-bottom: 3px'></i>
                                  <!-- NAME OF REPORT -->
                                  <?php
                                    if($_SESSION['status'] != 'Administrator')
                                    {
                                  ?>
                                      <a id="title" href="reports.php?id=<?php echo $row['report_id'] ?>"
                                      class="report_name" style="font-size: 25px; padding:10px;">
                                      <u><?php echo $row['report_title'] ?></u></a>
                                  <?php
                                    }
                                    else
                                    {
                                      ?>
                                      <a id="title" href="createReport.php?id=<?php echo $row['report_id'] ?>"
                                        class="report_name" style="font-size: 25px; padding:10px;">
                                        <u><?php echo $row['report_title'] ?></u></a>
                                      <?php
                                    }
                                   ?>
                                </a>

                                <div class="report_info">
                                  <!-- DESCRIPTION AREA -->
                                  <span id="desc" class="reportDescription" style="padding: 10px;">
                                    Description: <?php echo $row['report_description'] ?>
                                  </span>


                                  <!-- STATUS PROGRESS CHECHBOX -->
                                  <span class="action">
                                    <?php
                                      $indv = $obj->getSubmittedReport($_SESSION['user_id'], $row['report_id']);
                                      if($indv['file_name']?? null != null)
                                      {
                                        ?>
                                          <img class="chckbx" src="forms/profpic-uploads/checked.png" alt="checked">
                                        <?php
                                      }
                                      else
                                      {
                                        ?>
                                          <img class="chckbx" src="forms/profpic-uploads/unchecked.png" alt="unchecked">
                                        <?php
                                      }
                                     ?>
                                  </span>

                                  <!-- FILE ATTACHMENT DIVISION -->
                                  <div class="fileAttached" style="padding-left: 5%; width:100%">
                                    <ul style="list-style-type: none;">

                                      <li style="display: inline;">
                                        <!-- ICON -->

                                        <!-- NAME OF REPORT -->
                                        <?php
                                         if($row['report_sample']?? null !== null)
                                         { ?>
                                          <a class="report_name" style="font-size: 15px; padding:10px;" href="reportsView.php?id=<?php echo $row["report_id"]; ?>">
                                            <i class='fas fa-file' style='font-size:15px; padding-bottom: 3px'></i>
                                            Sample <?php echo $row['report_title'] ?></a>
                                          <?php
                                         }
                                         else
                                         {
                                          ?>
                                            <i class='fas fa-times' style='font-size:15px; padding-bottom: 3px'></i>No Submission
                                          <?php
                                         } ?>


                                      </li>

                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                        <?php
                        }
                        ?>
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

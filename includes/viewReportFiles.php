<!DOCTYPE html>
<?php session_start();
include('autoloader.inc.php');

$exp = "/Principal/";
if($_SESSION['status']  != 'Administrator' AND !preg_match($exp, $_SESSION['designation']))
{
  header("Location: forms/logout.form.php");
  exit();
}
date_default_timezone_set('Asia/Manila');
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
      <?php
          $obj = new Reports();
          $rep = $obj->getSpecificReport($_GET['id']);
       ?>
      <div></div>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">
                  <h1 id="hdr" class="mt-4"><?php echo $rep['report_title'] ?></h1>
                  <h4>Description: <?php echo $rep['report_description'] ?></h3>
                  <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                      <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item active"><a href="reportFiles.php">ReportFiles</a></li>
                      <li class="breadcrumb-item active"><?php echo $rep['report_title'] ?></li>
                  </ol>
                  <div class = "report-main" style= "">
                    <div class="spacing" style="">
                  </div>

                    <div class="list_content" style="position: relative; ">
                      <ul class="report_list" style="list-style-type: none;">

                        <table class="table" id="dataTable" width="100%">
                          <col style="width:70%">
                          <col style="width:30%">

                            <thead>
                                <tr>
                                  <th style="padding-left:10%;"><i class='fas fa-user' style='font-size:15px;'></i> Submitted by</th>
                                  <th><i class='fas fa-calendar-alt' style='font-size:15px'></i> Date of Submission</th>
                                </tr>
                            </thead>

                            <tbody>
                              <?php
                              $obj = new Reports();
                              $result = $obj->getSpecificReport($_GET['id']);
                              $res;
                              if($_SESSION['status']  == 'Administrator')
                              {
                                $res = $obj->getSubmittedReports($_GET['id']);
                              }
                              else
                              {
                                $res = $obj->getSubmittedSchoolReports($_GET['id'], $_SESSION['station']);
                              }


                                //LOOP FOR REPORTS LIST (DEPENDENT TO THE DATA OF REPORTS TO BE SUBMITTED)
                                while($row = mysqli_fetch_array($res))
                                {

                              ?>
                                  <!-- LIST result -->
                                  <tr>
                                    <td><li>
                                      <div class="list_div" style="width: 100%; height: 10%; padding-bottom: 20px; " >
                                        <!-- NAME DIV -->


                                          <!-- LINK TO REPORT SUBMISSION PHP -->
                                            <!-- ICON -->
                                            <i class="icn fas fa-user" style='font-size:25px; padding-bottom: 3px'></i>
                                            <!-- NAME OF REPORT -->
                                            <span id="title" ><?php echo $row['l_name'].', '.$row['f_name'].' '.$row['m_name']?></span><br>
                                            <span id="info" ><?php echo "\n\t". $row['station'].' ('.$row['designation'].')' ?></span>

                                          <div class="report_info">

                                            <!-- FILE ATTACHMENT DIVISION -->
                                            <div class="fileAttached" style="">
                                              <ul style="list-style-type: none;">

                                                <li style="display: inline;">
                                                  <!-- ICON -->

                                                  <!-- NAME OF REPORT -->
                                                  <?php
                                                  if($row['file_name']?? null !== null)
                                                  { ?>
                                                    <a class="report_name file_ext" style="font-size: 15px; padding:10px;"
                                                      href='forms/Reports/<?php echo $rep['report_title']
                                                      .'/'.$row['file_name'].$row['file_type']?>'>
                                                      <i class='fas fa-file' style='font-size:15px; padding-bottom: 3px'></i>
                                                      Submission: <?php echo $row['file_name'].$row['file_type'] ?></a>
                                                    <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <a href="#"><i class='fas fa-times file_ext' style='font-size:15px; padding-bottom: 3px'></i>
                                                       No Submission</a>
                                                    <?php
                                                  }
                                                     ?>


                                                </li>

                                              </ul>
                                            </div>
                                          </div>

                                      </div>
                                    </li>
                                  </td>

                                    <td>

                                    <?php
                                    if($row['date_submitted'] != null)
                                    {
                                      echo date('Y-M-d' , strtotime($row['date_submitted']));
                                      echo '</div>';
                                    }
                                     ?>


                                   </td>
                                  </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

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

    </body>
</html>

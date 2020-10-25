<?php

session_start();

include('autoloader.inc.php'); ?>

!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <meta name="description" content="" />

        <meta name="author" content="" />

        <title>McArthurII District Requests</title>

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

                  <h1 class="mt-4">Requests</h1>

                  <ol style = "background-color:#86B898" class="breadcrumb mb-4">

                      <li class="breadcrumb-item active">Requests</li>

                      <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>

                  </ol>

                  <div class ="requests">

                    <!--REQUESTS TABLE-->

                  <div style = "width:100%; height:420px; overflow-x: auto">

                    <table style='width:100%;' class='display table table-hover center' cellspacing='0'>

                      <thead>

                        <tr style="text-align: center; vertical-align: middle;">

                          <th><input type="checkbox" class="checkAll"> Select all</input></th>

                          <th>NAME</th>

                          <th>DESIGNATION</th>

                          <th>GRADE/SUBJECT</th>

                          <th>SCHOOL</th>

                        </tr>

                      </thead>

                      <tbody>

                        <?php

                          date_default_timezone_set('Asia/Manila');

                          // DATA ROW LOOP MUST BE DEPENDENT ON THE DATA AVAILABLE ON THE REQUESTS DATA TABLE

                          for($i= 20; $i > 0; $i--)

                          {

                        ?>

                            <tr>

                              <!-- CHECKBOX COLUMN -->

                              <td style="text-align: center; vertical-align: middle;"><input type="checkbox" class="check"></input></td>

                              <!-- NAME DATA COLUMN -->

                              <td style="text-align: center; vertical-align: middle;">

                                DWYANE WADE

                              </td>

                              <!-- DESIGNATION DATA COLUMN -->

                              <td style="text-align:center; vertical-align: middle;">

                                DESIGNATION DATA SAMPLE

                              </td>

                              <!-- GRADE/SUBJECT DATA COLUMN -->

                              <td style="text-align:center; vertical-align: middle;">

                                GRADE/SUBJECT DATA SAMPLE

                              </td>

                              <!-- SCHOOL DATA COLUMN -->

                              <td style="text-align:center; vertical-align: middle;">

                                SCHOOL DATA SAMPLE

                              </td>

                            </tr>

                          <?php  

                          }

                          ?>

                      </tbody>

                    </table>

                  </div>

                    

                    <div style = "position: static; display:flex; justify-content:center;" name="buttonDiv">

                        <button type='submit' value='submit' name='submitReport' class='btn btn-primary' style="width:45%; height:100%; background:red">DECLINE</button>

                        <button type='submit' value='submit' name='submitReport' class='btn btn-primary' style="width:45%; height:100%;">ACCEPT</button>

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

        <!-- SCRIPT FOR SELECT ALL CHECKBOX -->

        <script>

          $(function()

            {

                $('.checkAll').click(function()

                {

                    $('.check').prop('checked', this.checked)

                })

            })

        </script>

    </body>

</html>

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
        <title>Dashboard - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dashboard.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <!-- events script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </head>
    <body class="sb-nav-fixed" onresize = "setHeight()">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div></div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-auto">

                      <div id="head">
                        <?php
                         $conn = mysqli_connect("localhost", "root", "", "mddb");

                         $obj = new ProfilePic();
                         $result = $obj->get_profile($_SESSION['user_id']);
                            $row = mysqli_fetch_array($result);
                              if($row != null)
                               {
                         ?>
                                  <img class = "card-container" src="imageView.php?user_id=<?php echo $row["user_id"]; ?>" />
                         <?php
                               }

                               else
                               {
                         ?>
                                  <img class = "card-container">
                         <?php
                               }
                                 mysqli_close($conn);
                          ?>

                        <div class = "user-name">
                            <h2><?php echo $_SESSION['user_fname']." ".$_SESSION['user_mname']." ".$_SESSION['user_lname']; ?></h2>
                            <h4><?php echo $_SESSION['designation'] ?></h4>
                        </div>
		                    </div>





                        <div class="contact">
                          <?php
                              $obj = new AddInfo();
                              $info = $obj->getAddInfo($_SESSION['user_id']);

                           ?>
                          <ul>
                            <div class="icon">
                              <i class="fas fa-phone"> </i> Phone Number &nbsp;&nbsp;&nbsp;&nbsp;
                              <span>: <?php echo $info['contact_num']?? '' ?></span>
                            </div>

                            <div class="icon">
                              <i class="fas fa-envelope"> </i> Email Address :
                              <span><?php echo $_SESSION['user_email']?? '' ?></span>
                            </div>
                          </ul>

                        </div>

                        <div class="contact">
                          <ul>
                            <div class="icon">
                              <i class = "fab fa-facebook-f"> </i> &nbsp;Facebook Account
                              <span> : <?php echo $info['fb_acct']?? '' ?></span>
                            </div>

                            <div class="icon">
                              <i class = "fas fa-atom"> </i> &nbsp;Grade/Subject :
                              <span><?php echo $info['grade']?? '' ?></span>
                            </div>
                          </ul>
                        </div>
                        <div class="underline" >
                          <hr></hr>
                        </div>
                        <div class="signboard">
                          <div class="tag" id = "ann">
                            <u>Announcements</u>
                          </div>
                          <div class="tag" id = "side">
                            <u>Sideboard</u>
                          </div>
                        </div>

                        <div class="sideline" id = "sideone">
                            <div class="tag" style="width:100%;margin-bottom:20px;">
                              <u>Events</u>
                            </div>
                            <div class="event-cont">
                              <ul>
                                <?php
                                  $obj = new Events();
                                  $result = $obj->getEvents();

                                  while($row = mysqli_fetch_array($result))
                                  {
                                    echo "<a class=link href=viewEvent.php?id=".$row['id']."><i class='fas fa-table'></i> ".$row['title']."</a>";
                                  }

                                 ?>
                              </ul>

                            </div>

                        </div>

                        <?php
                          $newObj = new Announcement();
                          $user = new User();

                          $ann = $newObj->getAnn();
                          while($row = mysqli_fetch_array($ann))
                          {
                            $creator = $user->idChecker($row['user_id']);
                        ?>
                        <div class="content" id = "content-box">
                            <div class="ann-tag">
                              <div class="ann-icon">
                                <i class = "fas fa-bullhorn"> </i> Announcement :
                                <span><?php echo $row['title'] ?></span>
                              </div>
                              <div class="ann-mini">
                                <i class = "fas fa-user"> </i> Created by :
                                <span><a href="Profile.php?id=<?php echo $row['user_id'] ?>">
                                  <?php echo $creator['f_name']." ".$creator['l_name'];?></a></span>
                              </div>
                            </div>
                            <div class="body">
                              <p><?php echo $row['description'] ?></p>
                            </div>
                            <div class="img">
                              <img class = "main" src="annImgView.php?id=<?php echo $row["id"]; ?>"  id="blah" src="#" alt="your image" onerror="showImg();"/>
                              <script>
                                function showImg()
                                {
                                  document.getElementById("blah").style.display = "none";
                                }
                              </script>

                            </div>
                        </div>

                        <?php
                          }
                         ?>
                      </div>


                </main>
              <?php include('footer.php') ?>
            </div>
            <!-- js for the events -->
        <script type="text/javascript" src="js/eventcopy.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script src="js/dashboard.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>

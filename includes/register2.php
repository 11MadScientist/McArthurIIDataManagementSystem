<?php
  session_start();
  include('autoloader.inc.php');
  if($_SESSION['user_id'] == null)
  {
    header("Location: login.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register2</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href ="css/lee.css" rel = "stylesheet"/>

        <link href ="css/register2.css" rel = "stylesheet"/>
        <script src="js/selecttag.js"></script>
        <script src="js/dropdown.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="backgound">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Now for the Confidential stuff</h3></div>
                                    <?php
                                        if(isset($_GET['error']))
                                        {
                                            if($_GET['error'] == "nodesignation")
                                            {
                                              echo '<p class="error">Please choose a position!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidContactNumber")
                                            {
                                              echo '<p class="error">Please follow number format 0##-####-####!</p>';
                                            }
                                            elseif($_GET['error'] == "noCivilStatus")
                                            {
                                              echo '<p class="error">Please choose Civil Status!</p>';
                                            }

                                        }

                                     ?>

                                    <div class="card-body" >
                                      <div class="group">
                                        <div class="text">
                                          <form action="forms/registration2.form.php" method="post" enctype="multipart/form-data">
                                            <label class = "pic-lbl" >Upload Profile Picture</label>
                                             <input class = "input" name="img-profile" type="file"  required>
                                             <button class = "button" type="submit" name="img-submit">UPLOAD IMAGE</button>
                                          </form>
                                        </div>

                                        <div class="images">
                                          <?php
                                           if(isset($_GET['success']))
                                           {
                                                $conn = mysqli_connect("localhost", "root", "", "mddb");

                                                $obj = new ProfilePic();
                                                $result = $obj->get_profile($_SESSION['user_id']);

     	                                          while($row = mysqli_fetch_array($result))
                                                {
                                          ?>
     		                                           <img class = "image" src="imageView.php?user_id=<?php echo $row["user_id"]; ?>" />
                                          <?php
     	                                          }
                                                 mysqli_close($conn);

                                           }
                                           else
                                           {
                                             echo '<img class = "image" src="forms/profpic-uploads/unknown.jpg">';
                                           }
                                           ?>

                                        </div>
                                      </div>



                                      <!-- this is the start of the form-->
                                        <form action= "forms/registration2.form.php" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">School/Station</label>
                                                        <!--name of school user is in-->
                                                        <?php
                                                            if(isset($_GET['station']))
                                                            {
                                                                $station = $_GET['station'];
                                                                echo '<input class="form-control py-4" value = "'.$station.'" name = "station" id="inputFirstName" type="text" placeholder="Enter School Stationed" required />';
                                                            }
                                                            else
                                                            {
                                                                echo '<input class="form-control py-4" name = "station" id="inputFirstName" type="text" placeholder="Enter School Stationed" required />';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Major</label>
                                                        <!--his major subject-->
                                                        <?php
                                                            if(isset($_GET['major']))
                                                            {
                                                                echo '<input value = "'.$_GET['major'].'" class="form-control py-4" name = "major" id="inputLastName" type="text" placeholder="Enter Major" required/>';
                                                            }
                                                            else
                                                            {
                                                                echo '<input class="form-control py-4" name = "major" id="inputLastName" type="text" placeholder="Enter Major" required/>';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label class="small mb-1" for="inputLastName">Highest Educational Attainment</label>
                                                      <!--his major subject-->
                                                      <?php
                                                          if(isset($_GET['highesteducattn']))
                                                          {
                                                              echo '<input value = "'.$_GET['highesteducattn'].'" class="form-control py-4" name = "high-educ" id="inputLastName" type="text" placeholder="Enter highest attainment" required/>';
                                                          }
                                                          else
                                                          {
                                                              echo '<input class="form-control py-4" name = "high-educ" id="inputLastName" type="text" placeholder="Enter highest attainment" required/>';
                                                          }
                                                       ?>

                                                  </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Date of Birth</label>
                                                        <!--date of birth-->
                                                        <?php
                                                            if(isset($_GET['dateofbirth']))
                                                            {
                                                                echo '<input value = "'.$_GET['dateofbirth'].'" type="date" class="form-control py-4" name = "dateofbirth" id="inputConfirmPassword"  placeholder="Enter date of birth" required/>';
                                                            }
                                                            else
                                                            {
                                                                echo '<input type="date" class="form-control py-4" name = "dateofbirth" id="inputConfirmPassword"  placeholder="Enter date of birth" required/>';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Contact Number</label>
                                                        <!--contact number-->
                                                        <?php
                                                            if(isset($_GET['contactnum']))
                                                            {
                                                                echo '<input value = "'.$_GET['contactnum'].'" type="tel" class="form-control py-4" name = "contact-num" id="inputPassword" placeholder="use format: 0##-####-####" required/>';
                                                            }
                                                            else
                                                            {
                                                                echo '<input type="tel" class="form-control py-4" name = "contact-num" id="inputPassword" placeholder="use format: 0##-####-####" required/>';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">FB UserName</label>
                                                        <!--fb username-->
                                                        <?php
                                                            if(isset($_GET['fbacct']))
                                                            {
                                                                echo '<input value = "'.$_GET['fbacct'].'" type="text" class="form-control py-4" name = "fb-username" id="inputConfirmPassword"  placeholder="Enter FB UserName" required/>';
                                                            }
                                                            else
                                                            {
                                                                echo '<input type="text" class="form-control py-4" name = "fb-username" id="inputConfirmPassword"  placeholder="Enter FB UserName" required/>';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                            </div>

                                                <div class="form-row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                        <div class="demo">
                                                            <label for="position" style="font-size: 80%;">Choose a Position:</label>
                                                            <div class="dropdown-container">
                                                              <?php
                                                                  if(isset($_GET['desig']))
                                                                  {
<<<<<<< HEAD
                                                                      echo '
                                                                      <select name = "desig" id = "position" required>
                                                                        <option disabled hidden>Choose here</option>
                                                                        <option value="teacher">Teacher</option>
                                                                        <option value="principal">Principal</option>
                                                                        <option value="supervisor">Supervisor</option>
                                                                        </select>
                                                                        <script>
                                                                        function myFunction()
                                                                        {
                                                                          document.getElementById("position").value = "'.$_GET['desig'].'";
                                                                        }
                                                                        myFunction();
                                                                        </script>
                                                                        ';
=======
                                                                      if($_GET['desig'] != null)
                                                                      {
                                                                        if($_SESSION['level'] == "teacher")
                                                                        {
                                                                          echo '<select value = "'.$_GET['desig'].'" name = "desig" id = "position" required>
                                                                            <option value="Teacher I"></option>
                                                                            <option value="Teacher II"></option>
                                                                            <option value="Teacher III"></option>
                                                                            <option value="Master Teacher I"></option>
                                                                            <option value="Master Teacher II"></option>
                                                                            <option value="Master Teacher III"></option>
                                                                            <option value="Head Teacher I"></option>
                                                                            <option value="Head Teacher II"></option>
                                                                            <option value="Head Teacher III"></option>
                                                                            </select>';
                                                                        }
                                                                        elseif($_SESSION['level'] == "principal")
                                                                        {
                                                                          echo '<select value = "'.$_GET['desig'].'" name = "desig" id = "position" required>
                                                                            <option value="Principal I"></option>
                                                                            <option value="Principal II"></option>
                                                                            </select>';
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        if($_SESSION['level'] == "teacher")
                                                                        {
                                                                          echo '<select name = "desig" id = "position" required>
                                                                            <option value="Teacher I"></option>
                                                                            <option value="Teacher II"></option>
                                                                            <option value="Teacher III"></option>
                                                                            <option value="Master Teacher I"></option>
                                                                            <option value="Master Teacher II"></option>
                                                                            <option value="Master Teacher III"></option>
                                                                            <option value="Head Teacher I"></option>
                                                                            <option value="Head Teacher II"></option>
                                                                            <option value="Head Teacher III"></option>
                                                                            </select>';
                                                                        }
                                                                        elseif($_SESSION['level'] == "principal")
                                                                        {
                                                                          echo '<select name = "desig" id = "position" required>
                                                                            <option value="Principal I"></option>
                                                                            <option value="Principal II"></option>
                                                                            </select>';
                                                                        }
                                                                      }

>>>>>>> dashboard
                                                                  }
                                                                  else
                                                                  {
                                                                    if($_SESSION['level'] == "teacher")
                                                                    {
                                                                      echo '<select name = "desig" id = "position" required>
                                                                        <option value="Teacher I"></option>
                                                                        <option value="Teacher II"></option>
                                                                        <option value="Teacher III"></option>
                                                                        <option value="Master Teacher I"></option>
                                                                        <option value="Master Teacher II"></option>
                                                                        <option value="Master Teacher III"></option>
                                                                        <option value="Head Teacher I"></option>
                                                                        <option value="Head Teacher II"></option>
                                                                        <option value="Head Teacher III"></option>
                                                                        </select>';
                                                                    }
                                                                    elseif($_SESSION['level'] == "principal")
                                                                    {
                                                                      echo '<select name = "desig" id = "position" required>
                                                                        <option value="Principal I"></option>
                                                                        <option value="Principal II"></option>
                                                                        </select>';
                                                                    }
                                                                  }
                                                               ?>

                                                              <div class="select-icon">
                                                                <svg focusable="false" viewBox="0 0 104 128" width="25" height="35" class="icon">
                                                                  <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
                                                                </svg>
                                                              </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                    <div class="col-md-6">
                                                      <div class="demo">
                                                          <label for="position" style="font-size: 80%;">Civil Status:</label>
                                                          <div class="dropdown-container">
                                                            <?php
                                                                if(isset($_GET['civilstatus']))
                                                                {
                                                                    echo '<select value = "'.$_GET['civilstatus'].'" name = "civil-stat" id = "civil" required>
                                                                            <option disabled hidden>Choose here</option>
                                                                            <option value="teacher">Single</option>
                                                                            <option value="principal">Married</option>
                                                                          </select>
                                                                          <script>
                                                                          function myFunction()
                                                                          {
                                                                            document.getElementById("civil").value = "'.$_GET['civilstatus'].'";
                                                                          }
                                                                          myFunction();
                                                                          </script>
                                                                          ';
                                                                }
                                                                else
                                                                {
                                                                  echo '<select name = "civil-stat" id = "position" required>
                                                                          <option selected disabled hidden>Choose here</option>
                                                                          <option value="teacher">Single</option>
                                                                          <option value="principal">Married</option>
                                                                        </select>';
                                                                }
                                                             ?>

                                                            <div class="select-icon">
                                                              <svg focusable="false" viewBox="0 0 104 128" width="25" height="35" class="icon">
                                                                <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
                                                              </svg>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Date of Original Appointment</label>
                                                        <!--date of original appointment-->
                                                        <?php
                                                            if(isset($_GET['orig_appointment']))
                                                            {
                                                                echo '<input value = "'.$_GET['orig_appointment'].'" type="date" class="form-control py-4" name = "orig-appointment" id="inputPassword" required/>';
                                                            }
                                                            else
                                                            {
                                                                echo '<input type="date" class="form-control py-4" name = "orig-appointment" id="inputPassword" required/>';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Date of Latest Promotion</label>
                                                        <!--date of latest promotion-->
                                                        <?php
                                                            if(isset($_GET['dateofpromo']))
                                                            {
                                                                echo '<input value = "'.$_GET['dateofpromo'].'" type = "date" class="form-control py-4" name = "lat-promotion" id="inputConfirmPassword" placeholder="Confirm password" required/>';
                                                            }
                                                            else
                                                            {
                                                                echo '<input type = "date" class="form-control py-4" name = "lat-promotion" id="inputConfirmPassword" placeholder="Confirm password" required/>';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button type = "submit" value = "submit" name = "submit-registry" class="btn btn-primary btn-block" >Create Account</button></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer" style="margin-top: 20px;">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
    </html>

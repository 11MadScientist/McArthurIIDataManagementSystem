<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href ="css/lee.css" rel = "stylesheet"/>
        <link href ="css/login.css" rel = "stylesheet"/>
        <script src="js/selecttag.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="background">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5" style = "margin-bottom: 12%;">
                                    <div class="card-header">
                                      <div class="group">
                                        <div class="images">
                                         <img class = "image" src="forms/profpic-uploads/logo.png" style = "width:100px;height:100px; margin-left:20%; margin-top:10%;">
                                        </div>
                                        <div class="text">
                                          <h2 class="text-center font-weight-light my-4">Create Account</h2>
                                        </div>
                                    </div>
                                    </div>
                                    <?php
                                        if(isset($_GET['error']))
                                        {
                                            if($_GET['error'] == "invalidemailfirstnamemiddlenamelastname")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Invalid Email Address & Name must not contain any number/symbols!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidemail")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Invalid Email Address!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidfirstname")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>First Name must not contain any numbers and symbols!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidmiddlename")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Middle Name must not contain any numbers and symbols!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidlastname")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Last Name must not contain any numbers and symbols!</p>';
                                            }
                                            elseif($_GET['error'] == "passwordmissmatch")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Password does not match confirm Password!</p>';
                                            }
                                            elseif($_GET['error'] == "nullposition")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Please choose position!</p>';
                                            }
                                            elseif($_GET['error'] == "emailtaken")
                                            {
                                              echo '<p class="error"><i class = "fas fa-exclamation-triangle"></i>Email is already taken!</p>';
                                            }


                                        }
                                     ?>

                                    <div class="card-body">
                                      <!-- this is the start of the form-->
                                        <form action= "forms/registration.form.php" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <!--firstname-->
                                                        <?php
                                                            if(isset($_GET['fname']))
                                                            {
                                                                echo '<input value = "'.$_GET['fname'].'" class="form-control py-4" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />';
                                                            }
                                                            else
                                                            {
                                                                echo '<input class="form-control py-4" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputMiddleName">Middle Name</label>
                                                        <!--middle name-->
                                                        <?php
                                                            if(isset($_GET['mname']))
                                                            {
                                                                echo '<input value = "'.$_GET['mname'].'" class="form-control py-4" name = "mname" id="inputMiddleName" type="text" placeholder="Enter middle name" required/>';
                                                            }
                                                            else
                                                            {
                                                                echo '<input class="form-control py-4" name = "mname" id="inputMiddleName" type="text" placeholder="Enter Middle name" required/>';
                                                            }
                                                         ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label class="small mb-1" for="inputLastName">Last Name</label>
                                                      <!--lastname-->
                                                      <?php
                                                          if(isset($_GET['lname']))
                                                          {
                                                              echo '<input value = "'.$_GET['lname'].'" class="form-control py-4" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required/>';
                                                          }
                                                          else
                                                          {
                                                              echo '<input class="form-control py-4" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required/>';
                                                          }
                                                       ?>

                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="demo">
                                                      <label for="position" style="font-size: 80%;">Choose a Position:</label>
                                                      <div class="dropdown-container">
                                                        <?php
                                                            if(isset($_GET['level']))
                                                            {

                                                                echo '
                                                                <select name = "level" id = "position" required>
                                                                  <option disabled hidden>Choose here</option>
                                                                  <option id ="1" value="teacher">Teacher</option>
                                                                  <option id ="2" value="principal">Principal</option>
                                                                  </select>

                                                                  <script>
                                                                  function myFunction()
                                                                  {
                                                                    document.getElementById("position").value = "'.$_GET['level'].'";
                                                                  }
                                                                  myFunction();
                                                                  </script>
                                                                  ';
                                                            }
                                                            else
                                                            {
                                                              echo '<select name = "level" id = "position" required>
                                                                <option selected disabled hidden>Choose here</option>
                                                                <option value="teacher">Teacher</option>
                                                                <option value="principal">Principal</option>
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
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <!--email address-->
                                                <?php
                                                    if(isset($_GET['email']))
                                                    {
                                                        echo '<input value = "'.$_GET['email'].'" class="form-control py-4" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>';
                                                    }
                                                    else
                                                    {
                                                        echo '<input class="form-control py-4" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>';
                                                    }
                                                 ?>

                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <!--password-->
                                                        <input class="form-control py-4" name = "pass" id="inputPassword" type="password" placeholder="Enter password" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <!--firstname-->
                                                        <input class="form-control py-4" name = "confpass" id="inputConfirmPassword" type="password" placeholder="Confirm password" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button type = "submit" value = "submit" name = "submit-next" class="btn btn-primary btn-block" >Next Step</button></div>
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
            <div id="layoutAuthentication_footer">
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

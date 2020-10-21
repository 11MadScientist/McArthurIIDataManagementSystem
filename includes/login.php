<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>McArthurII District LOGIN PAGE</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href ="css/lee.css" rel = "stylesheet"/>
        <link href ="css/login.css" rel = "stylesheet"/>
        <script defer src="login-script.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="background">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                      <div class="group">
                                        <div class="images">
                                         <img class = "image" src="forms/profpic-uploads/logo.png" style = "width:100px;height:100px; margin-left:10px;">
                                        </div>
                                        <div class="text">
                                          <h2 class="text-center font-weight-light my-4">Login</h2>
                                        </div>
                                    </div>
                                    <?php
                                      if(isset($_GET['success']))
                                      {
                                        if($_GET['success'] == "signedupsuccessfully")
                                        {
                                          echo'<p class = "success"><i class="fas fa-check"></i>You have Signed Up Successfully!</p>';
                                        }
                                      }
                                      elseif(isset($_GET['error']))
                                      {
                                        if($_GET['error'] == "invalidEmail")
                                        {
                                          echo'<p class = "error"><i class = "fas fa-exclamation-triangle"></i>Invalid Email Address!</p>';
                                        }
                                        elseif($_GET['error'] == "nosuchemail")
                                        {
                                          echo'<p class = "error"><i class = "fas fa-exclamation-triangle"></i>There is no user with such email!</p>';
                                        }
                                        elseif($_GET['error'] == "incorrectPassword")
                                        {
                                          echo'<p class = "error"><i class = "fas fa-exclamation-triangle"></i>Password is incorrect!</p>';
                                        }
                                        elseif($_GET['error'] == "notActivated")
                                        {
                                          echo'<p class = "error"><i class = "fas fa-exclamation-triangle"></i>Account not yet Activated!</p>';
                                        }
                                      }

                                     ?>
                                    <div class="card-body">
                                      <!--Start of the form-->
                                        <form name = "loginform" id = "login-form" action="forms/login.form.php" method="post" onsubmit="return validateForm()" required>
                                            <div class="form-group" id = "email-error">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <!--Email address textbox-->
                                                <?php
                                                    if(isset($_GET['email']))
                                                    {
                                                        echo '<input value = "'.$_GET['email'].'" class="form-control py-4" name = "email" id="inputEmailAddress" type="email" placeholder="Enter email address" required />';
                                                    }
                                                    else
                                                    {
                                                        echo '<input class="form-control py-4" name = "email" id="inputEmailAddress" type="email" placeholder="Enter email address" required />';
                                                    }
                                                 ?>

                                            </div>
                                            <div class="form-group" id = "email-error">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <!--password textbox-->
                                                <input class="form-control py-4" name = "pass" id="inputPassword" type="password" placeholder="Enter password" required/>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Forgot Password?</a>
                                                <!--Button type to send the form-->
                                                <button type = "submit" value = "submit" name = "login-user" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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
                            <div class="text-muted">Copyright &copy; McArthurII District 2020</div>
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

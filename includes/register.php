<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href ="css/lee.css" rel = "stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <?php
                                        if(isset($_GET['error']))
                                        {
                                            if($_GET['error'] == "invalidemailfirstnamelastname")
                                            {
                                              echo '<p class="error">Invalid Email Address & Name must not contain any number/symbols!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidemail")
                                            {
                                              echo '<p class="error">Invalid Email Address!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidfirstname")
                                            {
                                              echo '<p class="error">First Name must not contain any numbers and symbols!</p>';
                                            }
                                            elseif($_GET['error'] == "invalidlastname")
                                            {
                                              echo '<p class="error">Last Name must not contain any numbers and symbols!</p>';
                                            }
                                            elseif($_GET['error'] == "passwordmissmatch")
                                            {
                                              echo '<p class="error">Password does not match confirm Password!</p>';
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
                                                        <input class="form-control py-4" name = "fname" id="inputFirstName" type="text" placeholder="Enter first name" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <!--lastname-->
                                                        <input class="form-control py-4" name = "lname" id="inputLastName" type="text" placeholder="Enter last name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <!--email address-->
                                                <input class="form-control py-4" name = "email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>
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

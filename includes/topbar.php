
<nav style="background-color:#03C04A" id = "topbar" class="sb-topnav navbar navbar-expand navbar-dark background">
    <a class="navbar-brand" href="dashboard.php">MDDMS</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input style="margin-top:3%;" class="form-control" type="text" placeholder="Teacher information..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="Profile.php">Profile</a>
                <a class="dropdown-item" href="changePass.php">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="forms/logout.form.php">Logout</a>
            </div>
        </li>
    </ul>
</nav>

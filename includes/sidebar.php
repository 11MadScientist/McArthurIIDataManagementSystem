
<div id="layoutSidenav">
    <div id="layoutSidenav_nav" style="margin-bottom:-20px;">
        <nav style="background-color:#1F5C2E" class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">
                      <img class = "image" src="forms/profpic-uploads/logo.png" style = "width:120px;height:120px; margin-left:20px;">
                    </div>
                    <div style="color:white;" class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="attendance.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Attendance
                    </a>
                    <div style="color:white;" class="sb-sidenav-menu-heading">Information</div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Work
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                          <a class="nav-link" href="Announcements.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                              Announcements
                          </a>
                          <a class="nav-link" href="Events.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                              Events
                          </a>
                          <a class="nav-link" href="Reports-main.php">
                              <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                              Reports
                          </a>
                        </nav>
                    </div>

                    <?php
                      if($_SESSION['status']  == 'Administrator')
                      {
                        echo '  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Administrator
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                              <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="Requests.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                                    Requests
                                </a>
                                <a class="nav-link" href="Personnel.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
                                    Personnel
                                </a>
                                <a class="nav-link" href="Monitoring.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                    Monitoring
                                </a>
                                <a class="nav-link" href="LeaveRequests.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                    LeaveRequests
                                </a>
                              </nav>
                          </div>
                          ';
                      }
                     ?>


                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                McArthurII District
            </div>
        </nav>
    </div>

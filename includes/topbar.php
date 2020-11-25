<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

<script src="js/scripts.js"></script>
<nav style="background-color:#03C04A;" id = "topbar" class="sb-topnav navbar navbar-expand navbar-dark background">
    <a class="navbar-brand" href="dashboard.php">MDDMS</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <!-- <input style="margin-top:3%;" class="form-control" type="text" placeholder="Teacher information..." aria-label="Search" aria-describedby="basic-addon2" /> -->
            <div class="input-group-append">
                <!-- <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button> -->
            </div>
        </div>
    </form>
    <!-- NOTIFICATION HEADER -->
    <ul class="navbar-nav mr-auto" >
          <li class="nav-item dropdown" >
            <a class="nav-link" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications
                    <?php
                    // COUNT ALL UNREAD NOTIFICATIONS
                    $objNotif = new Notifications();
                    $id = $_SESSION['user_id'];
                    $query = "SELECT * from `notifications` where `status` = 'unread' and `user_id` = $id order by `date` DESC";
                    if(count($objNotif->fetchAll($query))>0){
                    ?>
                    <span class="badge badge-light"><?php echo count($objNotif->fetchAll($query)); ?></span>
                    <?php
                    }

                        ?>
            </a>

            <!-- DROPDOWN LIST -->
            <div class="dropdown-menu" aria-labelledby="dropdown01" style="overflow-x: auto; height:400px"  id="notifList">
                <?php
                $objNotif = new Notifications();
                $id = $_SESSION['user_id'];
                $query = "SELECT * from `notifications` where `user_id` = $id order by `date` DESC";
                 if(count($objNotif->fetchAll($query))>0){
                     foreach($objNotif->fetchAll($query) as $i){
                         ?>
              <a style ="
                         <?php
                            if($i['status']=='unread'){
                                echo "font-weight:bold;";
                            }
                         ?>
                         " class="dropdown-item" onclick="updateNotif()"
                         <?php
                            echo "id=".$i['id'];
                            if($i['type']=='announcement')
                                echo "\nhref=viewAnn.php?id=".$i['type_id'];
                            else if($i['type']=='event')
                                echo "\nhref=viewEvent.php?id=".$i['type_id'];
                            else if($i['type']=='report')
                                echo "\nhref=reports.php?id=".$i['type_id'];
                         ?>
                >
                    <small><i><?php echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                    <?php

                    if($i['type']=='announcement')
                        echo "New Announcement";
                    else if($i['type']=='event')
                        echo "New Event";
                    else if($i['type']=='report')
                        echo "New Report";
                    ?>
                </a>
                <div class="dropdown-divider"></div>
                <?php
                    }
                 }
                 else
                 {
                     echo "No Notifications";
                 }
                ?>
            </div>
          </li>
    </ul>

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

<script>
    $(document).ready(function(){
        $('a.dropdown-item').on('click',function(){
            var id = this.id;
            $.post('updateNotif.php' ,{
                newID: id
            })
        });
    });
</script>

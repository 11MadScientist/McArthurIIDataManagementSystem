<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>McArthurII District Calendar</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/lee.css" type="text/css" rel="stylesheet" />
        <link href="css/buttons.css" type="text/css" rel="stylesheet" />
        <!-- this is the css of the calendar -->
        <link rel="stylesheet" href="fullcalendar/css/calendar.css">
        <!-- calendar links and scripts -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
      <?php
        include('topbar.php');
            include('sidebar.php');
       ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Calendar</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Calendar</li>
                        </ol>

                          <a class="button gotocalendar" href = "fullcalendar/index.php">Go to Calendar</a>
                          <a class="button schedule">Schedule an Event</a>

                    </div>
                    <!-- this is the calendar html -->


              </main>
            <?php
              include('footer.php');
            ?>
         </div>
    </body>
</html>

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
        <link href="css/lee.css" rel="stylesheet" />

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
                    </div>
                  <div style="margin: auto; width: 50%; border: 3px solid green; padding: 10px;">
                    <?php
                    /* draws a calendar */
                    function draw_calendar($month,$year)
                    {

                        /* draw table */
                          $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

                          /* table headings */
                          $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
                          $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

                          /* days and weeks vars now ... */
                          $running_day = date('w',mktime(0,0,0,$month,1,$year));
                          $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
                          $days_in_this_week = 1;
                          $day_counter = 0;
                          $dates_array = array();

                          /* row for week one */
                          $calendar.= '<tr class="calendar-row">';

                          /* print "blank" days until the first of the current week */
                          for($x = 0; $x < $running_day; $x++):
                            $calendar.= '<td class="calendar-day-np"> </td>';
                            $days_in_this_week++;
                            endfor;

                            /* keep going with days.... */
                            for($list_day = 1; $list_day <= $days_in_month; $list_day++):
                              $calendar.= '<td class="calendar-day">';
                              /* add in the day number */
                              $calendar.= '<div class="day-number">'.$list_day.'</div>';

                              /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
                              $calendar.= str_repeat('<p> </p>',2);

                              $calendar.= '</td>';
                              if($running_day == 6):
                                $calendar.= '</tr>';
                                if(($day_counter+1) != $days_in_month):
                                  $calendar.= '<tr class="calendar-row">';
                                endif;
                                $running_day = -1;
                                $days_in_this_week = 0;
                              endif;
                              $days_in_this_week++; $running_day++; $day_counter++;
                            endfor;

                            /* finish the rest of the days in the week */
                            if($days_in_this_week < 8):
                              for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                                $calendar.= '<td class="calendar-day-np"> </td>';
                              endfor;
                            endif;

                            /* final row */
                            $calendar.= '</tr>';

                            /* end the table */
                            $calendar.= '</table>';

                            /* all done, return result */
                            return $calendar;
                          }
                          /*date extraction*/
                          $month = date('M');
                          $year = date('Y');
                          /* Date input */
                          echo '<h2>'.$month." ".$year.'</h2>';
                          echo draw_calendar(date('m'),date('Y'));
                     ?>
                  </div>
              </main>
            <?php
              include('footer.php');
            ?>
         </div>
    </body>
</html>

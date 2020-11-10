<!DOCTYPE html>
<?php   session_start();
  include('autoloader.inc.php');
  date_default_timezone_set('Asia/Manila');?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>McArthurII District Reports</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/reports.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <style>
           .file_drag_area
           {
                width:100%;
                height:67%;
                border:5px dashed #ccc;
                line-height:400px;
                text-align:center;
                font-size:20px;
                position:absolute;
                top:100px;
                z-index:1;
                background:white;
           }
           .file_drag_over
           {
                color:#000;
                border-color:#000;
           }
           .hide
           {
            transform: translateX(-9999px);
           }
        </style>
    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">
                <h1 class="mt-4">Reports Submission</h1>
                <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="reports-main.php">Reports</a></li>
                    <li class="breadcrumb-item active">Report Submission</li>
                </ol>

                <?php $obj = new Reports();
                      $result=$obj->getSpecificReport($_GET['id']);
                      $indv = $obj->getSubmittedReport($_SESSION['user_id'], $result['report_id']);
                 ?>

                <!-- DESCRIPTION AREA -->
                <div class="reportDescription">
                  <h2 id="hd"><?php echo $result['report_title'] ?></h2>
                  <p class="deadline">Dealine: <?php echo
                  date('M d, h:i:sa', strtotime($result['deadline_date']))?></p>
                  <p id="desc" >Description: <?php echo $result['report_description'] ?></p>


                  <ul style="list-style-type: none;">

                    <!-- TO DISPLAY HORIZONTALLY -->
                    <li style="display: inline;">
                      <!-- ICON -->
                      <?php if($result['report_sample']?? null !== null){ ?>
                        <a class="report_name" style="font-size: 15px; padding:10px;" href="reportsView.php?id=<?php echo $result["report_id"]; ?>">
                          <i class='fas fa-file' style='font-size:15px; padding-bottom: 3px'></i>
                          Sample <?php echo $result['report_title'] ?></a>
                        <?php } ?>
                    </li>

                  </ul>
                </div>


                <div class = "submitted_reports" style="position: relative;">
                    <h1 id="timeheader">Reports Submitted</h1>
                    <?php
                        if(isset($indv['date_submitted']))
                        {
                          $date1 = date_create($result['deadline_date']);
                          $date2 = date_create($indv['date_submitted']);
                          $diff=date_diff($date2, $date1);
                          $ontime;
                          if($diff->format("%R%a days")[0] == '-')
                          {
                            $tick = str_replace('-','',$diff->format("The report was submitted %R%a days, %h Hours %i Minutes late")) ;
                            $ontime = false;
                          }
                          else
                          {
                            $tick = str_replace('+','',$diff->format("The report was submitted %R%a days, %h Hours %i Minutes early"));
                            $ontime = true;
                          }
                        }
                        else
                        {
                          $date1 = date_create($result['deadline_date']);
                          $date2 = date_create(date('Y-m-d H:i:s'));
                          $diff = date_diff($date2, $date1);
                          $tick;
                          if($diff->format("%R%a days")[0] == '-')
                          {
                            $tick = str_replace('-','',$diff->format("The report has been overdue by: %R%a days, %h Hours %i Minutes")) ;
                            $ontime = false;
                          }
                          else
                          {
                            $tick = str_replace('+','',$diff->format("%R%a days, %h Hours %i Minutes until deadline"));
                            $ontime = true;
                          }
                        }
                        if($ontime === true)
                        {
                          echo '<p id = "time">'.$tick.'</p>';
                        }
                        elseif($ontime === false)
                        {
                          echo '<p id = "xtime">'.$tick.'</p>';
                        }
                     ?>


                    <!-- DRAG AND DROP BOX -->
                    <div class="file_drag_area" id="drag">
                        <div class="drag"><p>Drag and Drop Files Here to Upload</p></div>
                        <img class="uploadArrow" src="forms/profpic-uploads/uploadArrow.gif" alt="">
                    </div>
                    <?php
                      if($indv['file_name']?? null != null)
                      {
                        ?>
                        <script>
                          document.getElementById("drag").style.display = "none";
                        </script>
                        <?php
                      }
                     ?>

                    <!-- Table for reports submitted -->
                    <div class = "table" style = "width:100%; height:370px; overflow-x: auto; position: relative;">
                        <table  class = "display table table-striped" cellspacing = "0" id = "tableReports" style="position: static;">
                            <thead>
                                <!-- HEADER -->
                                <th>Name</th>
                                <th>Last Modified</th>
                                <th>Size</th>
                                <th>Type</th>
                            </thead>
                            <tbody>

                                    <tr>
                                        <?php
                                          if(isset($indv['file_name']))
                                          {
                                            ?>
                                            <!-- NAME COLUMN -->
                                            <td ><a id="name" href='forms/Reports/<?php echo $result['report_title']
                                            .'/'.$indv['file_name'].$indv['file_type']?>'>
                                            <?php echo $indv['file_name'].$indv['file_type'] ?></a></td>
                                            <!-- LAST MODIFIED COLUMN -->
                                            <td><?php echo date('M d,Y h:i:sa', strtotime($indv['date_submitted'])) ?></td>
                                            <!-- SIZE COLUMN -->
                                            <td id="size"><?php echo $indv['file_size'] ?></td>
                                            <!-- TYPE COLUMN -->
                                            <td id="type"><?php echo $indv['file_type'] ?></td>
                                            <?php
                                          }
                                         ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- BUTTON AREA -->
                    <div style = "position: static; display:flex; justify-content:center;" name="buttonDiv" id="btns">

                        <form style="width:35%;margin-right:30px;  border-radius:3px;" class="" action="forms/uploadReport.form.php" method="post">
                          <input type="hidden" name="id" value= <?php echo $_SESSION['user_id'] ?>>
                          <input type="hidden" name="report_id" value=<?php echo $_GET['id'] ?>>
                          <button onclick="return warndel();" type='submit' value='submit' name='delete-rep' class='btn btn-primary' style="width:100%;margin-right:30px;  background:red; border-radius:3px;">DELETE</button>
                          <script>
                          function warndel()
                          {

                            var result = confirm("Are you sure you want to delete checked request/s?");
                            if(!result)
                            {

                                alert('Submission Canceled');
                                return false;

                            }
                          }
                          </script>
                        </form>

                        <button onclick="edit();" type='submit' value='submit' name='edit-rep' class='btn btn-primary' style="width:35%; border-radius:3px; height:100%;">EDIT</button>
                        <script>
                        function edit()
                        {
                            document.getElementById("drag").style.display = "block";
                        }
                        </script>


                    </div>
                    <?php if(isset($indv['file_name']) == null)
                          {
                    ?>
                            <script>
                              document.getElementById("btns").style.display = "none";
                            </script>
                    <?php
                          }
                          else
                          {
                            ?>
                            <script>
                              document.getElementById("btns").style.display = "flex";
                            </script>
                            <?php
                          }
                    ?>





                </div>
            </div>
          </main>
        <?php include('footer.php') ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>



        <!-- SCRIPT FOR DRAG AND DROPPING FILES TO THE BOX -->
        <script>
            $(document).ready(function(){
                // TO HIGHLIGHT THE DRAG BOX WHEN FILE IS DRAG
                $('.file_drag_area').on('dragover', function()
                {
                    $(this).addClass('file_drag_over');
                    return false;
                });

                //CHANGING IT BACK TO ORIG COLOR WHEN UNHOVERED
                $('.file_drag_area').on('dragleave', function()
                {
                    $(this).removeClass('file_drag_over');
                    return false;
                });

                // UNHIDING THE DRAG BOX DURING DRAGGING THE FILE INTO THE TABLE
                $('.table').on('dragover', function()
                {
                    $('.file_drag_area').removeClass('hide');
                    $('.file_drag_area').addClass('file_drag_over');
                    return false;
                });

                //SAVING THE FILE ON DROPPING ON THE DRAG AREA
                $('.file_drag_area').on('drop', function(e)
                {
                    // console.log(e);
                    e.preventDefault();
                    $(this).removeClass('file_drag_over');
                    $(this).addClass('hide');
                    var formData = new FormData();

                    //getting the details for the multiple files
                    //CREATES A LIST OF FILES
                    var files_list = e.originalEvent.dataTransfer.files;

                    for(var i=0; i<files_list.length; i++)
                    {
                        //files_list[i] is getting the ff:
                        // File Name: (...)
                        // lastModified: (...)
                        // lastModifiedDate: (...)
                        // name: (...)
                        // size: (...)
                        // type: (...)
                        // webkitRelativePath: (...)
                        // of each files

                        //try inspect element then console na tab then uncomment below,

                        formData.append('filesize',(files_list[i].size/1024).toFixed(2) + 'kb');
                        formData.append('file[]', files_list[i]);
                    }

                    formData.append('id', <?php echo $_SESSION['user_id'] ?>);
                    formData.append('report_id','<?php echo $_GET['id'] ?>');
                    formData.append('filename','<?php echo $result['report_title'] ?>');

                    document.getElementById("btns").style.display = "flex";

                    $.ajax({
                            // upload.php is a new file located in this same folder
                            url:"forms/uploadReport.form.php",
                            method:"POST",
                            data:formData,
                            contentType:false,
                            cache: false,
                            processData: false,
                            success:function()
                            {
                                location.reload();

                            }

                    })



                });
            });
        </script>
        <!-- SELECT ALL CHECKBOX -->

    </body>
</html>

<!DOCTYPE html>
<?php   session_start();
  include('autoloader.inc.php'); ?>
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
                 ?>

                <!-- DESCRIPTION AREA -->
                <div class="reportDescription">
                  <h2 id="hd"><?php echo $result['report_title'] ?></h2>
                  <p id="desc" style="padding-left: 20px"><?php echo $result['report_description'] ?></p>

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
                    <h1 style=" font_size = 24px">Reports Submitted</h1>
                    <!-- DRAG AND DROP BOX -->
                    <div class="file_drag_area">
                        Drag and Drop Files Here to Upload
                    </div>

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
                                        <!-- CHECHBOX COLUMN -->
                                        <!-- NAME COLUMN -->
                                        <td id="name">EOF.jpg</td>
                                        <!-- LAST MODIFIED COLUMN -->
                                        <td id = "date">02-15-20</td>
                                        <!-- SIZE COLUMN -->
                                        <td id="size">50.5kb</td>
                                        <!-- TYPE COLUMN -->
                                        <td id="type">Image (PNG)</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- BUTTON AREA -->
                    <div style = "position: static; display:flex; justify-content:center;" name="buttonDiv">
                        <button type='submit' value='submit' name='deleteReport' class='btn btn-primary' style="width:45%; height:100%; background:red">Delete</button>
                        <a href="upload.php" type='submit' value='submit' name='submitReport' class='btn btn-primary' style="width:45%; height:100%;">Submit Report</a>
                    </div>

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
                        console.log(files_list[i]);
                        document.getElementById("name").innerHTML = files_list[i].name;
                        document.getElementById("size").innerHTML = ((files_list[i].size/1024)/1024).toFixed(2) + 'mb';
                        document.getElementById("date").innerHTML = files_list[i].lastModifiedDate.getMonth() +"-"+ files_list[i].lastModifiedDate.getDate() +"-"+ files_list[i].lastModifiedDate.getFullYear();
                        document.getElementById("type").innerHTML = files_list[i].type;
                        formData.append('file[]', files_list[i]);
                    }

                    $.ajax({
                            // upload.php is a new file located in this same folder
                            url:"upload.php",
                            method:"POST",
                            data:formData,
                            contentType:false,
                            cache: false,
                            processData: false
                    })
                });
            });
        </script>
        <!-- SELECT ALL CHECKBOX -->

    </body>
</html>

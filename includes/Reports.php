<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>McArthurII District Reports</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <style>
           .file_drag_area
           {
                width:80%;
                height:250px;
                border:5px dashed #ccc;
                line-height:400px;
                text-align:center;
                font-size:20px;
                position:absolute;
                top:257px;
                z-index:1;
                background:white;
                /* visibility:show; */
           }
           .file_drag_over
           {
                color:#000;
                border-color:#000;
                /* visibility: hidden; */
           }
        </style>
    </head>
    <body class="sb-nav-fixed">
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div id="layoutSidenav_content">
          <main>
              <div class="container-fluid">
                <h1 class="mt-4">Reports</h1>
                <ol style = "background-color:#86B898" class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Reports</li>
                    <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                </ol>

                <div class = "submitted_reports">
                    <h1 style=" font_size = 24px">Reports Submitted</h1>

                    <!-- Table for reports submitted -->
                    <div class = "table" style = "width:100%; height:300px;">
                        <table  class = "display table table-striped" cellspacing = "0" id = "tableReports">
                            <thead>
                                <th style ="text-align: left"><input type="checkbox" id="checkAll"> Select all</th>
                                <th>Name</th>
                                <th>Last Modified</th>
                                <th>Size</th>
                                <th>Type</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style ="text-align: left"><input type="checkbox" class="checkItem"></td>
                                    <td>EOF.jpg</td>
                                    <td>02-15-20</td>
                                    <td>50.5kb</td>
                                    <td>Image (PNG)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                                <!-- Drag and drop box -->
                    <div class="file_drag_area">
                        Drag and Drop Files Here to Upload
                    </div>
                    <div style = "position: static; display:flex; justify-content:center;" name="buttonDiv">
                        <button type='submit' value='submit' name='submitReport' class='btn btn-primary' style="width:45%; height:100%;">Submit Report</button>
                        <button type='submit' value='submit' name='submitReport' class='btn btn-primary' style="width:45%; height:100%; background:red">Delete</button>
                    </div>
                </div>
              </div>
          </main>
        <?php include('footer.php') ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>

        <!-- SCRIPT FOR DRAG AND DROPPING FILES TO THE BOX -->
        <script>
            $(document).ready(function(){
                // CHANGING THE COLOR OF THE DRAG BOX
                $('.file_drag_area').on('dragover', function(){
                    // console.log($(this));
                    $(this).addClass('file_drag_over');
                    return false;
                });

                // $('.table').on('dragover', function(){
                //     $('.file_drag_area').style.visibility='visible';
                //     // $('.file_drag_area').addClass('file_drag_over');
                //     return false;
                // });

                //CHANGING IT BACK TO ORIG COLOR WHEN UNHOVERED
                $('.file_drag_area').on('dragleave', function(){
                    $(this).removeClass('file_drag_over');
                    return false;
                });

                //SAVING THE FILE ON DROPPING ON THE DRAG AREA
                $('.file_drag_area').on('drop', function(e){
                    e.preventDefault();
                    $(this).removeClass('file_drag_over');
                    // this.style.z-index='-1';
                    this.style.visibility='hidden';
                    // this.style.display = 'none';
                    var formData = new FormData();

                    //getting the details for the multiple files
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
                        console.log(files_list[i])
                        formData.append('file[]', files_list[i]);
                    }

                    $.ajax({
                            // upload.php is a new file located in this same folder
                            url:"upload.php",
                            method:"POST",
                            data:formData,
                            contentType:false,
                            cache: false,
                            processData: false,
                            success:function(data){
                                $('#uploaded_file').html(data);
                            }
                    })
                });
            });
        </script>

    </body>
</html>

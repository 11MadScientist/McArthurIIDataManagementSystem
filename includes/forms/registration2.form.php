<?php
$pic = $_POST['img-profile'];

echo '<img src="data:image;base64,'.base64_encode($pic).'" alt = "Image" style = "width: 100px; height:100px">';

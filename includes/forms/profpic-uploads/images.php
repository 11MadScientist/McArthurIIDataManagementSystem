<?php

$dbh = new PDO("mysql:localhost;dbname=mddb", "root", "");
$id = isset($_GET['id'])?$_GET['id']:"";
$stat = $dbh->prepare("SELECT * FROM prof_pic where user_id = ?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:'.$row['imageType']);
echo $row['data'];


// include('../../autoloader.inc.php');
//
// if(isset($_GET['id']))
// {
//   echo $_GET['id'];
//   $obj = new ProfilePic();
//   $data = $obj->get_profile($_GET['id']);
//
//   echo $imageType = $data['imageType'];
//   echo $imageData = $data['imageData'];
//
//   header("content-type:".$imageType);
//   echo $imageData;
//
// }

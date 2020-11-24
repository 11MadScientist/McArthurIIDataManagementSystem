<?php
// session_start();
include('autoloader.inc.php');

    if(isset($_POST['newID'])){
        $id = $_POST['newID'];
    
        $objNotif = new Notifications();
        $objNotif->updateNotif($id);
    }
?>

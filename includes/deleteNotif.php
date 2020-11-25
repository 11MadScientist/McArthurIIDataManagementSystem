<?php
include("autoloader.inc.php");
$id = $_POST['newId'];

$objNotif = new Notifications();
$objNotif->deleteReadNotifications($id);
?>

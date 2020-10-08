<?php
    $conn = mysqli_connect("localhost", "root", "", "mddb");
    if(isset($_GET['user_id'])) {
        $sql = "SELECT imageType,imageData FROM prof_pic WHERE user_id=" . $_GET['user_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
	}
	mysqli_close($conn);
?>

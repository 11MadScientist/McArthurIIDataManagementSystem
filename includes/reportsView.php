<?php
    $conn = mysqli_connect("localhost", "root", "", "mddb");
    if(isset($_GET['id'])) {
        $sql = "SELECT * FROM reports WHERE report_id=" . $_GET['id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);

		header("Content-disposition: attachment; filename= ".urlencode(str_replace(' ', '', $row['report_title']).'.'.$row["file_type"]));
        echo $row["report_sample"];
	}
	mysqli_close($conn);
?>

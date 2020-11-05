<?php
class Reports extends Dbh
{
  public function createReports($id, $title, $desc, $deadline)
  {
    $sql = "INSERT INTO reports(creator_id, report_title, report_description, deadline_date)
            VALUES(?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $title, $desc, $deadline]);
  }
  public function editReports($id, $creator_id, $title, $desc, $deadline)
  {
    $sql = "UPDATE reports SET creator_id=?, report_title=?, report_description=?, deadline_date=?
            WHERE report_id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$creator_id, $title, $desc, $deadline,$id]);
  }
  public function insertSample($id, $fileType, $fileData)
  {
    $conn = mysqli_connect("localhost", "root", "", "mddb");
    $sql = "UPDATE reports
    SET file_Type = '{$fileType}', report_sample = '{$fileData}'
    WHERE report_id =".$id;
    $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));

  }

  public function getId($title)
  {
    $sql = "SELECT report_id FROM reports WHERE report_title = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title]);
    $confid = $stmt->fetch();
    return $confid;
  }

  public function checkTitle($title)
  {
    $sql = "SELECT report_title FROM reports WHERE report_title = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title]);
    $info = $stmt->fetch();
    return $info;

  }

  public function getReport()
  {
    $sql = "SELECT * FROM reports
    ORDER BY report_id";
    $info = $this->mySqli($sql);
    return $info;
  }

  public function getSpecificReport($id)
  {
    $sql = "SELECT * FROM reports WHERE report_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $info = $stmt->fetch();
    return $info;
  }

  public function deleteReport($id)
  {
    $sql = "DELETE FROM reports WHERE report_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }
  // for the submission of reports


}

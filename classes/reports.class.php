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

  public function getAllReports()
  {
    $sql = "SELECT * FROM reports";
    $info = $this->mySqli($sql);
    return $info;
  }

  public function countAllReports()
  {
    $result = $this->connect()->query("SELECT count(*) as total FROM reports");
    $row = $result->fetchObject()->total;
    return $row;
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

  public function deleteSubmittedReport($user_id, $report_id)
  {
    $sql = "DELETE FROM submitted_reports
    WHERE user_id = ? AND report_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $report_id]);
  }
  // for the submission of reports for users
  public function submitReport($user_id, $report_id, $file_name, $file_type, $file_size)
  {
    $sql = "SELECT * FROM submitted_reports
            WHERE user_id=? AND report_id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $report_id]);
    $info = $stmt->fetch();

    if($info != null)
    {
      $sql = "UPDATE submitted_reports
              SET file_name=?, file_type = ?, file_size = ?
              WHERE user_id=? AND report_id=?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$file_name, $file_type,$file_size, $user_id, $report_id]);
    }
    else
    {
      $sql = "INSERT INTO submitted_reports(user_id, report_id, file_type, file_name, file_size)
              VALUES(?, ?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$user_id, $report_id, $file_type, $file_name, $file_size]);
    }
  }

  public function getSubmittedReport($user_id, $report_id)
  {
    $sql = "SELECT * FROM submitted_reports
            WHERE user_id=? AND report_id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $report_id]);
    $info = $stmt->fetch();
    return $info;
  }

  public function getSubmittedReports($report_id)
  {
    $sql = "SELECT l_name, f_name, m_name, designation,
     users.user_id, station, report_id,
     date_submitted, file_name, file_type
    FROM (users INNER JOIN add_info
      ON users.user_id = add_info.user_id)
    LEFT JOIN submitted_reports
    ON users.user_id = submitted_reports.user_id
    AND report_id={$report_id}
    ORDER BY station, l_name, f_name, m_name, designation";
            $info = $this->mySqli($sql);
            return $info;
  }
  public function getSubmittedSchoolReports($report_id, $station)
  {
    $sql = "SELECT l_name, f_name, m_name, designation,
     users.user_id, station, report_id,
     date_submitted, file_name, file_type
    FROM (users INNER JOIN add_info
      ON users.user_id = add_info.user_id AND station = '{$station}')
    LEFT JOIN submitted_reports
    ON users.user_id = submitted_reports.user_id
    AND report_id={$report_id}
    ORDER BY station, l_name, f_name, m_name, designation";
            $info = $this->mySqli($sql);
            return $info;
  }

  public function closeReport($id)
  {
    $sql = "UPDATE reports SET status = 'Close'
    WHERE report_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);

  }
  public function openReport($id)
  {
    $sql = "UPDATE reports SET status = 'Open'
    WHERE report_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);

  }
  public function timed_outReport($date)
  {
    $sql = "SELECT * FROM reports
    WHERE status = 'Open' and deadline_date <'{$date}'
    ORDER BY report_id";
    $info = $this->mySqli($sql);
    return $info;
  }

}

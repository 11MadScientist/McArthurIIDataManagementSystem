<?php
class Attendance extends Dbh
{
  public function submitTimeAm($id, $date, $time, $status)
  {
    $sql = "INSERT INTO attendance(user_id, attn_date, timein_am, am_status) VALUES (?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id,$date, $time, $status]);
  }

  public function submitTimeOutAm($id, $date, $time)
  {
    $sql = "UPDATE attendance SET timeout_am=?
            WHERE attn_date = ? AND user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$time, $date, $id]);
  }

  public function submitTimeInPm($id, $date, $time, $status)
  {
    $sql = "SELECT user_id FROM attendance WHERE user_id=?
            AND attn_date = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id,$date]);
    $info = $stmt->fetch();

    if($info == null)
    {
      $sql = "INSERT INTO attendance(user_id, attn_date, timein_pm, pm_status) VALUES (?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id,$date, $time, $status]);
    }
    else
    {
      $sql = "UPDATE attendance SET timein_pm=?
              WHERE attn_date = ? AND user_id = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$time, $date, $id]);
    }
  }
  public function submitTimeOutPm($id, $date, $time)
  {
    $sql = "UPDATE attendance SET timeout_pm=?
            WHERE attn_date = ? AND user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$time, $date, $id]);
  }

  public function getTimeAm($id,$date)
  {
    $sql = "SELECT * FROM attendance WHERE user_id = ? AND attn_date = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $date]);
    $info = $stmt->fetch();
    return $info;
  }
}

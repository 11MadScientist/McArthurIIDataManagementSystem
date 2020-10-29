<?php
class Attendance extends Dbh
{
  public function submitTimeInAm($id, $date, $time, $status)
  {
    $sql = "INSERT INTO attendance(user_id, attn_date, timein_am, status) VALUES (?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id,$date, $time, $status]);
  }

  public function submitTimeOutAm()
  {
    $sql = "INSERT INTO attendance(user_id, attn_date, timein_am, status) VALUES (?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id,$date, $time, $status]);
  }

  public function getTime($id,$date)
  {
    $sql = "SELECT * FROM attendance WHERE user_id = ? AND attn_date = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $date]);
    $info = $stmt->fetch();
    return $info;
  }
}

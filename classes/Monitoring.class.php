<?php

class Monitoring extends Dbh
{
  public function showAttendance($date)
  {
    $sql = "SELECT users.user_id, l_name, f_name, m_name, station, timein_am, timeout_am,
    timein_pm, timeout_pm, am_status, pm_status
     FROM (users LEFT JOIN add_info ON users.user_id = add_info.user_id)
     LEFT JOIN attendance ON users.user_id = attendance.user_id
     AND attn_date ="."'".$date."'";

    $info = $this->mySqli($sql);
    return $info;
  }

  public function getLeave($id, $date)
  {
    $sql = "SELECT start_date, end_date
    FROM leave_rqsts WHERE status = 'Accepted'
    AND user_id =? AND
    (start_date <= ? AND end_date >= ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $date, $date]);
    $date = $stmt->fetch();
    return $date;
  }

  // show attendance for the principals
  public function showSchoolAttendance($date, $station)
  {
    $sql = "SELECT users.user_id, l_name, f_name, m_name, station, timein_am, timeout_am,
    timein_pm, timeout_pm, am_status, pm_status
     FROM (users INNER JOIN add_info ON users.user_id = add_info.user_id
      AND add_info.station = '{$station}')
     INNER JOIN attendance ON users.user_id = attendance.user_id
     AND attn_date ="."'".$date."'";

    $info = $this->mySqli($sql);
    return $info;
  }
}

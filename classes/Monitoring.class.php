<?php

class Monitoring extends Dbh
{
  public function showAttendance($date)
  {
    $sql = "SELECT l_name, f_name, m_name, station, timein_am, timeout_am,
    timein_pm, timeout_pm, am_status, pm_status 
     FROM (users LEFT JOIN add_info ON users.user_id = add_info.user_id)
     LEFT JOIN attendance ON users.user_id = attendance.user_id
     AND attn_date ="."'".$date."'";

    $info = $this->mySqli($sql);
    return $info;
  }
}

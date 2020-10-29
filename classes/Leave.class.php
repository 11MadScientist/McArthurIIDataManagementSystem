<?php

class Leave extends Dbh
{
  public function submitLeave($user_id, $leaveType, $start_date, $end_date)
  {
    $sql = "INSERT INTO leave_rqsts (user_id, leaveType, start_date, end_date)
    VALUES(?,?,?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $leaveType, $start_date, $end_date]);
  }


  public function editLeave($id,$user_id, $leaveType, $start_date, $end_date)
  {
    $sql = "UPDATE leave_rqsts SET user_id =?, leaveType=?, start_date=?, end_date=?
    WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $leaveType, $start_date, $end_date, $id]);
  }

  public function deleteLeave($id)
  {
    $sql = "DELETE FROM leave_rqsts
            WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }

  public function indivLeaveList($user_id)
  {
    $sql = "SELECT * FROM leave_rqsts
            WHERE user_id=".$user_id;

    $info = $this->mySqli($sql);
    return $info;
  }
  public function getIndivLeave($id)
  {
    $sql = "SELECT * FROM leave_rqsts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $info = $stmt->fetch();
    return $info;
  }

  public function leaveList()
  {
    $sql = "SELECT id, users.user_id, start_date, end_date, l_name, f_name, m_name,
    designation, grade, station FROM ((leave_rqsts INNER JOIN users ON leave_rqsts.user_id = users.user_id
    AND leave_rqsts.status='')
    INNER JOIN add_info ON leave_rqsts.user_id = add_info.user_id)";
    $info = $this->mySqli($sql);
    return $info;
  }

  public function acceptLeave($id)
  {
    $sql = "UPDATE  leave_rqsts SET status = 'Accepted'
    WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }

}

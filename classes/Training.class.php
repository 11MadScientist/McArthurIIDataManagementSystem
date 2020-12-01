<?php

class Training extends Dbh
{
  public function createTraining($user_id, $date, $dm_num, $year)
  {
    $sql = "INSERT INTO training (user_id, training_date, dm_number, year)
            VALUES(?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $date, $dm_num, $year]);
  }

  public function editTraining($id, $date, $dm_num, $year)
  {
    $sql = "UPDATE training SET training_date=?, dm_number=?, year=?
            WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$date, $dm_num, $year, $id]);
  }

  public function deleteTraining($id)
  {
    $sql = "DELETE FROM training WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }

  public function getIndivTraining($id)
  {
    $sql = "SELECT * FROM training WHERE user_id =".$id;
    $info = $this->mySqli($sql);
    return $info;
  }
  public function getTraining()
  {
    $sql = "SELECT * FROM training WHERE status = 'Pending'";
    $info = $this->mySqli($sql);
    return $info;
  }
  public function getApproved()
  {
    $sql = "SELECT * FROM training WHERE status != 'Pending'";
    $info = $this->mySqli($sql);
    return $info;
  }

  public function acceptTraining($id)
  {
    $sql = "UPDATE training SET status='Approved' WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }


}

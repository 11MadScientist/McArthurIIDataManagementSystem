<?php
// select users through email
class AddInfo extends Dbh
{
  public function getAddInfo($id)
  {
    $sql = "SELECT * FROM add_info WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $info = $stmt->fetch();
    return $info;
  }

  public function setAddInfo($id, $grade, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct)
  {
    $sql = "INSERT INTO add_info(user_id, grade, station, date_of_birth, civil_status, highest_educ_attainment, specification, date_of_orig_appointment, date_of_latest_promo, contact_num, fb_acct)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $grade, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct]);
  }

  public function updateAddInfo($id, $grade, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct)
  {
    $sql = "SELECT user_id FROM add_info WHERE user_id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $info = $stmt->fetch();

    if($info == null)
    {
      $sql = "INSERT INTO add_info(user_id, grade, station, date_of_birth, civil_status, highest_educ_attainment, specification, date_of_orig_appointment, date_of_latest_promo, contact_num, fb_acct)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id, $grade, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct]);
    }
    else
    {
      $sql = "UPDATE add_info SET grade = ?, station = ?, date_of_birth = ?, civil_status = ?, highest_educ_attainment= ?, specification=?, date_of_orig_appointment=?, date_of_latest_promo=?, contact_num=?, fb_acct=?
              WHERE user_id = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$grade, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct, $id]);
    }

  }

  public function getStation($id)
  {
    $sql = "SELECT station FROM add_info
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $info = $stmt->fetch();
    return $info;
  }
}

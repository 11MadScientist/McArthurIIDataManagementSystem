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

  public function setAddInfo($id, $age, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct)
  {
    $sql = "INSERT INTO add_info(user_id, age, station, date_of_birth, civil_status, highest_educ_attainment, specification, date_of_orig_appointment, date_of_latest_promo, contact_num, fb_acct)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $age, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct]);
  }

  public function updateAddInfo($id, $age, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct)
  {
    $sql = "UPDATE add_info SET age = ?, station = ?, date_of_birth = ?, civil_status = ?, highest_educ_attainment= ?, specification=?, date_of_orig_appointment=?, date_of_latest_promo=?, contact_num=?, fb_acct=?
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$age, $station, $dateofbirth, $civilstatus, $highesteducattn, $specification, $orig_appointment, $dateofpromo, $contactnum, $fbacct, $id]);
  }
}

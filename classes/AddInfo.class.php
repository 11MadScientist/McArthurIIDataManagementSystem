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

  public function setAddInfo($id, $designation, $station, $dateofbirth, $civilstatus, $highesteducattn, $major, $orig_appointment, $dateofpromo, $contactnum, $fbacct)
  {
    $sql = "INSERT INTO add_info(user_id, designation, station, date_of_birth, civil_status, highest_educ_attainment, major, date_of_orig_appointment, date_of_latest_promo, contact_num, fb_acct)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $designation, $station, $dateofbirth, $civilstatus, $highesteducattn, $major, $orig_appointment, $dateofpromo, $contactnum, $fbacct]);
  }
}

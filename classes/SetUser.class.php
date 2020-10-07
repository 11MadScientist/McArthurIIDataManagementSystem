<?php

class SetUser extends Dbh
{

  public function setUserInfo($pass, $lname, $fname, $level, $email)
  {
    $sql = "INSERT INTO users(pass_word, l_name, f_name, level, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$pass, $lname, $fname, $level, $email]);
  }

}

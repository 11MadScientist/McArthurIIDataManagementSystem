<?php
// select users through email
class User extends Dbh
{
  //gets user info through email
  public function emailChecker($email)
  {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email]);
    $names = $stmt->fetch();
    return $names;

  }

  public function setUserInfo($pass, $lname, $fname, $level, $email)
  {
    $sql = "INSERT INTO users(pass_word, l_name, f_name, level, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$pass, $lname, $fname, $level, $email]);
  }
}

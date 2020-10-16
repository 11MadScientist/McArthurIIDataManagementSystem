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

  public function idChecker($id)
  {
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $info = $stmt->fetch();
    return $info;
  }

  public function changePass($id,$pass)
  {
    $sql = "UPDATE users
    SET pass_word = ?
    WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$pass, $id]);
  }

  public function setUserInfo($pass, $lname, $mname, $fname, $level, $email)
  {
    $sql = "INSERT INTO users(pass_word, l_name, m_name, f_name, level, email) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$pass, $lname, $mname, $fname, $level, $email]);
  }
}

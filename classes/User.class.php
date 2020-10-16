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
  public function realEmailChecker($email, $id)
  {
    $sql = "SELECT * FROM users WHERE email = ? AND user_id <> ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email, $id]);
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

  public function setUserInfo($pass, $lname, $mname, $fname, $desig, $email)
  {
    $sql = "INSERT INTO users(pass_word, l_name, m_name, f_name, designation, email) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$pass, $lname, $mname, $fname, $desig, $email]);
  }

  public function updateUserInfo($id,$lname, $mname, $fname, $desig, $email)
  {
    $sql = "UPDATE users SET l_name = ?, m_name = ?, f_name = ?, designation = ?, email = ? WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$lname, $mname, $fname, $desig, $email,$id]);
  }
}

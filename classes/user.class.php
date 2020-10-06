<?php

class User extends Dbh
{
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

  public function search($input)
  {
    $sql = "SELECT * FROM users WHERE f_name = ? AND l_name = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$input]);
    $names = $stmt->fetchAll();

    foreach ($names as $name)
    {
      echo $name['f_name']." ".['l_name'].'<br>';
    }
  }
}

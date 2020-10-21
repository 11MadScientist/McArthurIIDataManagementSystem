<?php

class Dbh
{
  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $dbName = "mddb";

  protected function connect()
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
    $pdo = new PDO($dsn, $this->user, $this->pass);
    $pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }

//this mySqli returns list
  protected function mySqli($sql)
  {
    $mysqli = new mysqli($this->host,$this->user,$this->pass,$this->dbName);


    if ($mysqli -> connect_errno)
    {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
    }

    // Perform query
    if ($result = $mysqli -> query($sql))
     {
        return $result;
     }

     $mysqli -> close();
  }
}

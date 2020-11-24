<?php
class Events extends Dbh
{
  //returns list

  public function getOneEvent($id)
  {
    $sql = "SELECT *
            FROM events
            WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $info = $stmt->fetch();
            return $info;

    $info = $this->mySqli($sql);
    return $info;
  }

  public function getEvents()
  {
    $sql = "SELECT *
            FROM events
            ORDER BY start_date DESC
            LIMIT 10";

    $info = $this->mySqli($sql);
    return $info;
  }

  public function getAllEvents($date)
  {
    $sql = "SELECT *
            FROM events
            WHERE start_date LIKE '".$date."%'
            OR end_date LIKE '".$date."%'
            ORDER BY start_date DESC";

    $info = $this->mySqli($sql);
    return $info;
  }

  public function getEventsAll()
  {
    $sql = "SELECT * FROM events";
    $info = $this->mySqli($sql);
    return $info;
  }

  public function countAllEvents()
  {
    $result = $this->connect()->query("SELECT count(*) as total FROM events");
    $row = $result->fetchObject()->total;
    return $row;
  }

  public function checkTitle($title)
  {
    $sql = "SELECT title FROM events WHERE title = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title]);
    $info = $stmt->fetch();
    return $info;

  }

  public function setEvent($id, $start_date, $end_date, $title, $description)
  {
    $sql = "INSERT INTO events(user_id, start_date, end_date, title, description)
            VALUES(?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id,$start_date, $end_date, $title, $description]);
  }

  public function editEvent($id,$user_id, $start_date, $end_date, $title, $description)
  {
    $sql = "UPDATE events SET user_id=?, start_date=?, end_date=?, title=?,
            description=?
            WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id,$start_date, $end_date, $title, $description,$id]);
  }

  public function delEvent($id)
  {
    $sql = "DELETE FROM events WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }

  public function getId($title)
  {
    $sql = "SELECT id FROM events WHERE title = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title]);
    $confid = $stmt->fetch();
    return $confid;
  }

  public function imgUpload($id, $imageProperties, $imgData)
  {

    $conn = mysqli_connect("localhost", "root", "", "mddb");
    $sql = "INSERT INTO events_img(id, imageType, imageData)
    VALUES('{$id}', '{$imageProperties['mime']}', '{$imgData}')";
    $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));


  }

  public function imgUpdate($id, $imageProperties, $imgData)
  {

    $sql = "SELECT id FROM events_img WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $confid = $stmt->fetch();

    if($confid != null)
    {
      $conn = mysqli_connect("localhost", "root", "", "mddb");
      $sql = "UPDATE events_img
      SET imageType = '{$imageProperties['mime']}', imageData = '{$imgData}'
      WHERE id =".$id;
      $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));

    }
    else
    {
      $conn = mysqli_connect("localhost", "root", "", "mddb");
      $sql = "INSERT INTO events_img(id, imageType, imageData)
      VALUES('{$id}', '{$imageProperties['mime']}', '{$imgData}')";
      $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));

    }

  }

  public function getImage($id)
  {
    $conn = mysqli_connect("localhost", "root", "", "mddb");
    $sql = "SELECT user_id FROM prof_pic WHERE user_id =".$id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }

  public function delImg($id)
  {
    $sql = "DELETE FROM events_img WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }

  public function get_eventImg($id)
  {
    $conn = mysqli_connect("localhost", "root", "", "mddb");
    $sql = "SELECT id FROM events_img WHERE id =".$id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
}

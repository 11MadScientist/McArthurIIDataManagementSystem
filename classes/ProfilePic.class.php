<?php
include('dbh.class.php');
class ProfilePic extends Dbh
{
  public function pic_upload($id, $imageProperties, $imgData)
  {
      $sql = "SELECT user_id FROM prof_pic WHERE user_id = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id]);
      $confid = $stmt->fetch();

      if($confid['user_id'] == $id)
      {
        $conn = mysqli_connect("localhost", "root", "", "mddb");
        $sql = "UPDATE prof_pic
        SET imageType = '{$imageProperties['mime']}', imageData = '{$imgData}'
        WHERE user_id =".$id;
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
      }
      elseif($confid['user_id'] == null)
      {
        $conn = mysqli_connect("localhost", "root", "", "mddb");
        $sql = "INSERT INTO prof_pic(user_id, imageType, imageData)
        VALUES('{$id}', '{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
      }

  }

  public function get_profile($id)
  {
    $conn = mysqli_connect("localhost", "root", "", "mddb");
    $sql = "SELECT user_id FROM prof_pic WHERE user_id =".$id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
}

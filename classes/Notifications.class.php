<?php
class Notifications extends Dbh
{
    public function insertNotif($user, $type, $type_id, $status, $date)
    {
        $sql = "INSERT INTO notifications(user_id, type, type_id, status, date) VALUES (?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user, $type, $type_id, $status, $date]);
    }

    public function updateNotif($id)
    {
        $sql = "UPDATE notifications SET status ='read' WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function delNotif($type, $type_id)
    {
        $sql = "DELETE FROM notifications WHERE type=? AND type_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$type, $type_id]);
    }

    function fetchAll($query)
    {
        $stmt = $this->connect()->query($query);
        return $stmt->fetchAll();
    }

    function isNotifTableEmpty()
    {
        $sql = "SELECT user_id FROM notifications";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>1)
            return false;
        else
            return true;
    }
}
?>

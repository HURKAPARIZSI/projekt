<?php
require_once('ModelBase.php');
class Log {
    private int $id;
    private int $userId;
    private string $date;
    private int $direction;


    public static function createLog($direction, $userId):bool{
        try{
            $conn = connect();
            $sql = 'CALL `createLog`(' . $direction . ', ' . $userId . ', "' . time() . '");';
            mysqli_query($conn, $sql);
            return true;
        }
        catch(Exception $ex){
            print $ex->getMessage();
            return false;
        }
    }

    // Getter metódusok
    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function getDirection(): int {
        return $this->direction;
    }

    // Setter metódusok

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }

}
?>
<?php
require_once('ModelBase.php');
class Log {
    private int $id;
    private int $userId;
    private string $date;
    private int $direction;
    private bool $isDeleted;


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
    public function getIsDeleted(): bool {
        return $this->isDeleted;
    }
    

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }
    public static function getById(int $id): ?self {
        try {
            $conn = connect();
            $sql = 'CALL `getLogById`(' . $id . ');';
            $result = mysqli_query($conn, $sql);
            if ($row = $result->fetch_assoc()) {
                $log = new self();
                $log->id = $row['id'];
                $log->userId = $row['user_id'];
                $log->date = $row['date'];
                $log->direction = $row['direction'];
                $log->isDeleted = $row['is_deleted'];
                return $log;
            }
            return null;
        } catch (Exception $ex) {
            print $ex->getMessage();
            return null;
        }
    }

    public static function deleteById(int $id): bool {
        try {
            $conn = connect();
            $sql = 'CALL `softDeleteLogById`(' . $id . ');';
            mysqli_query($conn, $sql);
            return true;
        } catch (Exception $ex) {
            print $ex->getMessage();
            return false;
        }
    }

}
?>
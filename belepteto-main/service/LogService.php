<?php
require_once('../model/Log.php');
class LogService{

    public function createLog($direction, $userId): bool{
        return Log::createLog($direction, $userId);
    }

    public function getById(int $id): ?Log {
        return Log::getById($id);
    }

    public function deleteById(int $id): bool {
        return Log::deleteById($id);
    }

}
/**
 * Java:
 * Log l = new Log();
 * l.createLog(...);
 * 
 * Log.createLog(...);
 * 
 * $l = new Log();
 * $l->createLog(...);
 * 
 * Log::createLog(...);
 * 
 */
?>
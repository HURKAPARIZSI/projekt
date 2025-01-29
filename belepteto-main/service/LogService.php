<?php
require_once('../model/Log.php');
class LogService{

    public function createLog($direction, $userId): bool{
        return Log::createLog($direction, $userId);
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
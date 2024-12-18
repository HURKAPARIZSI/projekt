<?php
require_once('../model/Log.php');
class LogService{

    public function createLog($direction,$userid){
        return Log::createLog($direction,$userid);
    }


}





?>
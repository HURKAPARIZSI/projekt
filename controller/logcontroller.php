<?php

require_once('../service/LogService');
if(isset($_GET)||isset($_POST)||isset($_PUT)||isset($_DELETE)){
    if(isset($_POST)){
        try($_POST['task']=='create'){
            $direction = (int)$_POST['direction'];
            $userId = (int)$_POST['userId'];
            $service->createLog($direction,$userId);
            http_response_code(200);
        }
        catch(Exception $ex){
            print $ex->getMessage();
            http_response_code(500);                        
        }
    }
}







?>
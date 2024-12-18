<?php
require_once('../service/LogService.php');

if(isset($_GET) || isset($_POST) || isset($_PUT) || isset($_DELETE)){
    $service = new LogService();
    $post = json_decode(file_get_contents('php://input'), true);
    //print_r($post);
        if($post['task'] == 'create'){
            try{
                if(!is_numeric($post['direction']) || !is_numeric($post['userId'])){
                    http_response_code(500);
                    exit();
                }
                $direction = settype($post['direction'], 'int');
                $userId = (int)$post['userId'];
                $service->createLog($direction, $userId);
                http_response_code(200);
            }
            catch(Exception $ex){
                print $ex->getMessage();
                http_response_code(500);
            }
        }
        else http_response_code(404);
   // }
    //http_response_code(405);
}


?>
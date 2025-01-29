<?php
require_once('../service/LogService.php');
require_once('../Log.php');
$log = new ErrorLog(date('Y-m-d H:i:s'), 'Hiba történt.');
if(isset($_GET) || isset($_POST) || isset($_PUT) || isset($_DELETE)){
    $service = new LogService();
    $post = json_decode(file_get_contents('php://input'), true);
    //print_r($post);
        if($post['task'] == 'create'){
            try{
                $log->addDetail('A task = create... Try blokkban vagyunk.');
                if(!is_numeric($post['direction']) || !is_numeric($post['userId'])){
                    $log->addDetail('Nem volt isnumeric, 500-as hiba');
                    $log->addDetail('direction: ' . $post['direction']);
                    $log->addDetail('userId: ' . $post['userId']);
                    $log->log();
                    http_response_code(500);
                    exit();
                }
                $direction = settype($post['direction'], 'int');
                $userId = (int)$post['userId'];
                $log->addDetail('A konvertálások sikeresek voltak.');
                $service->createLog($direction, $userId);
                $log->addDetail('A service lefutott');
                $log->log();
                http_response_code(200);
            }
            catch(Exception $ex){
                $log->addDetail($ex->getMessage());
                $log->log();
                http_response_code(500);
            }
        }
        else {
            $log->addDetail('Task nem volt create, 404-es error');
            $log->addDetail('post request: ' . $post['task']);
            $log->log();
            http_response_code(404);
        }
   // }
    //http_response_code(405);
}


?>
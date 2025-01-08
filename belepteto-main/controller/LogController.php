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

class LogController {
    private LogService $service;

    public function __construct() {
        $this->service = new LogService();
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $task = $_GET['task'] ?? null;

        if ($method === 'GET' && isset($_GET['id'])) {
            $this->getById((int)$_GET['id']);
        } elseif (($method === 'POST' && $task === 'delete') || $method === 'DELETE') {
            $this->deleteById();
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Invalid request']);
        }
    }

    private function getById(int $id) {
        $log = $this->service->getById($id);
        if ($log) {
            echo json_encode([
                'id' => $log->getId(),
                'userId' => $log->getUserId(),
                'date' => $log->getDate(),
                'direction' => $log->getDirection(),
                'isDeleted' => $log->getIsDeleted(),
            ]);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Log not found']);
        }
    }

    private function deleteById() {
        $id = $_POST['id'] ?? null;
        if ($id === null) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Missing ID']);
            return;
        }

        $result = $this->service->deleteById((int)$id);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Failed to delete log']);
        }
    }
}


?>

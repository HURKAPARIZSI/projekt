<?php
require_once "../service/MunkavallaloService.php";
class MunkavallaloController{
    static function addMunkavallalo(string $adojel, string $szulDatum, string $nev){
        $result = MunkavallaloService::addMunkavallalo($adojel, $szulDatum, $nev);
        $response = [
            "status" => $result["status"] ? "success" : "error",
            "httpCode" => $result["httpStatusCode"],
            "message" => $result["message"]
        ];
        echo json_encode($response);
    }

    static function getAllMunkavallalo(){
        $result = MunkavallaloService::getAllMunkavallalo();
        $response = [
            "status" => $result["status"] ? "success" : "error",
            "httpCode" => $result["httpStatusCode"],
            "message" => $result["message"],
            "body" => $result["data"] ?? ""
        ];
        echo json_encode($response);
    }

    static function getMunkavallaloById(int $id){
        $result = MunkavallaloService::getMunkavallaloById($id);
        $response = [
            "status" => $result["status"] ? "success" : "error",
            "httpCode" => $result["httpStatusCode"],
            "message" => $result["message"],
            "body" => $result["data"] ?? ""
        ];
        echo json_encode($response);
    }

    static function updateMunkavallalo(int $id, string $adojel, string $szulDatum, string $nev){
        $result = MunkavallaloService::updateMunkavallalo($id, $adojel, $szulDatum, $nev);
        $response = [
            "status" => $result["status"] ? "success" : "error",
            "httpCode" => $result["httpStatusCode"],
            "message" => $result["message"]
        ];
        echo json_encode($response);
    }

    static function deleteMunkavallalo(int $id){
        $result = MunkavallaloService::deleteMunkavallalo($id);
        $response = [
            "status" => $result["status"] ? "success" : "error",
            "httpCode" => $result["httpStatusCode"],
            "message" => $result["message"]
        ];
        echo json_encode($response);
    }
    
}
//Endpointok helyi tesztelése

// MunkavallaloController::addMunkavallalo("14543462","2005-03-06","tomi");
// MunkavallaloController::getAllMunkavallalo();
// MunkavallaloController::getMunkavallaloById(3);
// MunkavallaloController::updateMunkavallalo(1,"14543462","2005-03-06","Tibor");
MunkavallaloController::deleteMunkavallalo(2);
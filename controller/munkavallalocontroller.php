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
}
MunkavallaloController::addMunkavallalo("14543462","2005-03-06","tomi");
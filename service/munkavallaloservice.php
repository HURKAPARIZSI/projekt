<?php
require_once "../model/Munkavallalo.php";
class MunkavallaloService
{

    static function addMunkavallalo(string $adojel, string $szulDatum, string $nev)
    {

        //Ellenőrizzük hogy a munkavállaló elmúlt e 18 éves 
        $today = date_create();
        $dateToCompare = date_create($szulDatum);
        $difference = date_diff($today, $dateToCompare);
        if ($difference->y >= 18) {
            $modelResult = Munkavallalo::addMunkavallalo($adojel, $szulDatum, $nev);

            //Ha a modell result false akkor hiba történt
            if (!$modelResult) {
                return $result = [
                    "status" => false,
                    "message" => "Internal Server Error",
                    "httpStatusCode" => 500
                ];
            } else {
                return $result = [
                    "status" => true,
                    "message" => "Success",
                    "httpStatusCode" => 200
                ];
            }
        }else{
            return $result = [
                "status" => false,
                "message" => "Munkavallalo is under 18",
                "httpStatusCode" => 417
            ];
        }

        
    }
}
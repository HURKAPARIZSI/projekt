<?php
require_once "../model/Munkavallalo.php";
class MunkavallaloService
{
    static function getMunkavallaloById(int $id){
        $modelResult = Munkavallalo::getMunkavallaloById($id);
        if(!$modelResult){
            return $result = [
                "status" => false,
                "message" => "Internal Server Error",
                "httpStatusCode" => 500
            ];
        }else{
            $resultData = [];
            //Mai nap dátum értékként
            $today = date_create();

            //Át alakítjuk a szuletési időt korrá
            $szulDatumDate = date_create($modelResult["szul_datum"]);
            //Kiszámoljuk a különbséget évben
            $age = date_diff($today, $szulDatumDate)->y;

            array_push($resultData, [
                "adojel" => $modelResult["adojel"],
                "kor" => $age,
                "nev" => $modelResult["nev"]
            ]);
            
            return $result = [
                "status" => true,
                "message" => "Success",
                "httpStatusCode" => 200,
                "data" => $resultData
            ];
        }
    }
    static function getAllMunkavallalo(){
        $modelResult = Munkavallalo::getAllMunkavallalo();
        if(!$modelResult){
            return $result = [
                "status" => false,
                "message" => "Internal Server Error",
                "httpStatusCode" => 500
            ];
        }else{
            $resultData = [];
            //Mai nap dátum értékként
            $today = date_create();
            foreach ($modelResult as $munkavallalo) {

                //Át alakítjuk a szuletési időt korrá
                $szulDatumDate = date_create($munkavallalo["szul_datum"]);
                //Kiszámoljuk a különbséget évben
                $age = date_diff($today, $szulDatumDate)->y;

               array_push($resultData,[
                    "adojel" => $munkavallalo["adojel"],
                    "kor" =>$age,
                    "nev" => $munkavallalo["nev"]
               ]);
            }
            return $result = [
                "status" => true,
                "message" => "Success",
                "httpStatusCode" => 200,
                "data" => $resultData
            ];
        }
    }
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

    static function updateMunkavallalo(int $id, string $adojel, string $szulDatum, string $nev)
    {
        $isMunkavallaloExists = Munkavallalo::getMunkavallaloById($id);
        if(!$isMunkavallaloExists){
            return $result = [
                "status" => false,
                "message" => "Munkavallalo doesn't exists",
                "httpStatusCode" => 417
            ];
        } else {
            //Ellenőrizzük hogy a munkavállaló elmúlt e 18 éves 
            $today = date_create();
            $dateToCompare = date_create($szulDatum);
            $difference = date_diff($today, $dateToCompare);
            if ($difference->y >= 18) {
                $modelResult = Munkavallalo::updateMunkavallalo($id, $adojel, $szulDatum, $nev);

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
            } else {
                return $result = [
                    "status" => false,
                    "message" => "Munkavallalo is under 18",
                    "httpStatusCode" => 417
                ];
            }
        }
    }
    static function deleteMunkavallalo(int $id){
        $modelResult = Munkavallalo::deleteMunkavallalo($id);
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
    }
}
// MunkavallaloService::getAllMunkavallalo();
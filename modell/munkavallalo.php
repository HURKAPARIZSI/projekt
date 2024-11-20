<?php
require_once('modelbase.php');

class Munkavallalok {

    private array $records = [];

    public function __construct() {
        try {
            
            $kapcs = connect();

            // SQL parancs összerakása
            $sql = 'CALL getAll()';

            // SQL parancs lefuttatása
            $adatok = mysqli_query($kapcs, $sql);

            // Visszajött adatok feldolgozása
            while ($sor = mysqli_fetch_assoc($adatok)) {
                $this->records[] = [
                    'id' => (int)$sor['id'],
                    'nev' => $sor['nev'],
                    'adojel' => $sor['adojel'],
                    'szulDatum' => $sor['szuldatum']
                ];
            }

            
            mysqli_close($kapcs);

        } catch (Exception $ex) {
            print $ex->getMessage();
        }
    }

    // Metódus az adatok lekérésére
    public function getAll(): array {
        return $this->records;
    }
}
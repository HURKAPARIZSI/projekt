<?php
require_once('modelbase.php');

class Munkavallalok{

    private string $nev;
    private string $adojel;
    private string $szulDatum;
    private int $id;

    public function __construct(int $id){
        try{
        $kapcs = connect();
        //biztonsági lépések
        $this->id = (int)mysqli_real_escape_string($kapcs, $id);
        $this->id = strip_tags($this->id);
        //SQL parancs összerakása
        $sql = 'CALL read('.$this->id.')';
        //SQL parancs lefuttatása
        $adatok = mysqli_query( $kapcs,$sql);
        //Visszajött adatok kezelése
        $fetcheltAdatok = mysqli_fetch_assoc($adatok);
        //$fetcheltAdatok['id'] $fetcheltAdatok['nev'].....
        $this->adojel = $fetcheltAdatok['adojel'];//NAGYON FONTOS!!!!!
        $this->nev = $fetcheltAdatok['nev'];//NAGYON FONTOS!!!!!
        $this->szulDatum = $fetcheltAdatok['szuldatum'];//NAGYON FONTOS!!!!!
        mysqli_close($kapcs);

        }
        catch(Exception $ex){
            print $ex->getMessage();
        }
    }


}






?>
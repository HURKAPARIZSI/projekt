<?php
require_once('ModelBase.php');
class Munkavallalo{

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
            $sql = 'CALL read(' . $this->id . ')';
            //SQL parancs lefuttatása
            $adatok = mysqli_query($kapcs, $sql);
            //Visszajött adatok kezelése
            $fetcheltAdatok = mysqli_fetch_assoc($adatok);
            //$fetcheltAdatok['id'] $fetcheltAdatok['nev']...
            $this->adojel = $fetcheltAdatok['adojel'];//NAGYON FONTOS!!! Adattábla mezőnév
            $this->nev = $fetcheltAdatok['nev'];
            $this->szulDatum = $fetcheltAdatok['szuldatum'];
            mysqli_close($kapcs);
        }
        catch(Exception $ex){
            print $ex->getMessage();
        }
    }

    //Hozzunk létre egy új munkavállalót
    static function addMunkavallalo(string $adojel, string $szulDatum, string $nev)
    {
        
        try {
            //Nyissuk meg az adatbázis kapcsolatot
            $kapcs = connect();

            //sql parancs meghatározása (create tárolt eljárás futtatása)
            //Konkatenáció nem működik, \" el lehet "-et írni a stringbe
            $sql = "CALL createMunkavallalo( \"$adojel\",\"$szulDatum \",\"$nev\")";

            $result = mysqli_query($kapcs, $sql);
            
            return true;

            //Írjuk ki a fellépő hibát ha nem sikerült a futtatás
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    static function update(int $id, string $adojel, string $szulDatum, string $nev)
    {

        try {
            $kapcs = connect();

            $sql = "CALL updateMunkavallalo( \"$id \",\"$adojel\",\"$szulDatum \",\"$nev\")";

            mysqli_query($kapcs, $sql);

            echo "Adat módosítva";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

//Munkavallalo::addMunkavallal("14543462", "1998-04-23", "Laci");

//Munkavallalo::update(1, "14543462", "1998-04-23", "Tibi");
?>
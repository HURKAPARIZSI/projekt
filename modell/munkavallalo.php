<?php

require_once 'modelbase.php';

class Munkavallalo extends ModelBase {
    private int $id;
    private string $nev;
    private float $adojel;
    private string $taj;
    private string $szuldate;

    public function __construct(int $id) {
        parent::__construct(); // Meghívja a ModelBase konstruktorát, amely létrehozza az adatbázis kapcsolatot

        // read tárolt eljárás hívása az ID alapján
        $stmt = $this->db->prepare("CALL read(?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Eredmények lekérése
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $this->id = $row['id'];
            $this->nev = $row['nev'];
            $this->adojel = (float)$row['adojel'];
            $this->taj = $row['taj'];
            $this->szuldate = $row['szuldate'];
        } else {
            throw new Exception("Nincs ilyen munkavállaló az adatbázisban.");
        }

        // Kapcsolatok bezárása
        $stmt->close();
        $this->closeConnection();
    }

    // További getter metódusok a tulajdonságokhoz
    public function getId(): int {
        return $this->id;
    }

    public function getNev(): string {
        return $this->nev;
    }

    public function getAdojel(): float {
        return $this->adojel;
    }

    public function getTaj(): string {
        return $this->taj;
    }

    public function getSzuldate(): string {
        return $this->szuldate;
    }
}
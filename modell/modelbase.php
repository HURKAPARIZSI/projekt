<?php

class ModelBase {
    protected $db;

    public function __construct() {
        $this->connectDB();
    }

    // Adatbázis-kapcsolat létrehozása
    protected function connectDB() {
        $this->db = new mysqli("localhost", "felhasznalonev", "jelszo", "adatbazis_nev");

        if ($this->db->connect_error) {
            die("Kapcsolódási hiba: " . $this->db->connect_error);
        }

        // connect tárolt eljárás hívása (ha szükséges)
        $this->db->query("CALL connect()");
    }

    // Az adatbázis-kapcsolat bezárása
    public function closeConnection() {
        if ($this->db) {
            $this->db->close();
        }
    }
}
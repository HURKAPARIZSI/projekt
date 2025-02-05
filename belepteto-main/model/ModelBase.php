<?php
class ModelBase {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
}
?>
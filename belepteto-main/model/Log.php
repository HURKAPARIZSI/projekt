<?php
require_once 'ModelBase.php';

class Log extends ModelBase {
    public function logEvent($munkavallalo_id, $esemeny) {
        $stmt = $this->pdo->prepare("INSERT INTO log (munkavallalo_id, esemeny, datum) VALUES (:munkavallalo_id, :esemeny, NOW())");
        return $stmt->execute(['munkavallalo_id' => $munkavallalo_id, 'esemeny' => $esemeny]);
    }

    public function getLogsByMunkavallaloId($munkavallalo_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM log WHERE munkavallalo_id = :munkavallalo_id ORDER BY datum DESC");
        $stmt->execute(['munkavallalo_id' => $munkavallalo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

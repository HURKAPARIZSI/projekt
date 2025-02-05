<?php
require_once 'ModelBase.php';

class Munkavallalo extends ModelBase {
    public function getMunkavallaloById($id) {
        $stmt = $this->pdo->prepare("CALL GetMunkavallaloById(:id)");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMunkavallalo($data) {
        $stmt = $this->pdo->prepare("CALL CreateMunkavallalo(:adojel, :szul_datum, :nev, :nem, :role)");
        return $stmt->execute([
            'adojel' => $data['adojel'],
            'szul_datum' => $data['szul_datum'],
            'nev' => $data['nev'],
            'nem' => $data['nem'],
            'role' => $data['role']
        ]);
    }

    public function updateMunkavallalo($id, $data) {
        $stmt = $this->pdo->prepare("CALL UpdateMunkavallalo(:id, :adojel, :szul_datum, :nev, :nem, :role)");
        return $stmt->execute([
            'id' => $id,
            'adojel' => $data['adojel'],
            'szul_datum' => $data['szul_datum'],
            'nev' => $data['nev'],
            'nem' => $data['nem'],
            'role' => $data['role']
        ]);
    }

    public function deleteMunkavallalo($id) {
        $stmt = $this->pdo->prepare("CALL DeleteMunkavallalo(:id)");
        return $stmt->execute(['id' => $id]);
    }

    public function getAllMunkavallalo() {
        $stmt = $this->pdo->query("CALL GetAllMunkavallalo()");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
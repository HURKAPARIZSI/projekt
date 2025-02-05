<?php
require_once 'ModelBase.php';

class Log extends ModelBase {
    
    public function createLog($userId, $message) {
        $stmt = $this->pdo->prepare("CALL CreateLog(:userId, :message)");
        return $stmt->execute([
            'userId' => $userId,
            'message' => $message
        ]);
    }

    public function getLogById($id) {
        $stmt = $this->pdo->prepare("CALL GetLogById(:id)");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllLogs() {
        $stmt = $this->pdo->query("CALL GetAllLogs()");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateLog($id, $message) {
        $stmt = $this->pdo->prepare("CALL UpdateLog(:id, :message)");
        return $stmt->execute([
            'id' => $id,
            'message' => $message
        ]);
    }

    public function softDeleteLog($id) {
        $stmt = $this->pdo->prepare("CALL SoftDeleteLog(:id)");
        return $stmt->execute(['id' => $id]);
    }

    public function hardDeleteLog($id) {
        $stmt = $this->pdo->prepare("CALL HardDeleteLog(:id)");
        return $stmt->execute(['id' => $id]);
    }
}
?>

<?php
require_once 'core/Database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = (new Database())->pdo;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM tasks ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $sql = "INSERT INTO tasks (title, detail, category, status, due) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['title'], $data['detail'], $data['category'], $data['status'], $data['due']]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function update($data) {
        $sql = "UPDATE tasks SET title=?, detail=?, category=?, status=?, due=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['title'], $data['detail'], $data['category'], $data['status'], $data['due'], $data['id']]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

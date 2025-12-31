<?php
class Task {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($title, $desc, $cat, $deadline) {
        $stmt = $this->conn->prepare(
            "INSERT INTO tasks (title, description, category_id, deadline)
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$title, $desc, $cat, $deadline]);
    }

    public function all() {
        return $this->conn->query(
            "SELECT t.*, c.name AS category
             FROM tasks t
             LEFT JOIN categories c ON t.category_id = c.id
             ORDER BY deadline ASC"
        );
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $desc, $cat, $deadline) {
        $stmt = $this->conn->prepare(
            "UPDATE tasks SET title=?, description=?, category_id=?, deadline=? WHERE id=?"
        );
        return $stmt->execute([$title, $desc, $cat, $deadline, $id]);
    }

    public function toggle($id) {
        return $this->conn->prepare(
            "UPDATE tasks SET status = IF(status='pending','completed','pending') WHERE id=?"
        )->execute([$id]);
    }

    public function delete($id) {
        return $this->conn->prepare("DELETE FROM tasks WHERE id=?")->execute([$id]);
    }
}

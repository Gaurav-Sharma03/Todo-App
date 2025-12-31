<?php
class Category {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function all() {
        return $this->conn->query("SELECT * FROM categories");
    }
}

<?php

namespace services;

class Album {
    private $conn;
    private $name;
    private $description;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create() {
        $this->name = $_REQUEST['albumName'];
        $this->description = $_REQUEST['albumDescription'];

        $sql = "INSERT INTO albums (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':description', $this->description);

        if ($stmt->execute()) {
            echo "Альбом успешно создан!";
        } else {
            echo "Ошибка: " . $stmt->errorInfo()[2];
        }

        $this->conn = null;
    }

    /**
     * Получение альбмов
     */
    public function getAll() {
        $sql = "SELECT * FROM albums";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
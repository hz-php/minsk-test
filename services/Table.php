<?php

namespace services;

class Table
{
    private $conn;
    private $tableName;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createAlbumsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `albums` (
               `id` int(11) NOT NULL AUTO_INCREMENT,
               `name` varchar(255) NOT NULL,
               `description` text,
               PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            echo "Table albums created successfully";
        } catch (\PDOException $e) {
            throw new \Exception("Error creating table: " . $e->getMessage());
        }
    }

    public function createImagesTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `images` (
               `id` int(11) NOT NULL AUTO_INCREMENT,
               `album_id` int(11) NOT NULL,
               `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
               `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
               `description` text,
               `likes` int(11) NOT NULL DEFAULT 0,
               `dislikes` int(11) NOT NULL DEFAULT 0,
               `comments` text,
               PRIMARY KEY (`id`),
               FOREIGN KEY (`album_id`) REFERENCES `albums`(`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            echo "Table images created successfully";
        } catch (\PDOException $e) {
            throw new \Exception("Error creating table: " . $e->getMessage());
        }
    }


}

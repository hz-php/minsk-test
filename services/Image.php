<?php

namespace services;

class Image
{
    private $target_dir;
    private $imageName;
    private $imageDescription;
    private $target_file;
    private $uploadOk;
    private $imageFileType;
    private $conn;

    public function __construct($target_dir, $imageName, $imageDescription, $target_file, $uploadOk, $imageFileType, $conn)
    {
        $this->target_dir = $target_dir;
        $this->imageName = $imageName;
        $this->imageDescription = $imageDescription;
        $this->target_file = $target_file;
        $this->uploadOk = $uploadOk;
        $this->imageFileType = $imageFileType;
        $this->conn = $conn;
    }

    public function checkFileType()
    {
        $imageFileType = strtolower(pathinfo($this->target_file, PATHINFO_EXTENSION));

        // Проверка типа файла
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Извините, разрешены только файлы JPG, JPEG, PNG и GIF.";
            $this->uploadOk = 0;
        }
    }

    public function uploadImage()
    {
        // Если файл был успешно загружен
        if ($this->uploadOk == 0) {
            echo "Извините, ваш файл не был загружен.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $this->target_file)) {
                $sql = "INSERT INTO images (title, file_name, description, album_id) VALUES (:name, :file_name, :description, :albumId)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':name', $this->imageName);
                $stmt->bindValue(':file_name', $this->target_file);
                $stmt->bindValue(':description', $this->imageDescription);
                $stmt->bindValue(':albumId', 1);

                if ($stmt->execute()) {
                    echo "Изображение успешно загружено!";
                    return header('location: /');
                } else {
                    echo "Ошибка: " . $stmt->errorInfo()[2];
                }
            } else {
                echo "Извините, произошла ошибка при загрузке вашего файла.";
            }

        }

        $this->conn = null;
    }

}
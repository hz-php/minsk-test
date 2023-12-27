<?php
require 'vendor/autoload.php';

use services\Database;

$database = new \services\Database();
$db = $database->connect();

$sql = "SELECT * FROM albums";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div>";
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>" . $row['description'] . "</p>";
    echo "</div>";
}
mysqli_close($conn);

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Моя галерея</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="albums.php">Альбомы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_album.php">Создать альбом</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_photo.php">Добавить фото</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</div>
<div class="container">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fileToUpload" class="form-label">Выберите файл для загрузки:</label>
            <input type="file" class="form-control" id="fileToUpload" name="fileToUpload">
        </div>
        <div class="mb-3">
            <label for="imageName" class="form-label">Название изображения:</label>
            <input type="text" class="form-control" id="imageName" name="imageName">
        </div>
        <div class="mb-3">
            <label for="imageDescription" class="form-label">Описание изображения:</label>
            <textarea class="form-control" id="imageDescription" name="imageDescription"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Загрузить изображение</button>
    </form>

</div>

</body>
</html>

<?php
require 'vendor/autoload.php';

use services\Database;
use services\Images;

$database = new Database();
$db = $database->connect();

$album = new \services\Album($db);
$result = $album->getAll();

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
<div class="header">
    <div class="menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
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
</div>
<hr>
    <div class="container">

    <div class="row">
        <?php foreach ($result as $album) :?>
        <?php
            $image = new Images();
            $image = $image->firstGetFirstImage($album['id']);
            print_r($image);
            ?>
        <div class="col-sm-4">
            <div class="card">
                <img class="card-img-top" src="path/to/your/images/image1.jpg" alt="Image 1">
                <div class="card-body">
                    <h5 class="card-title"><?= $album['name']?></h5>
                    <p class="card-text"><?= $album['description']?></p>
                    <a href="#" class="btn btn-primary">View Album</a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <!-- Repeat for other albums -->
    </div>
</div>

</body>
</html>

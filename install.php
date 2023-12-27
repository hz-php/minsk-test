<?php
require 'vendor/autoload.php';

use services\Database;

$database = new Database();
$db = $database->connect();

$table = new \services\Table($db);

// Создание таблиц
$table->createAlbumsTable();

$table->createImagesTable();
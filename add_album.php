<?php
require 'vendor/autoload.php';


$database = new \services\Database();
$db = $database->connect();


$albumName = $_POST['albumName'];
$albumDescription = $_POST['albumDescription'];
$album = new \services\Album($db, $albumName, $albumDescription);
$album->create();
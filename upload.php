<?php
require 'vendor/autoload.php';


$database = new \services\Database();
$db = $database->connect();

$target_dir = "uploads/";
$imageName = $_POST['imageName'];
$imageDescription = $_POST['imageDescription'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));

$uploader = new \services\Image($target_dir, $imageName, $imageDescription, $target_file, $uploadOk, $imageFileType, $db);
$uploader->checkFileType();
$uploader->uploadImage();
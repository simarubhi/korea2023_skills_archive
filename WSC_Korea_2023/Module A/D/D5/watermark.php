<?php

$imagePath = $_GET['image'];
$fullImagePath = $_SERVER['DOCUMENT_ROOT'] . '/skills-env/' . $imagePath;

if (!file_exists($fullImagePath)) {
    die("Image not found!");
}

$imageInfo = getimagesize($fullImagePath);
$imageType = $imageInfo[2];

switch ($imageType) {
    case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($fullImagePath);
        break;
    case IMAGETYPE_PNG:
        $image = imagecreatefrompng($fullImagePath);
        break;
    default:
        die("Unsupported image type!");
}

$watermarkText = "WorldSkills";
$fontSize = 5;
$white = imagecolorallocate($image, 255, 255, 255);

$imageWidth = imagesx($image);
$imageHeight = imagesy($image);
$textWidth = imagefontwidth($fontSize) * strlen($watermarkText);
$textHeight = imagefontheight($fontSize);

$x = $imageWidth - $textWidth - 10;
$y = $imageHeight - $textHeight - 10;

imagestring($image, $fontSize, $x, $y, $watermarkText, $white);

header('Content-Type: ' . $imageInfo['mime']);
switch ($imageType) {
    case IMAGETYPE_JPEG:
        imagejpeg($image);
        break;
    case IMAGETYPE_PNG:
        imagepng($image);
        break;
}

imagedestroy($image);
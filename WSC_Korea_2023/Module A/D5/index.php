<?php

// index.php
print('<script>console.log("itworked")</script>');

// Function to add text watermark to an image using a default font
function addTextWatermark($originalImagePath, $text) {
    // Load the original image
    $originalImage = imagecreatefromjpeg($originalImagePath);

    // Set the font size and color
    $fontSize = 40;
    $fontColor = imagecolorallocate($originalImage, 255, 255, 255); // white color

    // Use a built-in font (no need for a font file)
    $font = imageloadfont(5); // 5 is the built-in font number

    // Get the dimensions of the original image
    $originalWidth = imagesx($originalImage);
    $originalHeight = imagesy($originalImage);

    // Calculate the position to place the text (you can adjust these values)
    $positionX = $originalWidth - 150;
    $positionY = $originalHeight - 30;

    // Add the text watermark to the original image
    imagestring($originalImage, $font, $positionX, $positionY, $text, $fontColor);

    // Output the image directly to the browser
    header('Content-Type: image/jpeg');
    imagejpeg($originalImage);

    // Free up memory
    imagedestroy($originalImage);
}

// Extract the requested image from the URL
$requestedImage = basename($_SERVER['REQUEST_URI']);

// Example usage
if (!empty($requestedImage)) {
    $originalImagePath = "media/" . $requestedImage;
    $text = "World Skills";
    print('<script>console.log("itworked")</script>');

    // Display the image with text watermark
    addTextWatermark($originalImagePath, $text);
}
?>

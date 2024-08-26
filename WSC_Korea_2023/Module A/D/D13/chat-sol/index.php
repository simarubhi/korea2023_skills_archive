<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Base64 Image Upload</title>
</head>
<body>
    <form action="" method="POST">
        <label for="base64">Insert Base64 Image:</label><br>
        <textarea name="base64" id="base64" rows="10" cols="50"></textarea><br><br>
        <input type="submit" name="submit" value="Upload Image">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $base64 = $_POST['base64'];

        // Extract the base64 data from the input
        $image_data = base64_decode($base64);

        // Create a folder if it doesn't exist
        $folder_path = "images/";
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }

        // Save the image as a PNG file
        $file_name = "uploaded_image.png";
        $file_path = $folder_path . $file_name;
        file_put_contents($file_path, $image_data);

        echo "<p>Image uploaded successfully! Check the <a href='$file_path'>image here</a>.</p>";
    }
    ?>
</body>
</html>
<?php
session_start();
$uploadDirectory = "./statics/images/"; // Directory to store uploaded images

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $file = $_FILES["image"];

    // Check for errors during upload
    if ($file["error"] === UPLOAD_ERR_OK) {
        // Generate a unique filename to prevent overwriting
        $filename = md5($_SESSION['user_id']) . ".png";
        $destination = $uploadDirectory . $filename;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($file["tmp_name"], $destination)) {
            header("Location: ./settings.php?message=Image was successfully uploaded");
            exit;
        } else {
            header("Location: ./settings.php?message=Image upload failed !");
            exit;
        }
    } else {
        $error = $file['error'];
        header("Location: ./settings.php?Error: $error");
        exit;
    }
} else {
    echo "Invalid request!";
}
?>
<?php

// Get image name

$image = $_FILES['image_path']['name'] ?? $_POST['image_path_old'];

$fileTmpPath = $_FILES['image_path']['tmp_name'];
$fileName = $_FILES['image_path']['name'];
$fileSize = $_FILES['image_path']['size'];
$fileType = $_FILES['image_path']['type'];
$fileNameCmps = explode(".", $image);
$fileExtension = strtolower(end($fileNameCmps));

// Image validation
// $newFileName = md5($image) . '.' . $fileExtension;
$newFileName = $image;
// echo $newFileName;
// Allowed extensions
$allowed_image_extension = array(
    "png",
    "jpg",
    "jpeg"
);

// Validate file input to check if is not empty
if (empty($image)) {
    $response = array(
        "type" => "error",
        "message" => "Choose image file to upload."
    );
}    // Validate file input to check if is with valid extension
else if (!in_array($fileExtension, $allowed_image_extension)) {
    $response = array(
        "type" => "error",
        "message" => "Upload valid images. Only PNG, JPG and JPEG are allowed."
    );
}    // Validate image file size
else if (($fileSize > 20000000)) {
    $response = array(
        "type" => "error",
        "message" => "Image size exceeds 20MB"
    );
} else {

    // $image_path = $newFileName;
    // echo $image;
    // directory in which the uploaded file will be moved
    $uploadFileDir = '../images/' . $image;

    $dest_path = $uploadFileDir;
    // echo $dest_path;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $response = array(
            "type" => "success",
            "message" => "Image uploaded"
        );
    } else {
        $response = array(
            "type" => "error",
            "message" => "'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'"
        );
    }
}
    


// // image file directory
// $target = "../images/" . $image;

// $image_path = $image;


// // Move folder
// if (move_uploaded_file($_FILES['image_path']['tmp_name'], $target)) {
//     $_SESSION['msg'] = "Image uploaded successfully";
// } else {
//     $_SESSION['msg'] = "Failed to upload image";
// }

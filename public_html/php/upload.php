<?php
/*  Script for uploading pictures to webserver and
    EXIF, information and tags to a local MySQL server. */

// Requiring MySQL DB credentials before continuing.
require 'db-credentials.php'; 

if(isset($_POST["submit"])) { // Hvis POST formen blir sendt

    // Including EXIF extractor script
    $file = ($_FILES['photo']['tmp_name']);
    require 'exif-extract.php'; 

    // Including user entered information
    $title=$_POST['title'];
    $description=$_POST['description'];
    echo "<br>Title: " . $title;
    echo "<br>Desc: " . $description;

/*  MySQL Create new entries for file */
// Creating new connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Executing query
$values = "'$title', '$description', NOW()";
echo "<hr><b>SQL Query:</b> " . $values;
$sql = "INSERT INTO photo (`title`, `description`, `uploaded`)
VALUES ('$title', '$description', NOW())";

// DEBUG: Query ok check
if ($conn->query($sql) === TRUE) {
    echo "<br>Success: Created new row.";
} else {
    echo "<br>Error: " . $sql . "<br>" . $conn->error;
}

// Storing newly created id from `portfolio.photo` to a php variable
$photo_id = mysqli_insert_id( $conn );

// DEBUG: Current photo_id
echo "<br>Photo ID: " . $photo_id;

// Creating and populating row in photo_exif with exif data.
$values = "$photo_id, '$make', '$model', '$lens', $expoprog, $fnumber, $expotime, $iso, $focallenght, $metermode, $dateoriginal, $dateedited, '$resolution', $brightness, $exposurebias, $exposuremode, $lightsource, '$software', '$exifdescription', $altitude, $latitude, $longitude";
echo "<hr>" . $values . "<br>";
$sql = "INSERT INTO photo_exif (id, make, model, lens, exposureprog, fnumber, exposuretime, iso, focallenght, meteringmode, datetimeoriginal, datetimeedited, resolution, brightness, exposurebias, exposuremode, lightsource, software, description, altitude, lat, lng)
VALUES ($values)";

// DEBUG: Query ok check
if ($conn->query($sql) === TRUE) {
    echo "<br>Now photo_exif imported successfully";
} else {
    echo "<br>Error: " . $sql . "<br>" . $conn->error;
}

// Closing MySQL connection
$conn->close();

/* Starting image upload */
// Renaming files to reflect ID in DB.
// $imgtype = explode(".", $_FILES["enhancedphoto"]["name"]);
// $renameimg = $photo_id . '.' . end($imgtype);
// if (move_uploaded_file($_FILES["file"]["tmp_name"], "../images/photos/large" . $renameimg)) {
//     echo "The photo: ". basename($_FILES["file"]["tmp_name"]). " has been uploaded.";
// } else {
//     echo "Woops! There was an error uploading your file.";
// }


$photo_dir = "images/photos/";
//$photo = $photo_dir . basename($_FILES["photo"]["name"]);
$photo = ($_FILES["photo"]["name"]);
$original_dir = "images/photos/original/";
//$original_photo = $original_dir . basename($_FILES["originalphoto"]["name"]);
$original_photo = ($_FILES["originalphoto"]["name"]);

// Functions for validating image uploads
function check_notfake($checkfile) {
    if (getimagesize($checkfile) !== false) {
        echo "<br>ERROR: File is not an image.";
        return true;
    }
}

function check_existence($checklocation, $checkfile) {
    if (file_exists($checklocation . basename($checkfile))) {
        echo "<br>ERROR: File already exists, something went wrong with the DB creation...";
        return true;
    }
}

function check_filesize($checkfile) {
    if ($checkfile > 5000000000000) {
        echo "<br>ERROR: Your file is too large. Maximum size allowed is 32MB.";
        return true;
    }
}

function check_filetype($checklocation, $checkfile) {
    $imageFileType = strtolower(pathinfo(($checklocation . basename($checkfile),PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<br>ERROR: Only JPG, JPEG, & PNG files are allowed.";
        return true;
    }
}

if (check_notfake($photo) == false && check_existence($photo_dir, $photo) == false && check_filesize($photo) == false && check_filetype($photo_dir, $photo) == false) {
    // Image seems legit, starting upload.
    $photo_explode = explode(".", $photo; // We want to keep the filetype, so we copy everything after the dot.
    $photo_rename = $photo_id . '.' . end($photo_explode); // Creates a variable with id from DB and the filetype.
    move_uploaded_file($photo, "/var/www/fmlab.no/images/" . $photo_rename;

    // if ()) {
    //     echo "The photo: ". basename($photo). " has been uploaded.";
    // } else {
    //     echo "<br>Woops! There was an error uploading your file.";
    // }

} else {
    echo "<br>Warning: Error encountered during file check of the FINISHED picture, halting execution.";
}

}


// // Check if $uploadOk is set to 0 by an error
// if (check == 0) {
//     echo "Sorry, your file was not uploaded.";
// } else {
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }
<?php
/*  Script for uploading pictures to webserver and
    EXIF, information and tags to a local MySQL server. */

// Requiring MySQL DB credentials before continuing.
require 'db-credentials.php'; 

// This is the directories where the images will be stored
$picsmall = "images/small";
$piclarge = "images/large";
// Original copy of the image
$originallarge = $originallarge . basename( $_FILES['Filename']['name']);
$originalsmall = $originalsmall . basename( $_FILES['Filename']['name']);
// Enhanced final edit of the image
$enhancedlarge = $enhancedlarge . basename( $_FILES['Filename']['name']);
$enhancedsmall = $enhancedsmall . basename( $_FILES['Filename']['name']);

// Including EXIF extractor script
$file = $enhancedlarge;
require 'exif-extract.php';

// Including user entered information
$description=$_POST['Filename'];
$Description=$_POST['Description'];
$pic=($_FILES['Filename']['name']);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO photo (`filename`, `original`, `uploaded`)
VALUES ('$file', '$file', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Now photo imported successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$picture_id = mysqli_insert_id( $conn );
echo "<br>Picture ID: " . $picture_id;

$sql = "INSERT INTO photo_exif (`id`, `make`)
VALUES ($picture_id, '$make')";

if ($conn->query($sql) === TRUE) {
    echo "Now photo_exif imported successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
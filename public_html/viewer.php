<!DOCTYPE html>
<html lang="en">

<head>
    <title>FmLab</title>
    <meta charset="utf-8">
    <meta name="author" content="Fredrick Myrvoll">
    <meta name="description" content="Portfolio">

    <link rel="icon" type="image/png" href="images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gallery.css">
</head>

<body>
    <div class="image-viewer">
      <?php 
        $file = $_GET['file'];
        echo "<img src='$file''>"; 
      ?>
    </div>

    <div class="sidebar">
      <div class="exif">
        <?php include "php/exif.php"; ?>
      </div>
    </div>
</body>

</html>
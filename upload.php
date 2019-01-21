<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Description -->
    <meta charset="utf-8">
    <title>fmlab</title>
    <meta name="description" content="Personal Homesite">
    <meta name="author" content="Fredrick Myrvoll">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <!-- Mobile viewport Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS Skeleton Framework-->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/general.css">

</head>

<body>
    <div id="topbar">
        <div id="logo">
            <a href="https://fmlab.no">home</a>
            <a href="gallery.php">gallery</a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="six columns card">
                <b>Original</b><br>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <img src="https://fmlab.no/images/gallery/Large/_FAM8363.jpg" width="100%" value="no picture">
            </div>
            <div class="six columns card">
                <b>Enhanced</b><br>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <img src="https://fmlab.no/images/gallery/Large/_FAM8363-HDR.jpg" width="100%" value="no picture">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="eight columns card">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Username: <input type="text" name="username" size="8"> Password: <input type="password" name="password"
                    size="14">

                <input type="submit" value="Upload Image" name="submit">
            </form>
            </div>
            <div class="four columns card">
                <?php 
                $file = "images/gallery/Large/_FAM8363-HDR.jpg";
                include "exiftest.php"
                ?>
            </div>
        </div>
    </div>
</body>
</html>
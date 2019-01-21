<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Description -->
    <meta charset="utf-8">
    <title>FmLab</title>
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
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="stylesheet" href="css/general.css">

</head>

<body>
    <div id="topbar">
        <div id="logo">
            <a href="https://fmlab.no">home</a>
            <a href="upload.php">upload</a>
        </div>
    </div>  

    <div class="gallery">
    <?php
        $files = glob('images/gallery/Small/*.{jpg,png,gif,JPG}', GLOB_BRACE);

        foreach($files as $file) {
            echo "<a href='viewer.php?file=$file'>";
            echo "<img src='$file'></a>";
        }
    ?>
    </div>



</body>
</html>
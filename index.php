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

    <!-- CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/gallery.css">

</head>

<body>
    <div class="row">
    <div class="eleven columns">
            <h1>Hi, this is the FmLab homepage!</h1>
            <p>This site is under active development. Come back later, where i will share
                some photos and other cool stuff from this site. :)</p>
        </div>
    </div>

    <div class="row">

    <div class="gallery">
    <?php
        $files = glob('images/gallery/Small/*.{jpg,png,gif,JPG}', GLOB_BRACE);

        foreach($files as $file) {
            echo "<img src='$file'>";
        }
    ?>
    </div></div></div>



</body>
</html>
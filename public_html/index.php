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
            <a href="https://portfolio.fmlab.no">home</a>
            <!-- <a href="upload.php">upload</a> -->
        </div>
    </div>  

    <div class="gallery">
    <?php

    $sorted_keys = array();
    $dir_iterator = new DirectoryIterator('./images/gallery/');
    foreach ($dir_iterator as $fileinfo) {
        if ($fileinfo->isFile()) {
            $sorted_keys[$fileinfo->getMTime()] = $fileinfo->key();
        }
    }
    
    ksort($sorted_keys);

    foreach ($sorted_keys as $key) {
        $dir_iterator->seek($key);
        $fileinfo = $dir_iterator->current();

        $image = $fileinfo->getFilename();
        echo "<a href='viewer.php?file=images/gallery/$image'><img src='images/gallery/small/$image'></a>";
    }


    ?>
    </div>



</body>
</html>

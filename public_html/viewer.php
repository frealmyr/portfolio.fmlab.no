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
    <link rel="stylesheet" href="css/general.css">

</head>

<body>
<div id="topbar">
        <div id="logo">
            <a href="https://portfolio.fmlab.no">home</a>
            <!-- <a href="upload.php">upload</a> -->
        </div>
    </div>  

    <div class="container">
        <div class="row">
            <div class="ten columns">
                <div class="image-viewer">
                    <?php 
                    $file = $_GET['file'];
                    echo "<img src='$file''>"; 
                    ?>
                </div>
            </div>

            <div class="two columns">
                <div class="sidebar">
                    <div class="exif">
                    <br>
                        <?php include "exif.php"
                        ?>
                        
                    </div><br>
                    </div>
                

                    <div class=" sidebar description">
                        <h5>Description</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis tempus turpis, sit amet iaculis urna pellentesque in. Donec ipsum purus, lacinia quis purus a, tristique ullamcorper diam. Vivamus sem dolor, mollis id venenatis a, convallis eu nisl. Nam tempus ut turpis vitae auctor. Nunc sed faucibus dolor.</p>
                        <br>
                    </div>
                    </div>
        </div>
</body>

</html>
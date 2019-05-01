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
    <div id="topbar">
        <div id="logo">
            <a href="https://fmlab.no">home</a>
            <a href="gallery.php">gallery</a>
        </div>
    </div>

    <div class="container">
        <form action="php/upload.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="six columns card">
                    <b>Original</b><br>
                    <input type="file" name="fileToUpload">
                    <img src="https://fmlab.no/images/gallery/Large/_FAM8363.jpg" width="100%">
                </div>
                <div class="six columns card">
                    <b>Finished</b><br>
                    <input type="file" name="photo" id="photo">
                    <img src="https://fmlab.no/images/gallery/Large/_FAM8363-HDR.jpg" width="100%">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="eight columns card">

                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title">        
                    <label for="lastName">Description:</label>
                    <input type="text" name="description" id="description">  

                    <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
    <div class="card">
</div>
    
    <div class="four columns card">
        <?php 
            $file = "images/gallery/Large/_FAM8363-HDR.jpg"; // TODO: Update image information using jquery
            include "exiftest.php"
        ?>
    </div>
    </div>
    </div>
</body>

</html>
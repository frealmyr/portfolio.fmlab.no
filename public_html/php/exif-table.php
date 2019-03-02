<?php
/*  Makes use of exif-extract.php to output the EXIF information to a table.
    This script is used during review of a file before upload, so that we
    can get a preview of the EXIF information before uploading. */

/*  Example for using this script:
    https://fmlab.no/php/exif-table.php?file=../images/gallery/Small/23456234567234.jpg */

$file = $_GET['file'];
require 'exif-extract.php';

// Debug: Echoing current 
echo "<strong>EXIF</strong>";
echo "<br>Device: " . $device;
echo "<br>Lens: " . $lens;
echo "<br>Program: " . $program;
echo "<br>Exposure: " . $exposuretime . " sec at ƒ / " . $fnumber;
if ($exposuremode == 1) {
    echo "<br>Exposure Mode: Auto";
} elseif ($exposuremode == 2) {
    echo "<br>Exposure Mode: Manual";
} elseif ($exposuremode == 3) {
    echo "<br>Exposure Mode: Bracket";
}
echo "<br>ISO Speed: " . $isospeed;
echo "<br>Focal Lenght: " . $focallenght . "mm";
echo "<br>Focal Lenght 35mm: " . $focallenght35mm . "mm";
echo "<br>Metering Mode: " . $meteringmode;
echo "<br>Datetime Original: " . $dateoriginal;
echo "<br>Datetime Edited: " . $dateedited;
echo "<br>Resolution: " . $width . "x" . $height;
echo "<br>Brightness Value: " . $brightnessvalue;
echo "<br>Exposure Bias: " . $exposurebiasvalue . " EV";
echo "<br>Software: " . $software;
echo "<br>Altitude: " . $gpsaltitude . "m";
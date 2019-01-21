
<?php
/*  Script for pulling EXIF data from a picture to php variables.
    Depends on a populated $file variable before including the script.
    Script is based on the EXIF 2.3 standard.   */

$exif = exif_read_data($file, 0, true);

// Data is stored within a array, so we loop the contents and store it to variables.
foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {

        // echo "$key.$name: $val<br />\n"; /* Uncomment this line to list all parameters in EXIF. */

        if ($name == 'Make') {
            $make = $val; // Manufactor of the camera.
       
        } elseif ($name == 'Model') {
            $device = $val; // Model number of the camera.
        
        } elseif ($name == 'UndefinedTag:0xA434') {
            $lens = $val; // This undified tag is the product name of the lens.
        
        } elseif ($name == 'ExposureProgram') {
            $program = $val; // Stores as an integer, use MySQL to fetch the description.
        
        } elseif ($name == 'FNumber') {
            $fnumcalc = explode("/", $val); // Splitting string into two fields, so that we can divide.
            $fnumber = ($fnumcalc[0] / $fnumcalc[1]); // We need to divide the first number by the second one.
        
        } elseif ($name == 'ExposureTime') {
            $extimecalc = explode("/", $val);
            if ($extimecalc[1] == 1) {
                $exposuretime = $extimecalc[0]; // If exposure time is over 1sec, we don't need to show /1 after the integer.
            } else {
                $exposuretime = $val; // If the exposure time is under 1 sec, show the full string.
            }
            
        } elseif ($name == 'ISOSpeedRatings') {
            $isospeed = $val; // Stores used ISO as an integer.
        
        } elseif ($name == 'FocalLength') {
            $flcalc = explode("/", $val);
            $focallenght = ($flcalc[0] / $flcalc[1]); // Divides by /1 for compability, in case a manufactor uses something custom in this parameter.
            $focallenght35mm = ($focallenght * 1.5); // States the crop factor for APS-C sensors.
        
        } elseif ($name == 'MeteringMode') {
            $meteringmode = $val; // Stores as an integer, use MySQL to fetch the description.
        
        } elseif ($name == 'DateTimeOriginal') {
            $dateoriginal = strtotime($val); // Converting from str to unixtime
            //$dateoriginal = date('Y-m-d H:i:s', $dateoriginal); // Formatting the datetime for use with MySQL
        
        } elseif ($name == 'DateTime') {
            $dateedited = strtotime($val); // Converting from str to unixtime
            //$dateedited = date('Y-m-d H:i:s', $dateedited); // Formatting the datetime for use with MySQL
        
        } elseif ($name == 'Height') {
            $height = $val;
        
        } elseif ($name == 'Width') {
            $width = $val;
        
        } elseif ($name == 'BrightnessValue') {
            $bvcalc = explode("/", $val);
            $brightnessvalue = ($bvcalc[0] / $bvcalc[1]);            
        
        } elseif ($name == 'ExposureBiasValue') {
            $exbiascalc = explode("/", $val);
            $exposurebiasvalue = ($exbiascalc[0] / $exbiascalc[1]); // Outputs the bias or EV that was used during capture.
        
        } elseif ($name == 'ImageDescription') {
            $imagedescription = $val; // Desc from lightroom etc, used to populate textarea if something is written.
        
        } elseif ($name == 'GPSAltitude') {
            $alticalc = explode("/", $val);
            $gpsaltitude = ($alticalc[0] / $alticalc[1]); // Stores the altitude as a float variable.
        
        } elseif ($name == 'Software') {
            $software = $val;
        
        } elseif ($name == 'ExposureMode') {
            $exposuremode = $val; // Stores as an integer, use MySQL to fetch the description.
        
        } elseif ($name == 'LightSource') {
            $lightsource = $val; // Stores as an integer, use MySQL to fetch the description.
        }
    }
}

// GPS extraction from: https://stackoverflow.com/a/16437888
// GPS data is stored in arrays within the array of the EXIF file.
// This returns $latitude and $longitude float variables.

function getGps($exifCoord, $hemi) {
    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;
    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;
    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);
}

function gps2Num($coordPart) {
    $parts = explode('/', $coordPart);
    if (count($parts) <= 0)
        return 0;

    if (count($parts) == 1)
        return $parts[0];

    return floatval($parts[0]) / floatval($parts[1]);
}

$exif = exif_read_data($file);
$latitude = gps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
$longitude = gps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);

function gps($coordinate, $hemisphere) {
  if (is_string($coordinate)) {
    $coordinate = array_map("trim", explode(",", $coordinate));
  }
  for ($i = 0; $i < 3; $i++) {
    $part = explode('/', $coordinate[$i]);
    if (count($part) == 1) {
      $coordinate[$i] = $part[0];
    } else if (count($part) == 2) {
      $coordinate[$i] = floatval($part[0])/floatval($part[1]);
    } else {
      $coordinate[$i] = 0;
    }
  }
  list($degrees, $minutes, $seconds) = $coordinate;
  $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
  return $sign * ($degrees + $minutes/60 + $seconds/3600);
}
<?php
/*  Script for pulling EXIF data from a picture to php variables.
    Depends on a populated $file variable before including the script.
    Script is based on the EXIF 2.3 standard.   */

$file = $_GET['file'];

$exif = exif_read_data($file, 0, true);
$exif_array = [];

foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {
        // echo "$key.$name: $val<br/>\n"; /* DEBUG: Uncomment this line to list all parameters from EXIF. */

        if ($name == 'Make') {
            // Manufactor of the camera.
            $exif_array['Make'] = $val;

        } elseif ($name == 'Model') {
            // Model number of the camera.
            $exif_array['Model'] = $val;
        
        } elseif ($name == 'UndefinedTag:0xA434') {
            // This undified tag is the product name of the lens.
            $exif_array['Lens'] = $val;
        
        } elseif ($name == 'ExposureProgram') {
            // Exposure program used during shoot
            if ($val == 0) {
                $val = "Not defined";
            } elseif ($val == 1) {
                $val = "Manual";
            } elseif ($val == 2) {
                $val = "Normal program";
            } elseif ($val == 3) {
                $val = "Apertue priority";
            } elseif ($val == 4) {
                $val = "Shutter priority";
            } elseif ($val == 5) {
                $val = "Creative program";
            } elseif ($val == 6) {
                $val = "Action program";
            } elseif ($val == 7) {
                $val = "Portrait mode";
            } elseif ($val == 8) {
                $val = "Landscape mode";
            } else {
                $val = "reserved";
            }
            $exif_array['ExposureProgram'] = $val;
        
        } elseif ($name == 'FNumber') {
            // Focal used, raw is two numbers divided by eachother so we need to convert to float.
            $fnumcalc = explode("/", $val); // Splitting string into two fields, so that we can divide.
            $fnumber = floatval(($fnumcalc[0] / $fnumcalc[1])); // We need to divide the first number by the second one.
            $exif_array['FNumber'] = $fnumber;
        
        } elseif ($name == 'ExposureTime') {
            // Exposure time used, after 1sec there is no need to have /1 so we need to convert that case.
            $extimecalc = explode("/", $val);
            if ($extimecalc[1] == 1) {
                $exposuretime = $extimecalc[0]; // If exposure time is over 1sec, we don't need to show /1 after the integer.
            } else {
                $exposuretime = $val; // If the exposure time is under 1 sec, show the full string.
            }
            $exif_array['ExposureTime'] = $exposuretime;
            
        } elseif ($name == 'ISOSpeedRatings') {
            // Stores used ISO as an integer.
            $exif_array['ISOSpeedRatings'] = $val;

        
        } elseif ($name == 'FocalLength') {
            // Focal lenght used during shoot, conversion for APS-C camera included.
            $flcalc = explode("/", $val);
            $focallenght = ($flcalc[0] / $flcalc[1]); // Divides by /1 for compability, in case a manufactor uses something custom in this parameter.
            $focallenghtaspc = ($focallenght * 1.5); // States the crop factor for APS-C sensors.
            $exif_array['FocalLength'] = $focallenght;
            $exif_array['FocalLengthAPSC'] = $focallenghtaspc;
        
        } elseif ($name == 'MeteringMode') {
            // Stores as an integer, use MySQL to fetch the description.
            if ($val == 0) {
                $val = "unknown";
            } elseif ($val == 1) {
                $val = "Average";
            } elseif ($val == 2) {
                $val = "CenterWeightedAverage";
            } elseif ($val == 3) {
                $val = "Spot";
            } elseif ($val == 4) {
                $val = "MultiSpot";
            } elseif ($val == 5) {
                $val = "Pattern";
            } elseif ($val == 6) {
                $val = "Partial";
            } elseif ($val == 255) {
                $val = "other";
            } else {
                $val = "reserved";
            }
            $exif_array['MeteringMode'] = $val;
        
        } elseif ($name == 'DateTimeOriginal') {
            // Datetime for file creation, reflects when the photo was taken
            $dateoriginal = strtotime($val); // Converting from str to unixtime
            $dateoriginal = date('Y-m-d H:i:s', $dateoriginal); // Formatting the datetime for use with MySQL
            $exif_array['DateTimeOriginal'] = $dateoriginal;
        
        } elseif ($name == 'DateTime') {
            // Datetime for last modify of the file, reflects when the photo was edited
            $dateedited = strtotime($val); // Converting from str to unixtime
            $dateedited = date('Y-m-d H:i:s', $dateedited); // Formatting the datetime for use with MySQL
            $exif_array['DateTime'] = $dateedited;
        
        } elseif ($name == 'Height') {
            $height = $val;
            // $exif_array['Height'] = $val; # Disabled in favor of resolution, see custom EXIF outside loop
        
        } elseif ($name == 'Width') {
            $width = $val;
            // $exif_array['Width'] = $val; # Disabled in favor of resolution, see custom EXIF outside loop
        
        } elseif ($name == 'BrightnessValue') {
            // Used to calucate EV
            $bvcalc = explode("/", $val);
            $brightnessvalue = ($bvcalc[0] / $bvcalc[1]);         
            $exif_array['BrightnessValue'] = $brightnessvalue;
        
        } elseif ($name == 'ExposureBiasValue') {
            $exbiascalc = explode("/", $val);
            $exposurebiasvalue = ($exbiascalc[0] / $exbiascalc[1]); // Outputs the bias or EV that was used during capture.
            $exif_array['ExposureBiasValue'] = $exposurebiasvalue;

        } elseif ($name == 'ImageDescription') {
            // Desc from lightroom etc, used to populate textarea if something is written.
            $exif_array['ImageDescription'] = $val;

        } elseif ($name == 'GPSAltitude') {
            $alticalc = explode("/", $val);
            $gpsaltitude = ($alticalc[0] / $alticalc[1]); // Stores the altitude as a float variable.
            $exif_array['GPSAltitude'] = $val;

        } elseif ($name == 'Software') {
            $exif_array['Software'] = $val;
        
        } elseif ($name == 'ExposureMode') {
            if ($val == 0) {
                $val = "Auto exposure";
            } elseif ($val == 1) {
                $val = "Manual exposure";
            } elseif ($val == 2) {
                $val = "Auto bracket";
            } else {
                $val = "reserved";
            }
            $exif_array['ExposureMode'] = $val;

        } elseif ($name == 'LightSource') {
            if ($val == 0) {
                $val = "Auto";
            } elseif ($val == 1) {
                $val = "Daylight";
            } elseif ($val == 2) {
                $val = "Fluorscent";
            } elseif ($val == 3) {
                $val = "Tungsten";
            } elseif ($val == 3) {
                $val = "Flash";
            } elseif ($val == 9) {
                $val = "Fine weather";
            } elseif ($val == 10) {
                $val = "Cloudy weather";
            } elseif ($val == 11) {
                $val = "Shade";
            } elseif ($val == 12) {
                $val = "Daylight fluorescent";
            } elseif ($val == 13) {
                $val = "Day white fluorscent";
            } elseif ($val == 14) {
                $val = "Cool white fluorscen";
            } elseif ($val == 15) {
                $val = "White fluorscent";
            } elseif ($val == 16) {
                $val = "Warm white fluorscent";
            } elseif ($val == 17) {
                $val = "Standard light A";
            } elseif ($val == 18) {
                $val = "Standard light B";
            } elseif ($Val == 19) {
                $val = "Standard light C";
            } elseif ($val == 20) {
                $val = "D55";
            } elseif ($val == 21) {
                $var = "D65";
            } elseif ($val == 22) {
                $var = "D75";
            } elseif ($val == 23) {
                $var = "D50";
            } elseif ($val == 24) {
                $var = "ISO studio tungsten";
            } elseif ($val == 255) {
                $var = "other light source";
            } else {
                $var = "reserved";
            }
            $exif_array['LightSource'] = $val;
        }
    }
}

// Custom EXIF entries
$exif_array['Resolution'] = $width . "x" . $height;

// print_r(array_keys($exif_array));
foreach($exif_array as $key => $value) {
    echo "$key: [$value] <br>";
}

/* GPS extraction from https://stackoverflow.com/a/16437888
   Since GPS data is stored in arrays within the EXIF file, we need to extract and transform the data to float values.
   This returns $latitude and $longitude float variables. */

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

$exif = exif_read_data($file);
if (!$exif["GPSLatitude"] == NULL) {
	$latitude = gps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
    $longitude = gps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
    $exif_array['Latitude'] = $latitude;
    $exif_array['Longitude'] = $longitude;
}

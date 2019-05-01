<?php

    $sorted_keys = array();
    $dir_iterator = new DirectoryIterator('./images/gallery/');
    foreach ($dir_iterator as $fileinfo) {
        if ($fileinfo->isFile()) {
            $sorted_keys[$fileinfo->getCTime()] = $fileinfo->key();
        }
    }
    
    ksort($sorted_keys);

    foreach ($sorted_keys as $key) {
        $dir_iterator->seek($key);
        $fileinfo = $dir_iterator->current();

        $image = $fileinfo->getFilename();
        echo "<a href='viewer.php?file=images/gallery/$image'><img src='images/gallery/small/$image'></a>";
    }
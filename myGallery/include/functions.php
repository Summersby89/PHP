<?php

function getRandomFileName($path)
{
    $path = $path ? $path . '/' : '';

    do {
        $name = md5(microtime() . rand(0, 9999));
        $file = $path . $name;
    } while (file_exists($file));

    return $name;
}

function cutString($line, $length = 12, $appends = '...')
{
            return mb_strimwidth ($line, 0, $length + 3, $appends);
}

function getSize($image) 
{
    if (filesize($image) < 10000) {
        return round(filesize($image), 2).' B';
    } elseif (filesize($image) < 1000000) {
        return round(filesize($image) / 1000, 2) .' Kb';
    }
        return round(filesize($image) / 1000000, 2) .' Mb';
}    
  
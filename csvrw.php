<?php


// reads the csv file and returns an array of the data, optionally with the first row as the keys for an associative array
function csv_read($file, bool $relative = false) {
    $fp = fopen($file, 'r');
    while (!feof($fp)) {
        $data = fgetcsv($fp);
        if ($data === false) continue;
        $csv[] = $data;
    }

    //optional associative array
    if ($relative) {
        $header = array_shift($csv);
        for ($i = 0; $i < count($csv); $i++) {
            for ($j = 0; $j < count($csv[$i]); $j++) {
                $csv[$i][$header[$j]] = $csv[$i][$j];
                unset($csv[$i][$j]);
            }
        }
    }
    
    fclose($fp);
    return $csv;
}

// will write an array of data to a csv file appending to previous data
function csv_write($data, $file) : bool {
    $fp = fopen($file, 'w');
    foreach ($data as $fields) {
        fputcsv($fp, $fields);
    }
    fclose($fp);
    return true;
}



<?php


function binary_search_in_file($filename, $search) {

$fp = fopen($filename, 'r');

fseek($fp, 0, SEEK_END);

$high = ftell($fp);
$low = 0;
$step = 0;
while ($low <= $high) {
    echo '<br>';
    $step+=1;
    echo 'шаг '.$step.'<br>';
    echo 'high: '.$high.'<br>';
    echo 'low: '.$low.'<br>';

    $mid = floor(($low + $high) / 2); 

    fseek($fp, $mid);

    if($mid != 0){
        //Read a line to move to end of line
        $line = fgets($fp);
    }
     //Read a line to get whole line
    $line = trim(fgets($fp));
    // extracting key & value
    $line = preg_split("/[\t]/", $line);
    $key = $line[0];
    $val = $line[1];
    echo 'key: '.$key.'<br>';
    echo 'ищем: '.$search.'<br>';
    echo 'cовпадает? '.json_encode($key == $search).'<br>';

    if ($key == $search) {
        fclose($fp);
        return $val;
    }
    else {
        if ($search < $key) {
            $high = $mid - 1;
        }
        else {
            $low = $mid + 1;
        }
    }
}

fclose($fp);

// return FALSE;

}

$dir =  $_SERVER['DOCUMENT_ROOT'];
$file = 'dict_keyed.txt';

$q = 'absorb'; 
    
$binary = binary_search_in_file($dir.'\\'.$file, $q);

echo '<br>';
if ($binary == FALSE)
    echo 'ничего не ';

echo 'найдено: '.$binary.'<br>';    
    
echo 'для ключа: '.$q.'<br>';

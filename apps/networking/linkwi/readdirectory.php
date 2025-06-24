<?php
$arrFiles = array();
$handle = opendir('logins');
 
if ($handle) {
    $dir = array();
    while (($entry = readdir($handle)) !== FALSE) {
        if($entry != "." && $entry != ".." && $entry != "index.php")
        echo "<option>$entry<option>";
        $dir[] = $entry;
    }
}
 
closedir($handle);

//print_r($dir);

echo $dir[2]
?>
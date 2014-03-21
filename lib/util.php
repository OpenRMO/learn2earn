<?php

function getFriendlyData($unfriendlyDataArray, $return = true) {
    $returnArray = Array();
    foreach ($unfriendlyDataArray as $array) {
        $returnArray[$array[0]] = $array[1];
    }
    if ($return) {
        return $returnArray;
    } else {
        print_r($returnArray);
    }
}

?>

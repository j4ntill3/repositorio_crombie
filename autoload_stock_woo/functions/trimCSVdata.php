<?php
function trimCSVdata($array) {
    foreach ($array as &$value) {
        if (is_array($value)) {
            $value = trimCSVdata($value);
        } else {
            $value = trim($value);
        }
    }
    return $array;
}
?>
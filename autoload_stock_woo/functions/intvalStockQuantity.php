<?php

function intvalStockQuantity(&$array) {
    foreach ($array as $key => &$value) {
        if (is_array($value)) {
            $value = intvalStockQuantity($value);
        } else {
            $value = ($key === 7) ? intval($value) : $value;
        }
    }
    return $array;
}

?>
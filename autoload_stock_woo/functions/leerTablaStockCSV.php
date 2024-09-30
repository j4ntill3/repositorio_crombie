<?php

require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/functions/trimCSVdata.php');
require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/functions/intvalStockQuantity.php');

function leerTablaStockCSV($csv_file){

    $block_size = 1024;
    

    $file_handle = fopen($csv_file, 'r');
        

    $csv_data = array();
        

    fgetcsv($file_handle);
        

    while (($block = fgets($file_handle, $block_size)) !== false) {
        
        $lines = str_getcsv($block, "\n");
        

        foreach ($lines as $line) {
            if (!empty(trim($line))) {
                $data = str_getcsv($line, ","); 
        
                $csv_data[] = $data;
                }
            }
        }
        
    fclose($file_handle);

    $csv_data = trimCSVdata($csv_data);

    $csv_data = intvalStockQuantity($csv_data);

    return $csv_data;
}

?>

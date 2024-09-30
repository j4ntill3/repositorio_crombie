<?php
require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/functions/leerTablaStockCSV.php');
require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/functions/leerTablaImagenesCSV.php');

//direcciones donde se encuentran los archivos CSV
$csv_stock = '/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/upload-folder/csv/csv-stock/upload-stock.csv';
$csv_img = '/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/upload-folder/csv/csv-img/upload-img.csv';
$folder_img = 'spiazziweb.com.ar/public_html/wp-content/autoload-stock/upload-folder/product-images';
$stock = leerTablaStockCSV($csv_stock);
$img = leerTablaImagenesCSV($csv_img);

?>

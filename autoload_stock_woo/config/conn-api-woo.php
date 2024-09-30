<?php
require '/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/vendor/autoload.php';
use Automattic\WooCommerce\Client;

$produccion = 'https://spiazziweb.com.ar/';
$testing = '';


$connWOO = new Client(
    $produccion,
    'ck_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'cs_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    [
        'wp_api' => true,
        'version' => 'wc/v3'
    ]
);
?>

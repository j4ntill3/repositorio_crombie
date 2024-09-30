<?php

require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/models/M_Categoria.php');

class M_Jerarquia{
    
    private $cat_padre;
    private $cat_hija;


    public function __construct($ID_PADRE,$NOMBRE_PADRE,$ID_HIJA,$NOMBRE_HIJA){

        $this->cat_padre = new M_Categoria($ID_PADRE,$NOMBRE_PADRE,0);
        $this->cat_hija = new M_Categoria($ID_HIJA,$NOMBRE_HIJA,$ID_PADRE);

    }

    public function getCatPadre(){
        return $this->cat_padre;
    }

    public function getCatHija(){
        return $this->cat_hija;
    }



}

?>

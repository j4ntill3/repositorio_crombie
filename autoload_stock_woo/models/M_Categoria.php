<?php

class M_Categoria{

    private $id_woo;
    private $nombre;
    private $id_woo_padre;
    

    public function __construct($ID_WOO,$NOMBRE,$ID_PADRE){
        $this->id_woo = $ID_WOO;
        $this->nombre = $NOMBRE;
        $this->id_woo_padre = $ID_PADRE;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setIdWoo($id_woo){
        $this->id_woo = $id_woo;
    }

    public function getIdWoo(){
        return $this->id_woo;
    }

    public function setIdWooPadre($id_woo_padre){
        $this->id_woo_padre = $id_woo_padre;
    }

    public function getIdWooPadre(){
        return $this->id_woo_padre;
    }
    
}


?>
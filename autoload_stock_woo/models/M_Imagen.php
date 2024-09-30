<?php

class M_Imagen{
    
    private $sku;
    private $name;
    private $src;
    private $path;


    public function __construct($SKU,$NAME,$SRC){
        $this->sku = $SKU;
        $this->name = $NAME;
        $this->src = $SRC;
        $this->path = str_replace("http://","/home/",$SRC['src']);
    }

    public function getSku(){
        return $this->sku;
    }

    public function getName(){
        return $this->name;
    }

    public function getSrc(){
        return $this->src;
    }
    
    public function getPath(){
        return $this->path;
    }


}

?>
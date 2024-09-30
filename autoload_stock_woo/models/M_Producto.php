<?php

class M_Producto{
    
    public $sku;
    public $name;
    public $short_description;
    public $regular_price;
    public $stock_quantity;
    public $categories = array();
    public $images = array();
    public $brand;
    
    public function __construct($SKU,$NAME,$SHORT_DESCRIPTION,$REGULAR_PRICE,$STOCK_QUANTITY,$BRAND,$CATEGORIES,$IMAGES){
        $this->sku = $SKU;
        $this->name = $NAME;
        $this->short_description = $SHORT_DESCRIPTION;
        $this->regular_price = $REGULAR_PRICE;
        $this->stock_quantity = $STOCK_QUANTITY;
        $this->brand = $BRAND;
        $this->categories = $CATEGORIES;
        $this->images = $IMAGES;
        
    }

    public function setSku($sku){
        $this->sku = $sku;
    }

    public function getSku(){
        return $this->sku;
    }
    
    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setShortDescription($short_description){
        $this->short_description = $short_description;
    }

    public function getShortDescription(){
        return $this->short_description;
    }

    public function setRegularPrice($regular_price){
        $this->regular_price = $regular_price;
    }

    public function getRegularPrice(){
        return $this->regular_price;
    }

    public function setStockQuantity($stock_quantity){
        $this->stock_quantity = $stock_quantity;
    }

    public function getStockQuantity(){
        return $this->stock_quantity;
    }

    public function setBrand($brand){
        $this->brand = $brand;
    }

    public function getBrand(){
        return $this->brand;
    }

    public function setCategories($categories){
        $this->categories = $categories;
    }

    public function getCategories(){
        return $this->categories;
    }

    public function setImages($images){
        $this->categories = $images;
    }

    public function getImages(){
        return $this->images;
    }

}
    
?>
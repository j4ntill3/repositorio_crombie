<?php

class m_cesig_seg_escribanofuncion {

    private $id;
    private $creationtimestamp;
    private $creationuser;
    private $deleted;
    private $modificationtimestamp;
    private $modificationuser;
    private $versionnumber;
    private $fechaalta;
    private $fechabaja;
    private $idescribano;
    private $idfuncion;
    private $registro;

    // Constructor
    public function __construct($id, $creationtimestamp, $creationuser, $deleted, $modificationtimestamp, $modificationuser, $versionnumber, $fechaalta, $fechabaja, $idescribano, $idfuncion, $registro) {
        $this->id = $id;
        $this->creationtimestamp = $creationtimestamp;
        $this->creationuser = $creationuser;
        $this->deleted = $deleted;
        $this->modificationtimestamp = $modificationtimestamp;
        $this->modificationuser = $modificationuser;
        $this->versionnumber = $versionnumber;
        $this->fechaalta = $fechaalta;
        $this->fechabaja = $fechabaja;
        $this->idescribano = $idescribano;
        $this->idfuncion = $idfuncion;
        $this->registro = $registro;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getCreationtimestamp() {
        return $this->creationtimestamp;
    }

    public function getCreationuser() {
        return $this->creationuser;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function getModificationtimestamp() {
        return $this->modificationtimestamp;
    }

    public function getModificationuser() {
        return $this->modificationuser;
    }

    public function getVersionnumber() {
        return $this->versionnumber;
    }

    public function getFechaalta() {
        return $this->fechaalta;
    }

    public function getFechabaja() {
        return $this->fechabaja;
    }

    public function getIdescribano() {
        return $this->idescribano;
    }

    public function getIdfuncion() {
        return $this->idfuncion;
    }

    public function getRegistro() {
        return $this->registro;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setCreationtimestamp($creationtimestamp) {
        $this->creationtimestamp = $creationtimestamp;
    }

    public function setCreationuser($creationuser) {
        $this->creationuser = $creationuser;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function setModificationtimestamp($modificationtimestamp) {
        $this->modificationtimestamp = $modificationtimestamp;
    }

    public function setModificationuser($modificationuser) {
        $this->modificationuser = $modificationuser;
    }

    public function setVersionnumber($versionnumber) {
        $this->versionnumber = $versionnumber;
    }

    public function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    public function setFechabaja($fechabaja) {
        $this->fechabaja = $fechabaja;
    }

    public function setIdescribano($idescribano) {
        $this->idescribano = $idescribano;
    }

    public function setIdfuncion($idfuncion) {
        $this->idfuncion = $idfuncion;
    }

    public function setRegistro($registro) {
        $this->registro = $registro;
    }
}


?>
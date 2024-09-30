<?php

class m_cesig_pad_cuenta {

    private $id;
    private $versionnumber;
    private $creationtimestamp;
    private $creationuser;
    private $modificationtimestamp;
    private $modificationuser;
    private $deleted;
    private $numerocuenta;
    private $nombretitular;
    private $cuittitular;
    private $idtipopersona;

    // Constructor
    public function __construct($id, $versionnumber, $creationtimestamp, $creationuser, $modificationtimestamp, $modificationuser, $deleted, $numerocuenta, $nombretitular, $cuittitular, $idtipopersona) {
        $this->id = $id;
        $this->versionnumber = $versionnumber;
        $this->creationtimestamp = $creationtimestamp;
        $this->creationuser = $creationuser;
        $this->modificationtimestamp = $modificationtimestamp;
        $this->modificationuser = $modificationuser;
        $this->deleted = $deleted;
        $this->numerocuenta = $numerocuenta;
        $this->nombretitular = $nombretitular;
        $this->cuittitular = $cuittitular;
        $this->idtipopersona = $idtipopersona;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getVersionnumber() {
        return $this->versionnumber;
    }

    public function getCreationtimestamp() {
        return $this->creationtimestamp;
    }

    public function getCreationuser() {
        return $this->creationuser;
    }

    public function getModificationtimestamp() {
        return $this->modificationtimestamp;
    }

    public function getModificationuser() {
        return $this->modificationuser;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function getNumerocuenta() {
        return $this->numerocuenta;
    }

    public function getNombretitular() {
        return $this->nombretitular;
    }

    public function getCuittitular() {
        return $this->cuittitular;
    }

    public function getIdtipopersona() {
        return $this->idtipopersona;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setVersionnumber($versionnumber) {
        $this->versionnumber = $versionnumber;
    }

    public function setCreationtimestamp($creationtimestamp) {
        $this->creationtimestamp = $creationtimestamp;
    }

    public function setCreationuser($creationuser) {
        $this->creationuser = $creationuser;
    }

    public function setModificationtimestamp($modificationtimestamp) {
        $this->modificationtimestamp = $modificationtimestamp;
    }

    public function setModificationuser($modificationuser) {
        $this->modificationuser = $modificationuser;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function setNumerocuenta($numerocuenta) {
        $this->numerocuenta = $numerocuenta;
    }

    public function setNombretitular($nombretitular) {
        $this->nombretitular = $nombretitular;
    }

    public function setCuittitular($cuittitular) {
        $this->cuittitular = $cuittitular;
    }

    public function setIdtipopersona($idtipopersona) {
        $this->idtipopersona = $idtipopersona;
    }
}

?>
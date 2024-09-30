<?php

class m_cesig_pad_personadomicilio {

    private $id;
    private $idpersona;
    private $idtipodomicilio;
    private $fechadesde;
    private $domicilio;
    private $idlocalidad;
    private $creationtimestamp;
    private $creationuser;
    private $deleted;
    private $modificationtimestamp;
    private $modificationuser;
    private $versionnumber;
    private $secuencia;

    // Constructor
    public function __construct($id, $idpersona, $idtipodomicilio, $fechadesde, $domicilio, $idlocalidad, $creationtimestamp, $creationuser, $deleted, $modificationtimestamp, $modificationuser, $versionnumber, $secuencia) {
        $this->id = $id;
        $this->idpersona = $idpersona;
        $this->idtipodomicilio = $idtipodomicilio;
        $this->fechadesde = $fechadesde;
        $this->domicilio = $domicilio;
        $this->idlocalidad = $idlocalidad;
        $this->creationtimestamp = $creationtimestamp;
        $this->creationuser = $creationuser;
        $this->deleted = $deleted;
        $this->modificationtimestamp = $modificationtimestamp;
        $this->modificationuser = $modificationuser;
        $this->versionnumber = $versionnumber;
        $this->secuencia = $secuencia;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdpersona() {
        return $this->idpersona;
    }

    public function getIdtipodomicilio() {
        return $this->idtipodomicilio;
    }

    public function getFechadesde() {
        return $this->fechadesde;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getIdlocalidad() {
        return $this->idlocalidad;
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

    public function getSecuencia() {
        return $this->secuencia;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdpersona($idpersona) {
        $this->idpersona = $idpersona;
    }

    public function setIdtipodomicilio($idtipodomicilio) {
        $this->idtipodomicilio = $idtipodomicilio;
    }

    public function setFechadesde($fechadesde) {
        $this->fechadesde = $fechadesde;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    public function setIdlocalidad($idlocalidad) {
        $this->idlocalidad = $idlocalidad;
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

    public function setSecuencia($secuencia) {
        $this->secuencia = $secuencia;
    }
}

?>
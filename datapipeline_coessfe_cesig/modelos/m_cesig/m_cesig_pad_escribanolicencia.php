<?php

class m_pgsql_pad_escribanolicencia {
    private $id;
    private $idescribano;
    private $idescribanolicencia;
    private $fechadesde;
    private $fechahasta;
    private $fechalevanta;
    private $observacion;
    private $esactiva;
    private $creationtimestamp;
    private $creationuser;
    private $modificationtimestamp;
    private $modificationuser;
    private $versionnumber;
    private $deleted;

    // Constructor
    public function __construct($registro_cesig) {
        $this->id = $registro_cesig['id'];
        $this->idescribano = $registro_cesig['idescribano'];
        $this->idescribanolicencia = $registro_cesig['idescribanolicencia'];
        $this->fechadesde = $registro_cesig['fechadesde'];
        $this->fechahasta = $registro_cesig['fechahasta'];
        $this->fechalevanta = $registro_cesig['fechalevanta'];
        $this->observacion = $registro_cesig['observacion'];
        $this->esactiva = $registro_cesig['esactiva'];
        $this->creationtimestamp = $registro_cesig['creationtimestamp'];
        $this->creationuser = $registro_cesig['creationuser'];
        $this->modificationtimestamp = $registro_cesig['modificationtimestamp'];
        $this->modificationuser = $registro_cesig['modificationuser'];
        $this->versionnumber = $registro_cesig['versionnumber'];
        $this->deleted = $registro_cesig['deleted'];
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdescribano() {
        return $this->idescribano;
    }

    public function getIdescribanolicencia() {
        return $this->idescribanolicencia;
    }

    public function getFechadesde() {
        return $this->fechadesde;
    }

    public function getFechahasta() {
        return $this->fechahasta;
    }

    public function getFechalevanta() {
        return $this->fechalevanta;
    }

    public function getObservacion() {
        return $this->observacion;
    }

    public function getEsactiva() {
        return $this->esactiva;
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

    public function getVersionnumber() {
        return $this->versionnumber;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdescribano($idescribano) {
        $this->idescribano = $idescribano;
    }

    public function setIdescribanolicencia($idescribanolicencia) {
        $this->idescribanolicencia = $idescribanolicencia;
    }

    public function setFechadesde($fechadesde) {
        $this->fechadesde = $fechadesde;
    }

    public function setFechahasta($fechahasta) {
        $this->fechahasta = $fechahasta;
    }

    public function setFechalevanta($fechalevanta) {
        $this->fechalevanta = $fechalevanta;
    }

    public function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    public function setEsactiva($esactiva) {
        $this->esactiva = $esactiva;
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

    public function setVersionnumber($versionnumber) {
        $this->versionnumber = $versionnumber;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }
}


?>
<?php

class m_cesig_pad_escribanosancion {

    private $id;
    private $idescribano;
    private $idtiposancion;
    private $idtiposubsancion;
    private $fechadesde;
    private $fechahasta;
    private $fechalevanta;
    private $numerointerno;
    private $idtipoexpediente;
    private $numeroexpediente;
    private $observacion;
    private $esactiva;
    private $creationtimestamp;
    private $creationuser;
    private $modificationtimestamp;
    private $modificationuser;
    private $versionnumber;
    private $deleted;

    // Constructor
    public function __construct($id, $idescribano, $idtiposancion, $idtiposubsancion, $fechadesde, $fechahasta, $fechalevanta, $numerointerno, $idtipoexpediente, $numeroexpediente, $observacion, $esactiva, $creationtimestamp, $creationuser, $modificationtimestamp, $modificationuser, $versionnumber, $deleted) {
        $this->id = $id;
        $this->idescribano = $idescribano;
        $this->idtiposancion = $idtiposancion;
        $this->idtiposubsancion = $idtiposubsancion;
        $this->fechadesde = $fechadesde;
        $this->fechahasta = $fechahasta;
        $this->fechalevanta = $fechalevanta;
        $this->numerointerno = $numerointerno;
        $this->idtipoexpediente = $idtipoexpediente;
        $this->numeroexpediente = $numeroexpediente;
        $this->observacion = $observacion;
        $this->esactiva = $esactiva;
        $this->creationtimestamp = $creationtimestamp;
        $this->creationuser = $creationuser;
        $this->modificationtimestamp = $modificationtimestamp;
        $this->modificationuser = $modificationuser;
        $this->versionnumber = $versionnumber;
        $this->deleted = $deleted;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdescribano() {
        return $this->idescribano;
    }

    public function getIdtiposancion() {
        return $this->idtiposancion;
    }

    public function getIdtiposubsancion() {
        return $this->idtiposubsancion;
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

    public function getNumerointerno() {
        return $this->numerointerno;
    }

    public function getIdtipoexpediente() {
        return $this->idtipoexpediente;
    }

    public function getNumeroexpediente() {
        return $this->numeroexpediente;
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

    public function setIdtiposancion($idtiposancion) {
        $this->idtiposancion = $idtiposancion;
    }

    public function setIdtiposubsancion($idtiposubsancion) {
        $this->idtiposubsancion = $idtiposubsancion;
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

    public function setNumerointerno($numerointerno) {
        $this->numerointerno = $numerointerno;
    }

    public function setIdtipoexpediente($idtipoexpediente) {
        $this->idtipoexpediente = $idtipoexpediente;
    }

    public function setNumeroexpediente($numeroexpediente) {
        $this->numeroexpediente = $numeroexpediente;
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
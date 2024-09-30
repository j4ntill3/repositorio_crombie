<?php

class m_cesig_seg_empleadofuncion {
    private $id;
    private $creationTimestamp;
    private $creationUser;
    private $deleted;
    private $modificationTimestamp;
    private $modificationUser;
    private $versionNumber;
    private $fechaAlta;
    private $fechaBaja;
    private $idEmpleado;
    private $idFuncion;
    private $idCausaBajaEmpleado;

    // Constructor
    public function __construct(
        $id,
        $creationTimestamp,
        $creationUser,
        $deleted,
        $modificationTimestamp,
        $modificationUser,
        $versionNumber,
        $fechaAlta,
        $fechaBaja,
        $idEmpleado,
        $idFuncion,
        $idCausaBajaEmpleado
    ) {
        $this->id = $id;
        $this->creationTimestamp = $creationTimestamp;
        $this->creationUser = $creationUser;
        $this->deleted = $deleted;
        $this->modificationTimestamp = $modificationTimestamp;
        $this->modificationUser = $modificationUser;
        $this->versionNumber = $versionNumber;
        $this->fechaAlta = $fechaAlta;
        $this->fechaBaja = $fechaBaja;
        $this->idEmpleado = $idEmpleado;
        $this->idFuncion = $idFuncion;
        $this->idCausaBajaEmpleado = $idCausaBajaEmpleado;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getCreationTimestamp() {
        return $this->creationTimestamp;
    }

    public function getCreationUser() {
        return $this->creationUser;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function getModificationTimestamp() {
        return $this->modificationTimestamp;
    }

    public function getModificationUser() {
        return $this->modificationUser;
    }

    public function getVersionNumber() {
        return $this->versionNumber;
    }

    public function getFechaAlta() {
        return $this->fechaAlta;
    }

    public function getFechaBaja() {
        return $this->fechaBaja;
    }

    public function getIdEmpleado() {
        return $this->idEmpleado;
    }

    public function getIdFuncion() {
        return $this->idFuncion;
    }

    public function getIdCausaBajaEmpleado() {
        return $this->idCausaBajaEmpleado;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setCreationTimestamp($creationTimestamp) {
        $this->creationTimestamp = $creationTimestamp;
    }

    public function setCreationUser($creationUser) {
        $this->creationUser = $creationUser;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function setModificationTimestamp($modificationTimestamp) {
        $this->modificationTimestamp = $modificationTimestamp;
    }

    public function setModificationUser($modificationUser) {
        $this->modificationUser = $modificationUser;
    }

    public function setVersionNumber($versionNumber) {
        $this->versionNumber = $versionNumber;
    }

    public function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    public function setFechaBaja($fechaBaja) {
        $this->fechaBaja = $fechaBaja;
    }

    public function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    public function setIdFuncion($idFuncion) {
        $this->idFuncion = $idFuncion;
    }

    public function setIdCausaBajaEmpleado($idCausaBajaEmpleado) {
        $this->idCausaBajaEmpleado = $idCausaBajaEmpleado;
    }
}

?>
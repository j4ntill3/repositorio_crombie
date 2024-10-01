<?php

class m_cesig_pad_cuentatitular {
    private $id;
    private $versionNumber;
    private $creationTimestamp;
    private $creationUser;
    private $modificationTimestamp;
    private $modificationUser;
    private $deleted;
    private $idCuenta;
    private $idPersona;

    // Constructor
    public function __construct(
        $id,
        $versionNumber,
        $creationTimestamp,
        $creationUser,
        $modificationTimestamp,
        $modificationUser,
        $deleted,
        $idCuenta,
        $idPersona
    ) {
        $this->id = $id;
        $this->versionNumber = $versionNumber;
        $this->creationTimestamp = $creationTimestamp;
        $this->creationUser = $creationUser;
        $this->modificationTimestamp = $modificationTimestamp;
        $this->modificationUser = $modificationUser;
        $this->deleted = $deleted;
        $this->idCuenta = $idCuenta;
        $this->idPersona = $idPersona;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getVersionNumber() {
        return $this->versionNumber;
    }

    public function getCreationTimestamp() {
        return $this->creationTimestamp;
    }

    public function getCreationUser() {
        return $this->creationUser;
    }

    public function getModificationTimestamp() {
        return $this->modificationTimestamp;
    }

    public function getModificationUser() {
        return $this->modificationUser;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function getIdCuenta() {
        return $this->idCuenta;
    }

    public function getIdPersona() {
        return $this->idPersona;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setVersionNumber($versionNumber) {
        $this->versionNumber = $versionNumber;
    }

    public function setCreationTimestamp($creationTimestamp) {
        $this->creationTimestamp = $creationTimestamp;
    }

    public function setCreationUser($creationUser) {
        $this->creationUser = $creationUser;
    }

    public function setModificationTimestamp($modificationTimestamp) {
        $this->modificationTimestamp = $modificationTimestamp;
    }

    public function setModificationUser($modificationUser) {
        $this->modificationUser = $modificationUser;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function setIdCuenta($idCuenta) {
        $this->idCuenta = $idCuenta;
    }

    public function setIdPersona($idPersona) {
        $this->idPersona = $idPersona;
    }
}

?>
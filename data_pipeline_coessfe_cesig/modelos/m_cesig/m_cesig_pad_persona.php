<?php

class m_cesig_pad_persona {
    private $id;
    private $creationTimestamp;
    private $creationUser;
    private $deleted;
    private $modificationTimestamp;
    private $modificationUser;
    private $versionNumber;
    private $apellido1;
    private $apellido2;
    private $cuit;
    private $mailOficial;
    private $nombre1;
    private $nombre2;
    private $nombre3;
    private $razonSocial;
    private $sexo;
    private $apellidoNombreConyuge;
    private $localidadNacimiento;
    private $idPaisNacimiento;
    private $fechaNacimiento;
    private $idTipoDoc;
    private $numeroDocumento;
    private $idEstadoCivil;
    private $ingresosBrutos;
    private $idCondicionIVA;

    // Constructor
    public function __construct(
        $id,
        $creationTimestamp,
        $creationUser,
        $deleted,
        $modificationTimestamp,
        $modificationUser,
        $versionNumber,
        $apellido1,
        $apellido2,
        $cuit,
        $mailOficial,
        $nombre1,
        $nombre2,
        $nombre3,
        $razonSocial,
        $sexo,
        $apellidoNombreConyuge,
        $localidadNacimiento,
        $idPaisNacimiento,
        $fechaNacimiento,
        $idTipoDoc,
        $numeroDocumento,
        $idEstadoCivil,
        $ingresosBrutos,
        $idCondicionIVA
    ) {
        $this->id = $id;
        $this->creationTimestamp = $creationTimestamp;
        $this->creationUser = $creationUser;
        $this->deleted = $deleted;
        $this->modificationTimestamp = $modificationTimestamp;
        $this->modificationUser = $modificationUser;
        $this->versionNumber = $versionNumber;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->cuit = $cuit;
        $this->mailOficial = $mailOficial;
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
        $this->nombre3 = $nombre3;
        $this->razonSocial = $razonSocial;
        $this->sexo = $sexo;
        $this->apellidoNombreConyuge = $apellidoNombreConyuge;
        $this->localidadNacimiento = $localidadNacimiento;
        $this->idPaisNacimiento = $idPaisNacimiento;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idTipoDoc = $idTipoDoc;
        $this->numeroDocumento = $numeroDocumento;
        $this->idEstadoCivil = $idEstadoCivil;
        $this->ingresosBrutos = $ingresosBrutos;
        $this->idCondicionIVA = $idCondicionIVA;
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

    public function getApellido1() {
        return $this->apellido1;
    }

    public function getApellido2() {
        return $this->apellido2;
    }

    public function getCuit() {
        return $this->cuit;
    }

    public function getMailOficial() {
        return $this->mailOficial;
    }

    public function getNombre1() {
        return $this->nombre1;
    }

    public function getNombre2() {
        return $this->nombre2;
    }

    public function getNombre3() {
        return $this->nombre3;
    }

    public function getRazonSocial() {
        return $this->razonSocial;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getApellidoNombreConyuge() {
        return $this->apellidoNombreConyuge;
    }

    public function getLocalidadNacimiento() {
        return $this->localidadNacimiento;
    }

    public function getIdPaisNacimiento() {
        return $this->idPaisNacimiento;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getIdTipoDoc() {
        return $this->idTipoDoc;
    }

    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    public function getIdEstadoCivil() {
        return $this->idEstadoCivil;
    }

    public function getIngresosBrutos() {
        return $this->ingresosBrutos;
    }

    public function getIdCondicionIVA() {
        return $this->idCondicionIVA;
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

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    public function setCuit($cuit) {
        $this->cuit = $cuit;
    }

    public function setMailOficial($mailOficial) {
        $this->mailOficial = $mailOficial;
    }

    public function setNombre1($nombre1) {
        $this->nombre1 = $nombre1;
    }

    public function setNombre2($nombre2) {
        $this->nombre2 = $nombre2;
    }

    public function setNombre3($nombre3) {
        $this->nombre3 = $nombre3;
    }

    public function setRazonSocial($razonSocial) {
        $this->razonSocial = $razonSocial;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setApellidoNombreConyuge($apellidoNombreConyuge) {
        $this->apellidoNombreConyuge = $apellidoNombreConyuge;
    }

    public function setLocalidadNacimiento($localidadNacimiento) {
        $this->localidadNacimiento = $localidadNacimiento;
    }

    public function setIdPaisNacimiento($idPaisNacimiento) {
        $this->idPaisNacimiento = $idPaisNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setIdTipoDoc($idTipoDoc) {
        $this->idTipoDoc = $idTipoDoc;
    }

    public function setNumeroDocumento($numeroDocumento) {
        $this->numeroDocumento = $numeroDocumento;
    }

    public function setIdEstadoCivil($idEstadoCivil) {
        $this->idEstadoCivil = $idEstadoCivil;
    }

    public function setIngresosBrutos($ingresosBrutos) {
        $this->ingresosBrutos = $ingresosBrutos;
    }

    public function setIdCondicionIVA($idCondicionIVA) {
        $this->idCondicionIVA = $idCondicionIVA;
    }
}

?>
<?php

class m_cesig_pad_escribano {
    private $id;
    private $matricula;
    private $creationtimestamp;
    private $creationuser;
    private $deleted;
    private $modificationtimestamp;
    private $modificationuser;
    private $versionnumber;
    private $credencial;
    private $fechacredencial;
    private $idtituloprofesional;
    private $fechatituloprofesional;
    private $tituloexpedidopor;
    private $fechamatricula;
    private $casillerorgr;
    private $agenteretencionsellos;
    private $observacion1;
    private $observacion2;

    // Constructor
    public function __construct(
        $id, $matricula, $creationtimestamp, $creationuser, $deleted, $modificationtimestamp,
        $modificationuser, $versionnumber, $credencial, $fechacredencial, $idtituloprofesional,
        $fechatituloprofesional, $tituloexpedidopor, $fechamatricula, $casillerorgr,
        $agenteretencionsellos, $observacion1, $observacion2
    ) {
        $this->id = $id;
        $this->matricula = $matricula;
        $this->creationtimestamp = $creationtimestamp;
        $this->creationuser = $creationuser;
        $this->deleted = $deleted;
        $this->modificationtimestamp = $modificationtimestamp;
        $this->modificationuser = $modificationuser;
        $this->versionnumber = $versionnumber;
        $this->credencial = $credencial;
        $this->fechacredencial = $fechacredencial;
        $this->idtituloprofesional = $idtituloprofesional;
        $this->fechatituloprofesional = $fechatituloprofesional;
        $this->tituloexpedidopor = $tituloexpedidopor;
        $this->fechamatricula = $fechamatricula;
        $this->casillerorgr = $casillerorgr;
        $this->agenteretencionsellos = $agenteretencionsellos;
        $this->observacion1 = $observacion1;
        $this->observacion2 = $observacion2;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getMatricula() {
        return $this->matricula;
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

    public function getCredencial() {
        return $this->credencial;
    }

    public function getFechacredencial() {
        return $this->fechacredencial;
    }

    public function getIdtituloprofesional() {
        return $this->idtituloprofesional;
    }

    public function getFechatituloprofesional() {
        return $this->fechatituloprofesional;
    }

    public function getTituloexpedidopor() {
        return $this->tituloexpedidopor;
    }

    public function getFechamatricula() {
        return $this->fechamatricula;
    }

    public function getCasillerorgr() {
        return $this->casillerorgr;
    }

    public function getAgenteretencionsellos() {
        return $this->agenteretencionsellos;
    }

    public function getObservacion1() {
        return $this->observacion1;
    }

    public function getObservacion2() {
        return $this->observacion2;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
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

    public function setCredencial($credencial) {
        $this->credencial = $credencial;
    }

    public function setFechacredencial($fechacredencial) {
        $this->fechacredencial = $fechacredencial;
    }

    public function setIdtituloprofesional($idtituloprofesional) {
        $this->idtituloprofesional = $idtituloprofesional;
    }

    public function setFechatituloprofesional($fechatituloprofesional) {
        $this->fechatituloprofesional = $fechatituloprofesional;
    }

    public function setTituloexpedidopor($tituloexpedidopor) {
        $this->tituloexpedidopor = $tituloexpedidopor;
    }

    public function setFechamatricula($fechamatricula) {
        $this->fechamatricula = $fechamatricula;
    }

    public function setCasillerorgr($casillerorgr) {
        $this->casillerorgr = $casillerorgr;
    }

    public function setAgenteretencionsellos($agenteretencionsellos) {
        $this->agenteretencionsellos = $agenteretencionsellos;
    }

    public function setObservacion1($observacion1) {
        $this->observacion1 = $observacion1;
    }

    public function setObservacion2($observacion2) {
        $this->observacion2 = $observacion2;
    }
}

?>
<?php

class m_cesig_swe_usrapl {

    private $id;
    private $username;
    private $idaplication;
    private $uid;
    private $fechaalta;
    private $fechabaja;
    private $usuario;
    private $fechaultmdf;
    private $estado;
    private $permiteweb;

    // Constructor
    public function __construct($id, $username, $idaplication, $uid, $fechaalta, $fechabaja, $usuario, $fechaultmdf, $estado, $permiteweb) {
        $this->id = $id;
        $this->username = $username;
        $this->idaplication = $idaplication;
        $this->uid = $uid;
        $this->fechaalta = $fechaalta;
        $this->fechabaja = $fechabaja;
        $this->usuario = $usuario;
        $this->fechaultmdf = $fechaultmdf;
        $this->estado = $estado;
        $this->permiteweb = $permiteweb;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getIdaplication() {
        return $this->idaplication;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getFechaalta() {
        return $this->fechaalta;
    }

    public function getFechabaja() {
        return $this->fechabaja;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getFechaultmdf() {
        return $this->fechaultmdf;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getPermiteweb() {
        return $this->permiteweb;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setIdaplication($idaplication) {
        $this->idaplication = $idaplication;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    public function setFechabaja($fechabaja) {
        $this->fechabaja = $fechabaja;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setFechaultmdf($fechaultmdf) {
        $this->fechaultmdf = $fechaultmdf;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setPermiteweb($permiteweb) {
        $this->permiteweb = $permiteweb;
    }
}

?>
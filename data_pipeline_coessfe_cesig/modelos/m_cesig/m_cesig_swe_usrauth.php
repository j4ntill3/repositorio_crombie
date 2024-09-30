<?php

class m_cesig_swe_usrauth {

    private $id;
    private $nomusuario;
    private $password;
    private $idaplication;
    private $usuario;
    private $fechaultmdf;
    private $estado;
    private $salt;

    // Constructor
    public function __construct($id, $nomusuario, $password, $idaplication, $usuario, $fechaultmdf, $estado, $salt) {
        $this->id = $id;
        $this->nomusuario = $nomusuario;
        $this->password = $password;
        $this->idaplication = $idaplication;
        $this->usuario = $usuario;
        $this->fechaultmdf = $fechaultmdf;
        $this->estado = $estado;
        $this->salt = $salt;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNomusuario() {
        return $this->nomusuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getIdaplication() {
        return $this->idaplication;
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

    public function getSalt() {
        return $this->salt;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNomusuario($nomusuario) {
        $this->nomusuario = $nomusuario;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setIdaplication($idaplication) {
        $this->idaplication = $idaplication;
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

    public function setSalt($salt) {
        $this->salt = $salt;
    }
}

?>
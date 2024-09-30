<?php

class m_cesig_swe_usrrolapl {

    private $id;
    private $idrolapl;
    private $idusrapl;
    private $usuario;
    private $fechaultmdf;
    private $estado;

    // Constructor
    public function __construct($id, $idrolapl, $idusrapl, $usuario, $fechaultmdf, $estado) {
        $this->id = $id;
        $this->idrolapl = $idrolapl;
        $this->idusrapl = $idusrapl;
        $this->usuario = $usuario;
        $this->fechaultmdf = $fechaultmdf;
        $this->estado = $estado;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdrolapl() {
        return $this->idrolapl;
    }

    public function getIdusrapl() {
        return $this->idusrapl;
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

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdrolapl($idrolapl) {
        $this->idrolapl = $idrolapl;
    }

    public function setIdusrapl($idusrapl) {
        $this->idusrapl = $idusrapl;
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
}

?>
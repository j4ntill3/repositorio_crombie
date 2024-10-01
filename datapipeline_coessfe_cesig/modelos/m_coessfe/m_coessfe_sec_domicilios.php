<?php

class m_coessfe_sec_domicilios {
    private $matricula;
    private $renglon;
    private $fecha;
    private $hasta_fecha;
    private $domicilio;
    private $cod_postal;
    private $sub_cod_postal;
    private $ultimo_domicilio;

    public function __construct($matricula, $renglon, $fecha, $hasta_fecha, $domicilio, $cod_postal, $sub_cod_postal, $ultimo_domicilio) {
        $this->matricula = $matricula;
        $this->renglon = $renglon;
        $this->fecha = $fecha;
        $this->hasta_fecha = $hasta_fecha;
        $this->domicilio = $domicilio;
        $this->cod_postal = $cod_postal;
        $this->sub_cod_postal = $sub_cod_postal;
        $this->ultimo_domicilio = $ultimo_domicilio;
    }

    // Getters
    public function getMatricula() {
        return $this->matricula;
    }

    public function getRenglon() {
        return $this->renglon;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHastaFecha() {
        return $this->hasta_fecha;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getCodPostal() {
        return $this->cod_postal;
    }

    public function getSubCodPostal() {
        return $this->sub_cod_postal;
    }

    public function getUltimoDomicilio() {
        return $this->ultimo_domicilio;
    }

    // Setters
    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setRenglon($renglon) {
        $this->renglon = $renglon;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setHastaFecha($hasta_fecha) {
        $this->hasta_fecha = $hasta_fecha;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    public function setCodPostal($cod_postal) {
        $this->cod_postal = $cod_postal;
    }

    public function setSubCodPostal($sub_cod_postal) {
        $this->sub_cod_postal = $sub_cod_postal;
    }

    public function setUltimoDomicilio($ultimo_domicilio) {
        $this->ultimo_domicilio = $ultimo_domicilio;
    }
}

?>

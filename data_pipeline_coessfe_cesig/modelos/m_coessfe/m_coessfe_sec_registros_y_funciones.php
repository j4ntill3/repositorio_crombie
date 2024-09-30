<?php

class m_coessfe_sec_registros_y_funciones {
    private $matricula;
    private $renglon;
    private $registro;
    private $cod_funcion;
    private $desde_fecha;
    private $hasta_fecha;
    private $observaciones;
    private $ultimo_registro;

    // Constructor de la clase
    public function __construct($matricula, $renglon, $registro, $cod_funcion, $desde_fecha, $hasta_fecha, $observaciones, $ultimo_registro) {
        $this->matricula = $matricula;
        $this->renglon = $renglon;
        $this->registro = $registro;
        $this->cod_funcion = $cod_funcion;
        $this->desde_fecha = $desde_fecha;
        $this->hasta_fecha = $hasta_fecha;
        $this->observaciones = $observaciones;
        $this->ultimo_registro = $ultimo_registro;
    }

    // Getters
    public function getMatricula() {
        return $this->matricula;
    }

    public function getRenglon() {
        return $this->renglon;
    }

    public function getRegistro() {
        return $this->registro;
    }

    public function getCodFuncion() {
        return $this->cod_funcion;
    }

    public function getDesdeFecha() {
        return $this->desde_fecha;
    }

    public function getHastaFecha() {
        return $this->hasta_fecha;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function getUltimoRegistro() {
        return $this->ultimo_registro;
    }

    // Setters
    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setRenglon($renglon) {
        $this->renglon = $renglon;
    }

    public function setRegistro($registro) {
        $this->registro = $registro;
    }

    public function setCodFuncion($cod_funcion) {
        $this->cod_funcion = $cod_funcion;
    }

    public function setDesdeFecha($desde_fecha) {
        $this->desde_fecha = $desde_fecha;
    }

    public function setHastaFecha($hasta_fecha) {
        $this->hasta_fecha = $hasta_fecha;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    public function setUltimoRegistro($ultimo_registro) {
        $this->ultimo_registro = $ultimo_registro;
    }
}

?>

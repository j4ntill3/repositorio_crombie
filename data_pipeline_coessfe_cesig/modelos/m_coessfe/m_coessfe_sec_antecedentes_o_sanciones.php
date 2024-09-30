<?php

class m_coessfe_sec_antecedentes_o_sanciones {
    public $id;
    public $renglon;
    public $matricula;
    public $registro;
    public $cod_tipo_sancion;
    public $desde_fecha;
    public $hasta_fecha;
    public $fecha_levanta_sancion;
    public $observaciones;

    public function __construct($id, $renglon, $matricula, $registro, $cod_tipo_sancion, $desde_fecha, $hasta_fecha, $fecha_levanta_sancion, $observaciones) {
        $this->id = $id;
        $this->renglon = $renglon;
        $this->matricula = $matricula;
        $this->registro = $registro;
        $this->cod_tipo_sancion = $cod_tipo_sancion;
        $this->desde_fecha = $desde_fecha;
        $this->hasta_fecha = $hasta_fecha;
        $this->fecha_levanta_sancion = $fecha_levanta_sancion;
        $this->observaciones = $observaciones;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getRenglon() {
        return $this->renglon;
    }

    public function setRenglon($renglon) {
        $this->renglon = $renglon;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function getRegistro() {
        return $this->registro;
    }

    public function setRegistro($registro) {
        $this->registro = $registro;
    }

    public function getCodTipoSancion() {
        return $this->cod_tipo_sancion;
    }

    public function setCodTipoSancion($cod_tipo_sancion) {
        $this->cod_tipo_sancion = $cod_tipo_sancion;
    }

    public function getDesdeFecha() {
        return $this->desde_fecha;
    }

    public function setDesdeFecha($desde_fecha) {
        $this->desde_fecha = $desde_fecha;
    }

    public function getHastaFecha() {
        return $this->hasta_fecha;
    }

    public function setHastaFecha($hasta_fecha) {
        $this->hasta_fecha = $hasta_fecha;
    }

    public function getFechaLevantaSancion() {
        return $this->fecha_levanta_sancion;
    }

    public function setFechaLevantaSancion($fecha_levanta_sancion) {
        $this->fecha_levanta_sancion = $fecha_levanta_sancion;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
    
}

?>

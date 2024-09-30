<?php

class m_coessfe_sec_licencias {
    private $cod_licencia;
    private $matricula_escr_licencia;
    private $desde_fecha;
    private $hasta_fecha;
    private $matricula_reg_interino;
    private $operador;
    private $fecha_carga;

    public function __construct($cod_licencia, $matricula_escr_licencia, $desde_fecha, $hasta_fecha, $matricula_reg_interino, $operador, $fecha_carga) {
        $this->cod_licencia = $cod_licencia;
        $this->matricula_escr_licencia = $matricula_escr_licencia;
        $this->desde_fecha = $desde_fecha;
        $this->hasta_fecha = $hasta_fecha;
        $this->matricula_reg_interino = $matricula_reg_interino;
        $this->operador = $operador;
        $this->fecha_carga = $fecha_carga;
    }

    public function imprimirAtributos() {
        $atributos = get_object_vars($this);
        foreach ($atributos as $atributo => $valor) {
            echo "$atributo: $valor" .  PHP_EOL . PHP_EOL;
        }
    }

    // Setters
    public function setCodLicencia($cod_licencia) {
        $this->cod_licencia = $cod_licencia;
    }

    public function setMatriculaEscrLicencia($matricula_escr_licencia) {
        $this->matricula_escr_licencia = $matricula_escr_licencia;
    }

    public function setDesdeFecha($desde_fecha) {
        $this->desde_fecha = $desde_fecha;
    }

    public function setHastaFecha($hasta_fecha) {
        $this->hasta_fecha = $hasta_fecha;
    }

    public function setMatriculaRegInterino($matricula_reg_interino) {
        $this->matricula_reg_interino = $matricula_reg_interino;
    }

    public function setOperador($operador) {
        $this->operador = $operador;
    }

    public function setFechaCarga($fecha_carga) {
        $this->fecha_carga = $fecha_carga;
    }

    // Getters
    public function getCodLicencia() {
        return $this->cod_licencia;
    }

    public function getMatriculaEscrLicencia() {
        return $this->matricula_escr_licencia;
    }

    public function getDesdeFecha() {
        return $this->desde_fecha;
    }

    public function getHastaFecha() {
        return $this->hasta_fecha;
    }

    public function getMatriculaRegInterino() {
        return $this->matricula_reg_interino;
    }

    public function getOperador() {
        return $this->operador;
    }

    public function getFechaCarga() {
        return $this->fecha_carga;
    }
}

?>
<?php

class m_coessfe_sec_padron_escribanos {
    private $matricula;
    private $apellido1;
    private $apellido2;
    private $nombre1;
    private $nombre2;
    private $nombre3;
    private $sexo;
    private $apellido_de_casada;
    private $cod_titulo;
    private $fecha_titulo;
    private $expedido;
    private $fecha_matricula;
    private $nacido_en;
    private $fecha_nacimiento;
    private $cod_tipo_doc;
    private $nro_documento;
    private $telefono;
    private $fax;
    private $e_mail;
    private $cuit;
    private $cod_iva;
    private $credencial;
    private $baja_causa;
    private $baja_fecha;
    private $sir;
    private $fecha_sir;
    private $nro_inscripcion_sir;
    private $observaciones;
    private $cod_causa_baja;
    private $enviar_a_id;
    private $e_mail2;
    private $es_legalizador;

    // Esta atributo no corresponde a una columna de la tabla sec_padron_escribanos
    // Se utiliza para verificar si es un usuario activo del sistema cesig
    private $usuario_cesig;

    // Constructor
    public function __construct(
        $matricula, $apellido1, $apellido2, $nombre1, $nombre2, $nombre3, $sexo, $apellido_de_casada,
        $cod_titulo, $fecha_titulo, $expedido, $fecha_matricula, $nacido_en, $fecha_nacimiento,
        $cod_tipo_doc, $nro_documento, $telefono, $fax, $e_mail, $cuit, $cod_iva, $credencial,
        $baja, $baja_causa, $baja_fecha, $sir, $fecha_sir, $nro_inscripcion_sir, $observaciones,
        $cod_causa_baja, $enviar_a_id, $e_mail2, $es_legalizador
    ) {
        $this->matricula = $matricula;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
        $this->nombre3 = $nombre3;
        $this->sexo = $sexo;
        $this->apellido_de_casada = $apellido_de_casada;
        $this->cod_titulo = $cod_titulo;
        $this->fecha_titulo = $fecha_titulo;
        $this->expedido = $expedido;
        $this->fecha_matricula = $fecha_matricula;
        $this->nacido_en = $nacido_en;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->cod_tipo_doc = $cod_tipo_doc;
        $this->nro_documento = $nro_documento;
        $this->telefono = $telefono;
        $this->fax = $fax;
        $this->e_mail = $e_mail;
        $this->cuit = $cuit;
        $this->cod_iva = $cod_iva;
        $this->credencial = $credencial;
        $this->baja = $baja;
        $this->baja_causa = $baja_causa;
        $this->baja_fecha = $baja_fecha;
        $this->sir = $sir;
        $this->fecha_sir = $fecha_sir;
        $this->nro_inscripcion_sir = $nro_inscripcion_sir;
        $this->observaciones = $observaciones;
        $this->cod_causa_baja = $cod_causa_baja;
        $this->enviar_a_id = $enviar_a_id;
        $this->e_mail2 = $e_mail2;
        $this->es_legalizador = $es_legalizador;
    }

    // Getters
    public function getMatricula() {
        return $this->matricula;
    }

    public function getApellido1() {
        return $this->apellido1;
    }

    public function getApellido2() {
        return $this->apellido2;
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

    public function getSexo() {
        return $this->sexo;
    }

    public function getApellidoDeCasada() {
        return $this->apellido_de_casada;
    }

    public function getCodTitulo() {
        return $this->cod_titulo;
    }

    public function getFechaTitulo() {
        return $this->fecha_titulo;
    }

    public function getExpedido() {
        return $this->expedido;
    }

    public function getFechaMatricula() {
        return $this->fecha_matricula;
    }

    public function getNacidoEn() {
        return $this->nacido_en;
    }

    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }

    public function getCodTipoDoc() {
        return $this->cod_tipo_doc;
    }

    public function getNroDocumento() {
        return $this->nro_documento;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getFax() {
        return $this->fax;
    }

    public function getEmail() {
        return $this->e_mail;
    }

    public function getCuit() {
        return $this->cuit;
    }

    public function getCodIva() {
        return $this->cod_iva;
    }

    public function getCredencial() {
        return $this->credencial;
    }

    public function getBajaCausa() {
        return $this->baja_causa;
    }

    public function getBajaFecha() {
        return $this->baja_fecha;
    }

    public function getSir() {
        return $this->sir;
    }

    public function getFechaSir() {
        return $this->fecha_sir;
    }

    public function getNroInscripcionSir() {
        return $this->nro_inscripcion_sir;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function getCodCausaBaja() {
        return $this->cod_causa_baja;
    }

    public function getEnviarAId() {
        return $this->enviar_a_id;
    }

    public function getEmail2() {
        return $this->e_mail2;
    }

    public function getEsLegalizador() {
        return $this->es_legalizador;
    }

    public function getUsuarioCesig(){
        return $this->usuario_cesig;
    }

    // Setters
    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
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

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setApellidoDeCasada($apellido_de_casada) {
        $this->apellido_de_casada = $apellido_de_casada;
    }

    public function setCodTitulo($cod_titulo) {
        $this->cod_titulo = $cod_titulo;
    }

    public function setFechaTitulo($fecha_titulo) {
        $this->fecha_titulo = $fecha_titulo;
    }

    public function setExpedido($expedido) {
        $this->expedido = $expedido;
    }

    public function setFechaMatricula($fecha_matricula) {
        $this->fecha_matricula = $fecha_matricula;
    }

    public function setNacidoEn($nacido_en) {
        $this->nacido_en = $nacido_en;
    }

    public function setFechaNacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function setCodTipoDoc($cod_tipo_doc) {
        $this->cod_tipo_doc = $cod_tipo_doc;
    }

    public function setNroDocumento($nro_documento) {
        $this->nro_documento = $nro_documento;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setFax($fax) {
        $this->fax = $fax;
    }

    public function setEmail($e_mail) {
        $this->e_mail = $e_mail;
    }

    public function setCuit($cuit) {
        $this->cuit = $cuit;
    }

    public function setCodIva($cod_iva) {
        $this->cod_iva = $cod_iva;
    }

    public function setCredencial($credencial) {
        $this->credencial = $credencial;
    }

    public function setBajaCausa($baja_causa) {
        $this->baja_causa = $baja_causa;
    }

    public function setBajaFecha($baja_fecha) {
        $this->baja_fecha = $baja_fecha;
    }

    public function setSir($sir) {
        $this->sir = $sir;
    }

    public function setFechaSir($fecha_sir) {
        $this->fecha_sir = $fecha_sir;
    }

    public function setNroInscripcionSir($nro_inscripcion_sir) {
        $this->nro_inscripcion_sir = $nro_inscripcion_sir;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    public function setCodCausaBaja($cod_causa_baja) {
        $this->cod_causa_baja = $cod_causa_baja;
    }

    public function setEnviarAId($enviar_a_id) {
        $this->enviar_a_id = $enviar_a_id;
    }

    public function setEmail2($e_mail2) {
        $this->e_mail2 = $e_mail2;
    }

    public function setEsLegalizador($es_legalizador) {
        $this->es_legalizador = $es_legalizador;
    }

    public function setUsuarioCesig($usuario_cesig){
        $this->usuario_cesig = $usuario_cesig;
    }
}

?>
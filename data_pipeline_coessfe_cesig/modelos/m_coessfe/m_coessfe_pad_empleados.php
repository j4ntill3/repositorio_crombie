<?php

class m_coessfe_pad_empleados {

    private $legajo;
    private $idOrganizacion;
    private $apellidos;
    private $nombres;
    private $direccion;
    private $codPostalDireccion;
    private $subCodPostalDireccion;
    private $telefono;
    private $celular;
    private $email;
    private $tipoDocumento;
    private $codTipoDocumento;
    private $nroDocumento;
    private $fechaNacimiento;
    private $codPostalLugarNacimiento;
    private $subCodPostalLugarNac;
    private $nacionalidad;
    private $estadoCivil;
    private $idEstadoCivil;
    private $sexo;
    private $idSexo;
    private $titulo;
    private $seccion;
    private $categoria;
    private $codCategoriaUtedyc;
    private $fechaIngreso;
    private $cuil;
    private $cajaJub;
    private $obraSocial;
    private $contrasena;
    private $fechaUltCambioCategoria;
    private $codLugarCobro;
    private $cajaDeAhorro;
    private $legajoNuevo;

    public function __construct(
        $legajo, $idOrganizacion, $apellidos, $nombres, $direccion, $codPostalDireccion, $subCodPostalDireccion,
        $telefono, $celular, $email, $tipoDocumento, $codTipoDocumento, $nroDocumento, $fechaNacimiento,
        $codPostalLugarNacimiento, $subCodPostalLugarNac, $nacionalidad, $estadoCivil, $idEstadoCivil, $sexo,
        $idSexo, $titulo, $seccion, $categoria, $codCategoriaUtedyc, $fechaIngreso, $cuil, $cajaJub, $obraSocial,
        $contrasena, $fechaUltCambioCategoria, $codLugarCobro, $cajaDeAhorro, $legajoNuevo
    ) {
        $this->legajo = $legajo;
        $this->idOrganizacion = $idOrganizacion;
        $this->apellidos = $apellidos;
        $this->nombres = $nombres;
        $this->direccion = $direccion;
        $this->codPostalDireccion = $codPostalDireccion;
        $this->subCodPostalDireccion = $subCodPostalDireccion;
        $this->telefono = $telefono;
        $this->celular = $celular;
        $this->email = $email;
        $this->tipoDocumento = $tipoDocumento;
        $this->codTipoDocumento = $codTipoDocumento;
        $this->nroDocumento = $nroDocumento;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->codPostalLugarNacimiento = $codPostalLugarNacimiento;
        $this->subCodPostalLugarNac = $subCodPostalLugarNac;
        $this->nacionalidad = $nacionalidad;
        $this->estadoCivil = $estadoCivil;
        $this->idEstadoCivil = $idEstadoCivil;
        $this->sexo = $sexo;
        $this->idSexo = $idSexo;
        $this->titulo = $titulo;
        $this->seccion = $seccion;
        $this->categoria = $categoria;
        $this->codCategoriaUtedyc = $codCategoriaUtedyc;
        $this->fechaIngreso = $fechaIngreso;
        $this->cuil = $cuil;
        $this->cajaJub = $cajaJub;
        $this->obraSocial = $obraSocial;
        $this->contrasena = $contrasena;
        $this->fechaUltCambioCategoria = $fechaUltCambioCategoria;
        $this->codLugarCobro = $codLugarCobro;
        $this->cajaDeAhorro = $cajaDeAhorro;
        $this->legajoNuevo = $legajoNuevo;
    }

    // Getters
    public function getLegajo() {
        return $this->legajo;
    }

    public function getIdOrganizacion() {
        return $this->idOrganizacion;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCodPostalDireccion() {
        return $this->codPostalDireccion;
    }

    public function getSubCodPostalDireccion() {
        return $this->subCodPostalDireccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function getCodTipoDocumento() {
        return $this->codTipoDocumento;
    }

    public function getNroDocumento() {
        return $this->nroDocumento;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getCodPostalLugarNacimiento() {
        return $this->codPostalLugarNacimiento;
    }

    public function getSubCodPostalLugarNac() {
        return $this->subCodPostalLugarNac;
    }

    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function getEstadoCivil() {
        return $this->estadoCivil;
    }

    public function getIdEstadoCivil() {
        return $this->idEstadoCivil;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getIdSexo() {
        return $this->idSexo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getSeccion() {
        return $this->seccion;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getCodCategoriaUtedyc() {
        return $this->codCategoriaUtedyc;
    }

    public function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    public function getCuil() {
        return $this->cuil;
    }

    public function getCajaJub() {
        return $this->cajaJub;
    }

    public function getObraSocial() {
        return $this->obraSocial;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getFechaUltCambioCategoria() {
        return $this->fechaUltCambioCategoria;
    }

    public function getCodLugarCobro() {
        return $this->codLugarCobro;
    }

    public function getCajaDeAhorro() {
        return $this->cajaDeAhorro;
    }

    public function getLegajoNuevo() {
        return $this->legajoNuevo;
    }

    // Setters
    public function setLegajo($legajo) {
        $this->legajo = $legajo;
    }

    public function setIdOrganizacion($idOrganizacion) {
        $this->idOrganizacion = $idOrganizacion;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setCodPostalDireccion($codPostalDireccion) {
        $this->codPostalDireccion = $codPostalDireccion;
    }

    public function setSubCodPostalDireccion($subCodPostalDireccion) {
        $this->subCodPostalDireccion = $subCodPostalDireccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function setCodTipoDocumento($codTipoDocumento) {
        $this->codTipoDocumento = $codTipoDocumento;
    }

    public function setNroDocumento($nroDocumento) {
        $this->nroDocumento = $nroDocumento;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setCodPostalLugarNacimiento($codPostalLugarNacimiento) {
        $this->codPostalLugarNacimiento = $codPostalLugarNacimiento;
    }

    public function setSubCodPostalLugarNac($subCodPostalLugarNac) {
        $this->subCodPostalLugarNac = $subCodPostalLugarNac;
    }

    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    public function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    public function setIdEstadoCivil($idEstadoCivil) {
        $this->idEstadoCivil = $idEstadoCivil;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setIdSexo($idSexo) {
        $this->idSexo = $idSexo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setSeccion($seccion) {
        $this->seccion = $seccion;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setCodCategoriaUtedyc($codCategoriaUtedyc) {
        $this->codCategoriaUtedyc = $codCategoriaUtedyc;
    }

    public function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;
    }

    public function setCuil($cuil) {
        $this->cuil = $cuil;
    }

    public function setCajaJub($cajaJub) {
        $this->cajaJub = $cajaJub;
    }

    public function setObraSocial($obraSocial) {
        $this->obraSocial = $obraSocial;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setFechaUltCambioCategoria($fechaUltCambioCategoria) {
        $this->fechaUltCambioCategoria = $fechaUltCambioCategoria;
    }

    public function setCodLugarCobro($codLugarCobro) {
        $this->codLugarCobro = $codLugarCobro;
    }

    public function setCajaDeAhorro($cajaDeAhorro) {
        $this->cajaDeAhorro = $cajaDeAhorro;
    }

    public function setLegajoNuevo($legajoNuevo) {
        $this->legajoNuevo = $legajoNuevo;
    }
}

?>
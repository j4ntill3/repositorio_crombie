<?php

    class m_cesig_seg_perfil {

        private $id;
        private $creationtimestamp;
        private $creationuser;
        private $deleted;
        private $modificationstimestamp;
        private $modificationuser;
        private $versionnumber;
        private $userapl;
        private $idempleado;
        private $idescribano;
        private $idexterno;
        private $idpersona;
        private $idusuario;

        // Constructor
        public function __construct($id, $creationtimestamp, $creationuser, $deleted, $modificationstimestamp, $modificationuser, $versionnumber, $userapl, $idempleado, $idescribano, $idexterno, $idpersona, $idusuario) {
            $this->id = $id;
            $this->creationtimestamp = $creationtimestamp;
            $this->creationuser = $creationuser;
            $this->deleted = $deleted;
            $this->modificationstimestamp = $modificationstimestamp;
            $this->modificationuser = $modificationuser;
            $this->versionnumber = $versionnumber;
            $this->userapl = $userapl;
            $this->idempleado = $idempleado;
            $this->idescribano = $idescribano;
            $this->idexterno = $idexterno;
            $this->idpersona = $idpersona;
            $this->idusuario = $idusuario;
        }
        
        // Getters
        public function getId() {
            return $this->id;
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

        public function getModificationstimestamp() {
            return $this->modificationstimestamp;
        }

        public function getModificationuser() {
            return $this->modificationuser;
        }

        public function getVersionnumber() {
            return $this->versionnumber;
        }

        public function getUserapl() {
            return $this->userapl;
        }

        public function getIdempleado() {
            return $this->idempleado;
        }

        public function getIdescribano() {
            return $this->idescribano;
        }

        public function getIdexterno() {
            return $this->idexterno;
        }

        public function getIdpersona() {
            return $this->idpersona;
        }

        public function getIdusuario() {
            return $this->idusuario;
        }

        // Setters
        public function setId($id) {
            $this->id = $id;
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

        public function setModificationstimestamp($modificationstimestamp) {
            $this->modificationstimestamp = $modificationstimestamp;
        }

        public function setModificationuser($modificationuser) {
            $this->modificationuser = $modificationuser;
        }

        public function setVersionnumber($versionnumber) {
            $this->versionnumber = $versionnumber;
        }

        public function setUserapl($userapl) {
            $this->userapl = $userapl;
        }

        public function setIdempleado($idempleado) {
            $this->idempleado = $idempleado;
        }

        public function setIdescribano($idescribano) {
            $this->idescribano = $idescribano;
        }

        public function setIdexterno($idexterno) {
            $this->idexterno = $idexterno;
        }

        public function setIdpersona($idpersona) {
            $this->idpersona = $idpersona;
        }

        public function setIdusuario($idusuario) {
            $this->idusuario = $idusuario;
        }
    }


?>
<?php

class m_cesig_pad_personacontacto {

    private $id;
    private $idpersona;
    private $idpersonatipocontacto;
    private $contactovalor;
    private $esoficial;
    private $espublico;
    private $creationtimestamp;
    private $creationuser;
    private $deleted;
    private $modificationtimestamp;
    private $modificationuser;
    private $versionnumber;
    
    // Constructor
    public function __construct($id, $idpersona, $idpersonatipocontacto, $contactovalor, $esoficial, $espublico, $creationtimestamp, $creationuser, $deleted, $modificationtimestamp, $modificationuser, $versionnumber) {
        $this->id = $id;
        $this->idpersona = $idpersona;
        $this->idpersonatipocontacto = $idpersonatipocontacto;
        $this->contactovalor = $contactovalor;
        $this->esoficial = $esoficial;
        $this->espublico = $espublico;
        $this->creationtimestamp = $creationtimestamp;
        $this->creationuser = $creationuser;
        $this->deleted = $deleted;
        $this->modificationtimestamp = $modificationtimestamp;
        $this->modificationuser = $modificationuser;
        $this->versionnumber = $versionnumber;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdpersona() {
        return $this->idpersona;
    }

    public function getIdpersonatipocontacto() {
        return $this->idpersonatipocontacto;
    }

    public function getContactovalor() {
        return $this->contactovalor;
    }

    public function getEsoficial() {
        return $this->esoficial;
    }

    public function getEspublico() {
        return $this->espublico;
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

    public function getModificationtimestamp() {
        return $this->modificationtimestamp;
    }

    public function getModificationuser() {
        return $this->modificationuser;
    }

    public function getVersionnumber() {
        return $this->versionnumber;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdpersona($idpersona) {
        $this->idpersona = $idpersona;
    }

    public function setIdpersonatipocontacto($idpersonatipocontacto) {
        $this->idpersonatipocontacto = $idpersonatipocontacto;
    }

    public function setContactovalor($contactovalor) {
        $this->contactovalor = $contactovalor;
    }

    public function setEsoficial($esoficial) {
        $this->esoficial = $esoficial;
    }

    public function setEspublico($espublico) {
        $this->espublico = $espublico;
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

    public function setModificationtimestamp($modificationtimestamp) {
        $this->modificationtimestamp = $modificationtimestamp;
    }

    public function setModificationuser($modificationuser) {
        $this->modificationuser = $modificationuser;
    }

    public function setVersionnumber($versionnumber) {
        $this->versionnumber = $versionnumber;
    }
}


?>
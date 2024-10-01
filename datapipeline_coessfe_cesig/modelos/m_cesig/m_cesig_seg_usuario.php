<?php

class m_cesig_seg_usuario {

    private $id;
    private $creationtimestamp;
    private $creationuser;
    private $deleted;
    private $modificationtimestamp;
    private $modificationuser;
    private $versionnumber;
    private $accountlocked;
    private $email;
    private $fechaalta;
    private $fechabaja;
    private $fullname;
    private $username;
    private $verifiedemail;
    private $iduserattemps;

    // Constructor
    public function __construct($id, $creationtimestamp, $creationuser, $deleted, $modificationtimestamp, $modificationuser, $versionnumber, $accountlocked, $email, $fechaalta, $fechabaja, $fullname, $username, $verifiedemail, $iduserattemps) {
        $this->id = $id;
        $this->creationtimestamp = $creationtimestamp;
        $this->creationuser = $creationuser;
        $this->deleted = $deleted;
        $this->modificationtimestamp = $modificationtimestamp;
        $this->modificationuser = $modificationuser;
        $this->versionnumber = $versionnumber;
        $this->accountlocked = $accountlocked;
        $this->email = $email;
        $this->fechaalta = $fechaalta;
        $this->fechabaja = $fechabaja;
        $this->fullname = $fullname;
        $this->username = $username;
        $this->verifiedemail = $verifiedemail;
        $this->iduserattemps = $iduserattemps;
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

    public function getModificationtimestamp() {
        return $this->modificationtimestamp;
    }

    public function getModificationuser() {
        return $this->modificationuser;
    }

    public function getVersionnumber() {
        return $this->versionnumber;
    }

    public function getAccountlocked() {
        return $this->accountlocked;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFechaalta() {
        return $this->fechaalta;
    }

    public function getFechabaja() {
        return $this->fechabaja;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getVerifiedemail() {
        return $this->verifiedemail;
    }

    public function getIduserattemps() {
        return $this->iduserattemps;
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

    public function setModificationtimestamp($modificationtimestamp) {
        $this->modificationtimestamp = $modificationtimestamp;
    }

    public function setModificationuser($modificationuser) {
        $this->modificationuser = $modificationuser;
    }

    public function setVersionnumber($versionnumber) {
        $this->versionnumber = $versionnumber;
    }

    public function setAccountlocked($accountlocked) {
        $this->accountlocked = $accountlocked;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    public function setFechabaja($fechabaja) {
        $this->fechabaja = $fechabaja;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setVerifiedemail($verifiedemail) {
        $this->verifiedemail = $verifiedemail;
    }

    public function setIduserattemps($iduserattemps) {
        $this->iduserattemps = $iduserattemps;
    }
}





?>
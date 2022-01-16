<?php

class Usuario {
    private $id;
    private $idUsuario;
    private $idRol;
    private $login;
    private $password;
    private $activo;

    function __construct($id, $idUsuario, $idRol, $login, $password, $activo) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->idRol = $idRol;
        $this->login = $login;
        $this->password = $password;
        $this->activo = $activo;
    }

    
    function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdRol() {
        return $this->idRol;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}

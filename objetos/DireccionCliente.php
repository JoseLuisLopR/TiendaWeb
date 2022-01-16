<?php
class DireccionCliente {
    private $id;
    private $idCliente;
    private $calle;
    private $codPostal;
    private $localidad;
    private $provincia;
    private $pais;
    private $activo;
    
    function __construct($id, $idCliente, $calle, $codPostal, $localidad, $provincia, $pais, $activo) {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->calle = $calle;
        $this->codPostal = $codPostal;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->pais = $pais;
        $this->activo = $activo;
    }

    
    function getId() {
        return $this->id;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getCalle() {
        return $this->calle;
    }

    function getCodPostal() {
        return $this->codPostal;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getPais() {
        return $this->pais;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setCalle($calle) {
        $this->calle = $calle;
    }

    function setCodPostal($codPostal) {
        $this->codPostal = $codPostal;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}


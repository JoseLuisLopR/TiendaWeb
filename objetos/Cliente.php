<?php


class Cliente {
    private $id;
    private $idCliente;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $nif;
    private $varon;
    private $numCta;
    private $comoNosConocimos;
    private $activo;
    function getId() {
        return $this->id;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido1() {
        return $this->apellido1;
    }

    function getApellido2() {
        return $this->apellido2;
    }

    function getNif() {
        return $this->nif;
    }

    function getVaron() {
        return $this->varon;
    }

    function getNumCta() {
        return $this->numCta;
    }

    function getComoNosConocimos() {
        return $this->comoNosConocimos;
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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    function setNif($nif) {
        $this->nif = $nif;
    }

    function setVaron($varon) {
        $this->varon = $varon;
    }

    function setNumCta($numCta) {
        $this->numCta = $numCta;
    }

    function setComoNosConocimos($comoNosConocimos) {
        $this->comoNosConocimos = $comoNosConocimos;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function __construct($id, $idCliente, $nombre, $apellido1, $apellido2, $nif, $varon, $numCta, $comoNosConocimos, $activo) {
    $this->id = $id;
    $this->idCliente = $idCliente;
    $this->nombre = $nombre;
    $this->apellido1 = $apellido1;
    $this->apellido2 = $apellido2;
    $this->nif = $nif;
    $this->varon = $varon;
    $this->numCta = $numCta;
    $this->comoNosConocimos = $comoNosConocimos;
    $this->activo = $activo;
    }


}

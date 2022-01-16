<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empleado
 *
 * @author Juan
 */
class Empleado {
    private $id;
    private $idEmpleado;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $numCta;
    private $movil;
    private $localidad;
    private $codPostal;
    private $provincia;
    private $activo;
    
    function __construct($id, $idEmpleado, $nombre, $apellido1, $apellido2, $numCta, $movil, $localidad, $codPostal, $provincia, $activo) {
        $this->id = $id;
        $this->idEmpleado = $idEmpleado;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->numCta = $numCta;
        $this->movil = $movil;
        $this->localidad = $localidad;
        $this->codPostal = $codPostal;
        $this->provincia = $provincia;
        $this->activo = $activo;
    }

    
    function getId() {
        return $this->id;
    }

    function getIdEmpleado() {
        return $this->idEmpleado;
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

    function getNumCta() {
        return $this->numCta;
    }

    function getMovil() {
        return $this->movil;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getCodPostal() {
        return $this->codPostal;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
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

    function setNumCta($numCta) {
        $this->numCta = $numCta;
    }

    function setMovil($movil) {
        $this->movil = $movil;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setCodPostal($codPostal) {
        $this->codPostal = $codPostal;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}


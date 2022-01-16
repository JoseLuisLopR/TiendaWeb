<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedor
 *
 * @author Juan
 */
class Proveedor {
    private $id;
    private $idProveedor;
    private $nombre;
    private $telefono;
    private $activo;
    function __construct($id, $idProveedor, $nombre, $telefono, $activo) {
        $this->id = $id;
        $this->idProveedor = $idProveedor;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->activo = $activo;
    }
    function getId() {
        return $this->id;
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}

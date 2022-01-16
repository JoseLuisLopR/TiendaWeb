<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FamiliaFamilia
 *
 * @author Juan
 */
class FamiliaProducto {
    
    
    private $id;
    private $idFamilia;
    private $nombre;
    private $descripcion;
    private $activo;
    
    function __construct($id, $idFamilia, $nombre, $descripcion, $activo) {
        $this->id = $id;
        $this->idFamilia = $idFamilia;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->activo = $activo;
    }

    function getId() {
        return $this->id;
    }

    function getIdFamilia() {
        return $this->idFamilia;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdFamilia($idFamilia) {
        $this->idFamilia = $idFamilia;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}

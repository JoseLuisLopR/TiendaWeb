<?php

class LineaPedido {
    private $id;
    private $idPedido;
    private $idProducto;
    private $unidades;
    private $descripcion;
    private $pvp;
    private $tipoIva;
    private $activo;
    
    function __construct($id, $idPedido, $idProducto, $unidades, $descripcion, $pvp, $tipoIva, $activo) {
        $this->id = $id;
        $this->idPedido = $idPedido;
        $this->idProducto = $idProducto;
        $this->unidades = $unidades;
        $this->descripcion = $descripcion;
        $this->pvp = $pvp;
        $this->tipoIva = $tipoIva;
        $this->activo = $activo;
    }


    
    function getId() {
        return $this->id;
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getUnidades() {
        return $this->unidades;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPvp() {
        return $this->pvp;
    }

    function getTipoIva() {
        return $this->tipoIva;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setUnidades($unidades) {
        $this->unidades = $unidades;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPvp($pvp) {
        $this->pvp = $pvp;
    }

    function setTipoIva($tipoIva) {
        $this->tipoIva = $tipoIva;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}

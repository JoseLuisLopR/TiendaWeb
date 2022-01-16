<?php


class Producto {
    private $id;
    private $idProducto;
    private $idFamilia;
    private $tipoIva;
    private $precioCoste;
    private $pvp;
    private $descripcion;
    private $codigoBarras;
    private $idProveedor;
    private $stockActual;
    private $stockMinimo;
    private $stockMaximo;
    private $rutaFoto;
    private $activo;
    
    function __construct($id, $idProducto,$idFamilia, $tipoIva,$precioCoste, $pvp, $descripcion, $codigoBarras, $idProveedor, $stockActual, $stockMinimo, $stockMaximo, $rutaFoto, $activo) {
        $this->id = $id;
        $this->idProducto = $idProducto;
        $this->idFamilia = $idFamilia;
        $this->tipoIva = $tipoIva;
        $this->pvp = $pvp;
        $this->precioCoste = $precioCoste;
        $this->descripcion = $descripcion;
        $this->codigoBarras = $codigoBarras;
        $this->idProveedor = $idProveedor;
        $this->stockActual = $stockActual;
        $this->stockMinimo = $stockMinimo;
        $this->stockMaximo = $stockMaximo;
        $this->rutaFoto = $rutaFoto;
        $this->activo = $activo;
    }
    function getPrecioCoste() {
        return $this->precioCoste;
    }

    function setPrecioCoste($precioCoste) {
        $this->precioCoste = $precioCoste;
    }

    function getIdFamilia() {
        return $this->idFamilia;
    }

    function setIdFamilia($idFamilia) {
        $this->idFamilia = $idFamilia;
    }

        function getId() {
        return $this->id;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getTipoIva() {
        return $this->tipoIva;
    }

    function getPvp() {
        return $this->pvp;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCodigoBarras() {
        return $this->codigoBarras;
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getStockActual() {
        return $this->stockActual;
    }

    function getStockMinimo() {
        return $this->stockMinimo;
    }

    function getStockMaximo() {
        return $this->stockMaximo;
    }

    function getRutaFoto() {
        return $this->rutaFoto;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setTipoIva($tipoIva) {
        $this->tipoIva = $tipoIva;
    }

    function setPvp($pvp) {
        $this->pvp = $pvp;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCodigoBarras($codigoBarras) {
        $this->codigoBarras = $codigoBarras;
    }

    function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    function setStockActual($stockActual) {
        $this->stockActual = $stockActual;
    }

    function setStockMinimo($stockMinimo) {
        $this->stockMinimo = $stockMinimo;
    }

    function setStockMaximo($stockMaximo) {
        $this->stockMaximo = $stockMaximo;
    }

    function setRutaFoto($rutaFoto) {
        $this->rutaFoto = $rutaFoto;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}

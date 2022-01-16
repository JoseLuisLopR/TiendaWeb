<?php

class Pedido {
    private $id;
    private $idPedido;
    private $idEmpleadoEmpaqueta;
    private $idEmpresaTransporte;
    private $fechaPedido;
    private $fechaEnvio;
    private $fechaEntrega;
    private $facturado;
    private $idFactura;
    private $fechaFactura;
    private $pagado;
    private $fechaPago;
    private $metodoPago;
    private $idCliente;
    private $activo;
    
    function __construct($id, $idPedido, $idEmpleadoEmpaqueta, $idEmpresaTransporte, $fechaPedido, $fechaEnvio, $fechaEntrega, $facturado, $idFactura, $fechaFactura, $pagado, $fechaPago, $metodoPago, $idCliente, $activo) {
        $this->id = $id;
        $this->idPedido = $idPedido;
        $this->idEmpleadoEmpaqueta = $idEmpleadoEmpaqueta;
        $this->idEmpresaTransporte = $idEmpresaTransporte;
        $this->fechaPedido = $fechaPedido;
        $this->fechaEnvio = $fechaEnvio;
        $this->fechaEntrega = $fechaEntrega;
        $this->facturado = $facturado;
        $this->idFactura = $idFactura;
        $this->fechaFactura = $fechaFactura;
        $this->pagado = $pagado;
        $this->fechaPago = $fechaPago;
        $this->metodoPago = $metodoPago;
        $this->idCliente = $idCliente;
        $this->activo = $activo;
    }

    
    function getId() {
        return $this->id;
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function getIdEmpleadoEmpaqueta() {
        return $this->idEmpleadoEmpaqueta;
    }

    function getIdEmpresaTransporte() {
        return $this->idEmpresaTransporte;
    }

    function getFechaPedido() {
        return $this->fechaPedido;
    }

    function getFechaEnvio() {
        return $this->fechaEnvio;
    }

    function getFechaEntrega() {
        return $this->fechaEntrega;
    }

    function getFacturado() {
        return $this->facturado;
    }

    function getIdFactura() {
        return $this->idFactura;
    }

    function getFechaFactura() {
        return $this->fechaFactura;
    }

    function getPagado() {
        return $this->pagado;
    }

    function getFechaPago() {
        return $this->fechaPago;
    }

    function getMetodoPago() {
        return $this->metodoPago;
    }

    function getIdCliente() {
        return $this->idCliente;
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

    function setIdEmpleadoEmpaqueta($idEmpleadoEmpaqueta) {
        $this->idEmpleadoEmpaqueta = $idEmpleadoEmpaqueta;
    }

    function setIdEmpresaTransporte($idEmpresaTransporte) {
        $this->idEmpresaTransporte = $idEmpresaTransporte;
    }

    function setFechaPedido($fechaPedido) {
        $this->fechaPedido = $fechaPedido;
    }

    function setFechaEnvio($fechaEnvio) {
        $this->fechaEnvio = $fechaEnvio;
    }

    function setFechaEntrega($fechaEntrega) {
        $this->fechaEntrega = $fechaEntrega;
    }

    function setFacturado($facturado) {
        $this->facturado = $facturado;
    }

    function setIdFactura($idFactura) {
        $this->idFactura = $idFactura;
    }

    function setFechaFctura($fechaFactura) {
        $this->fechaFactura = $fechaFactura;
    }

    function setPagado($pagado) {
        $this->pagado = $pagado;
    }

    function setFechaPago($fechaPago) {
        $this->fechaPago = $fechaPago;
    }

    function setMetodoPago($metodoPago) {
        $this->metodoPago = $metodoPago;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}

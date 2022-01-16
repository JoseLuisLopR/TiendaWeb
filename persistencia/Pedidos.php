<?php

require_once 'Conexion.php';
//require ('../objetos/Pedido.php');
class Pedidos {
    private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonPedidos(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
    public function getPedidosTodos(){
        try{
            $consulta="SELECT * FROM pedidos ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $tPedidos;
    }
    public function getPedidosActivos(){
        try{
            $consulta="SELECT * FROM pedidos WHERE activo!=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $tPedidos;
    }
    public function getPedidosNoActivos(){
        try{
            $consulta="SELECT * FROM pedidos WHERE activo=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $tPedidos;
    }
    public function addPedido(Pedido $c){
            try{
                $consulta="INSERT INTO pedidos (`id`, `id_pedido`, `id_empleado_empaqueta`,"
                        . " `id_empresa_trasporte`, `fecha_pedido`, `fecha_envio`, `fecha_entrega`, `facturado`, `id_factura`,"
                        . " `fecha_factura`, `pagado`, `fecha_pago`, `metodo_pago`, `id_cliente`, `activo`)"
                        . " values (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdPedido());
                @$query->bindParam(2,$c->getIdEmpleadoEmpaqueta());
                @$query->bindParam(3,$c->getIdEmpresaTransporte());
                @$query->bindParam(4,$c->getFechaPedido());
                @$query->bindParam(5,$c->getFechaEnvio());
                @$query->bindParam(6,$c->getFechaEntrega());
                @$query->bindParam(7,$c->getFacturado());
                @$query->bindParam(8,$c->getIdFactura());
                @$query->bindParam(9,$c->getFechaFactura());
                @$query->bindParam(10,$c->getPagado());
                @$query->bindParam(11,$c->getFechaPago());
                @$query->bindParam(12,$c->getMetodoPago());
                @$query->bindParam(13,$c->getIdCliente());
                @$query->bindParam(14,$c->getActivo());

                
                $query->execute();
                $insertado=true;
                // para el proyecto final, contemplar la posibilidad de que se produzca error en la insercion
                // y haya que recuperar el estado anterior de la tabla
            } catch (Exception $ex) {
                $insertado=false;
            }
            return $insertado;
        }
        public function getPedidosCliente($idCliente){
        try{
            $consulta="SELECT * FROM pedidos WHERE activo=1 and pagado=1 and id_cliente='".$idCliente."' ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $tPedidos;
    }
    public function getIdNuevoPedido($fecha){
        try{
            $consulta="SELECT COUNT(id) FROM pedidos WHERE id_pedido like '".$fecha."%'";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedido=$query->fetchAll();
            if (empty($tPedido)){
                $numero=0;
                }else{
                    $numero=$tPedido[0][0];
                }
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return (int)($numero)+1;
    }
    public function pagarPedido($idPedido){
        try{          
                $consulta="UPDATE pedidos SET pagado=1 , fecha_pago='".date("Y-m-d")."' WHERE id_pedido='".$idPedido."'";
                //echo $consulta;
                @$query=$this->db->preparar($consulta);
                @$query->execute();
        } catch (Exception $ex){
            echo "Se ha producido un error en pagarPedidos";
        }
    }
    public function getPedidosNoFacturados(){
        try{
            $consulta="SELECT * FROM pedidos WHERE facturado=0 and activo=1 and pagado=1";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
            if (empty($tPedidos)){
            //$c=new Pedido();
            $c=null;
        }
        else{
            $c = array();
            foreach ($tPedidos as $pr) {
                @$p=new Pedido($pr[0],$pr[1],$pr[2],$pr[3],$pr[4],$pr[5],$pr[6],$pr[7],$pr[8],$pr[9],$pr[10],$pr[11],$pr[12],$pr[13],$pr[14]);
                array_push($c, $p);
            }}
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $c;
    }
    public function facturarPedido($idPedido,$idFactura){
        try{          
                
                $consulta="UPDATE pedidos SET facturado=1 , fecha_factura='".date("Y-m-d")."', id_factura='".$idFactura."' WHERE id_pedido='".$idPedido."'";
                //echo $consulta;
                @$query=$this->db->preparar($consulta);
                @$query->execute();
        } catch (Exception $ex){
            echo "Se ha producido un error en pagarPedidos";
        }
    }
    public function getCantidadPedidoFacturados(){
        try{
            $consulta="SELECT COUNT(id) FROM pedidos WHERE facturado=1 ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedido=$query->fetchAll();
            if (empty($tPedido)){
                $numero=0;
                }else{
                    $numero=$tPedido[0][0];
                }
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return ($numero);
    }
            public function getPedidosFacturadosCliente($idCliente){
        try{
            $consulta="SELECT * FROM pedidos WHERE activo=1 and pagado=1 and facturado=1 and id_cliente='".$idCliente."' ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $tPedidos;
    }
            public function getPedidosNoFacturadosCliente($idCliente){
        try{
            $consulta="SELECT * FROM pedidos WHERE activo=1 and pagado=1 and facturado=0 and id_cliente='".$idCliente."' ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $tPedidos;
    }
        public function getUnPedido($idPedido){
        try{
            $consulta="SELECT * FROM pedidos WHERE id_pedido='$idPedido' and activo=1";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
            if (empty($tPedidos)){
            //$c=new Pedido();
            $c=null;
        }
        else{
            
                $p= new Pedido($tPedidos[0][0],$tPedidos[0][1],$tPedidos[0][2],$tPedidos[0][3],$tPedidos[0][4],$tPedidos[0][5],$tPedidos[0][6],$tPedidos[0][7],$tPedidos[0][8],$tPedidos[0][9],$tPedidos[0][10],$tPedidos[0][11],$tPedidos[0][12],$tPedidos[0][13],$tPedidos[0][14]);
            }
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $p;
        }
        public function getPedidosFiltroFechasCliente($idCliente,$fechaInicio,$fechaFin){
        try{
            $consulta="SELECT * FROM pedidos WHERE activo=1 and pagado=1 and facturado=1 and id_cliente='".$idCliente."' and fecha_factura BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedidos=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return $tPedidos;
    }
        public function getCantidadPedidosCliente($idCliente,$facturado){
        try{
            $consulta="SELECT COUNT(id) FROM pedidos WHERE pagado=1 and facturado=".$facturado." and id_cliente='".$idCliente."' and fecha_entrega='0000-00-00'";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tPedido=$query->fetchAll();
            if (empty($tPedido)){
                $numero=0;
                }else{
                    $numero=$tPedido[0][0];
                }
        } catch (Exception $ex){
            echo "Se ha producido un error en getPedidosTodos";
        }
        return ($numero);
    }
    
    
}

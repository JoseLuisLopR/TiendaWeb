<?php

require_once 'Conexion.php';
class LineasPedidos {
        private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonLineasPedidos(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
     public function addLineaPedido(LineaPedido $c){
            try{
                $consulta="INSERT INTO lineas_pedidos (`id`, `id_pedido`, `id_producto`,"
                        . " `unidades`, `descripcion`, `pvp`, `tipo_iva`, `activo`)"
                        . " values (null,?,?,?,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdPedido());
                @$query->bindParam(2,$c->getIdProducto());
                @$query->bindParam(3,$c->getUnidades());
                @$query->bindParam(4,$c->getDescripcion());
                @$query->bindParam(5,$c->getPvp());
                @$query->bindParam(6,$c->getTipoIva());
                @$query->bindParam(7,$c->getActivo());
                
                $query->execute();
                $insertado=true;
                // para el proyecto final, contemplar la posibilidad de que se produzca error en la insercion
                // y haya que recuperar el estado anterior de la tabla
            } catch (Exception $ex) {
                $insertado=false;
            }
            return $insertado;
        }
        public function getLineasUnPedido($idPedido){
        try{
            $consulta="SELECT * FROM lineas_pedidos WHERE activo=1 and id_pedido=".$idPedido;
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getLineasUnPedido2($idPedido){
        try{
            $consulta="SELECT * FROM lineas_pedidos WHERE activo=1 and id_pedido=".$idPedido;
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
            if (empty($tClientes)){
            //$c=new Cliente();
            $c=null;
        }
        else{
            $c = array();
            foreach ($tClientes as $pr) {
                @$p=new LineasPedidos($pr[0],$pr[1],$pr[2],$pr[3],$pr[4],$pr[5],$pr[6],$pr[7]);
                array_push($c, $p);
            }}
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
}

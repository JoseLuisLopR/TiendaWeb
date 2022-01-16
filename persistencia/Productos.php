<?php

require_once 'Conexion.php';
class Productos {
    private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonProductos(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
    public function getProductosTodos(){
        try{
            $consulta="SELECT * FROM productos ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getProductosActivos(){
        try{
            $consulta="SELECT * FROM productos WHERE activo!=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getProductosNoActivos(){
        try{
            $consulta="SELECT * FROM productos WHERE activo=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getProductosTodos2(){
        try{
            
            $tablaObjetosProductos = array();
            $consulta="SELECT * FROM productos ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tProductos=$query->fetchAll();
            foreach ($tProductos as $pr) {
                @$p=new Producto($pr[0],$pr[1],$pr[2],$pr[3],$pr[4],$pr[5],$pr[6],$pr[7],$pr[8],$pr[9],$pr[10],$pr[11],$pr[12],$pr[13]);
                array_push($tablaObjetosProductos, $p);
            }
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tablaObjetosProductos;
    }
    public function addUnProducto(Producto $c){
            try{
                $consulta="INSERT INTO productos (id,id_producto,id_familia,tipo_iva,precio_coste,pvp,descripcion,codigo_barras,id_proveedor,stock_actual,stock_minimo,stock_maximo,ruta_foto,activo) values (null,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdProducto());
                @$query->bindParam(2,$c->getIdFamilia());
                @$query->bindParam(3,$c->getTipoIva());
                @$query->bindParam(4,$c->getPrecioCoste());
                @$query->bindParam(5,$c->getPvp());
                @$query->bindParam(6,$c->getDescripcion());
                @$query->bindParam(7,$c->getCodigoBarras());
                @$query->bindParam(8,$c->getIdProveedor());
                @$query->bindParam(9,$c->getStockActual());
                @$query->bindParam(10,$c->getStockMinimo());
                @$query->bindParam(11,$c->getStockMaximo());
                @$query->bindParam(12,$c->getRutaFoto());
                @$query->bindParam(13,$c->getActivo());

                
                $query->execute();
                $insertado=true;
                // para el proyecto final, contemplar la posibilidad de que se produzca error en la insercion
                // y haya que recuperar el estado anterior de la tabla
            } catch (Exception $ex) {
                $insertado=false;
            }
            return $insertado;
        }
        public function getNumeroProductoMismoIdFamilia($idFamilia) {
            try{
                
                $consulta = "SELECT COUNT(id) FROM productos WHERE id_producto like '$idFamilia"."%'";
                //print_r($consulta);
                $query=$this->db->preparar($consulta);
                $query->execute();
                $tProducto=$query->fetchAll();
                if (empty($tProducto)){
                $numero=0;
                }else{
                    $numero=$tProducto[0][0];
                }
                
            } catch (Exception $ex){
                $numero=-1;
            }
            
            return $numero;
        }
         public function delUnProducto($numProducto){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE productos set activo='false' where id_producto=$numProducto";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
        public function altaProducto($numProducto){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE productos set activo=1 where id_producto=$numProducto";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
    public function quitarStock($idProducto,$cantidad){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE productos set stock_actual=stock_actual-".$cantidad." where id_producto=$idProducto";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
    public function perteneceAProveedor($idProducto,$idProveedor){
        try{
        $consulta = "SELECT * FROM productos WHERE id_producto='$idProducto' and id_proveedor='$idProveedor'";
                //print_r($consulta);
                $query=$this->db->preparar($consulta);
                $query->execute();
                $tProducto=$query->fetchAll();
                if (empty($tProducto)){
                    return false;;
                }else{
                    return true;;
                }
                
            } catch (Exception $ex){
                return false;
            }
    }
    public function addStock($idProducto,$stock) {
        try{
            $consulta ="UPDATE productos set stock_actual=stock_actual+".$stock." where id_producto=$idProducto";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
    public function updateProducto($producto) {
                try{
            $idProducro = $producto->getIdProducto();
            $idFamilia = $producto->getIdFamilia();
            $tipoIva = $producto->getTipoIva();
            $pvp = $producto->getPvp();
            $descripcion = $producto->getDescripcion();
            $idProveedor = $producto->getIdProveedor();
            $stockMinimo = $producto->getStockMinimo();
            $stockMaximo = $producto->getStockMaximo();
            $precioCoste = $producto->getPrecioCoste();
            $consulta ="UPDATE `productos` SET `id_familia`='$idFamilia',`tipo_iva`='$tipoIva',`precio_coste`='$precioCoste',`pvp`='$pvp',`descripcion`='$descripcion',`id_proveedor`='$idProveedor',`stock_minimo`='$stockMinimo',`stock_maximo`='$stockMaximo' WHERE id_producto='$idProducro'";
            //echo $consulta;
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
}

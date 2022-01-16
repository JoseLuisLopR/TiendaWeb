<?php

require_once 'Conexion.php';

class FamiliasProductos {
    private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonFamiliasProductos(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
    public function getFamiliasTodas(){
        try{
            $consulta="SELECT * FROM familias_productos ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getFamiliasActivas(){
        try{
            $consulta="SELECT * FROM familias_productos WHERE activo!=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getFAmiliasNoActivas(){
        try{
            $consulta="SELECT * FROM familias_productos WHERE activo=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function addUnaFamiliaProducto(FamiliaProducto $c){
            try{
                $consulta="INSERT INTO familias_productos (id,id_familia,nombre,descripcion,activo) values (null,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdFamilia());
                @$query->bindParam(2,$c->getNombre());
                @$query->bindParam(3,$c->getDescripcion());
                @$query->bindParam(4,$c->getActivo());

                
                $query->execute();
                $insertado=true;
                // para el proyecto final, contemplar la posibilidad de que se produzca error en la insercion
                // y haya que recuperar el estado anterior de la tabla
            } catch (Exception $ex) {
                $insertado=false;
            }
            return $insertado;
        }
        public function getUltimoId() {
            try{
                $consulta = "SELECT MAX(id) FROM familias_productos";
                $query=$this->db->preparar($consulta);
                $query->execute();
                $maxId=$query->fetchAll();
                $numero = $maxId[0][0];
                
            } catch (Exception $ex){
                $numero=-1;
            }
            
            return $numero;
        }
        public function existeFamilia($idFamilia) {
             $consulta = "SELECT COUNT(id) FROM familias_productos WHERE id_familia='$idFamilia'";
             //echo $idFamilia;
                $query=$this->db->preparar($consulta);
                $query->execute();
                $maxId=$query->fetchAll();
                $numero = $maxId[0][0];
                //echo $numero;
                if(!empty($maxId[0][0])){
                    return true;
                }else{
                    return false;
                }
        }
            public function getFamiliasProductosTodas2(){
        try{
            $consulta="SELECT * FROM familias_productos";
            
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
                @$p=new FamiliaProducto($pr[0],$pr[1],$pr[2],$pr[3],$pr[4]);
                array_push($c, $p);
            }}
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $c;
    }
    public function bajaFamiliaProducto($idFamilia){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE familias_productos set activo=0 where id_familia='$idFamilia'";
            //echo $consulta;
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
        public function altaFamiliaProducto($idFamilia){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE familias_productos set activo=1 where id_familia='$idFamilia'";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
            public function updateFamiliaProducto($familia){
        //Hace un borrado lógico
        try{
            $idFamilia = $familia->getIdFamilia();
            $nombre = $familia->getNombre();
            $descripcion = $familia->getDescripcion();
            $consulta ="UPDATE familias_productos SET `nombre`='$nombre',`descripcion`='$descripcion' where id_familia='$idFamilia'";
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

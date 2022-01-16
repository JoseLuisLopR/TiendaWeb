<?php

    require_once 'Conexion.php';

class DireccionesClientes {
    private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonDireccionesClientes(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
    public function getDireccionesClientesTodos(){
        try{
            $consulta="SELECT * FROM direcciones_clientes WHERE activo!=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getDireccionesClientesTodos2(){
        try{
            $consulta="SELECT * FROM direcciones_clientes";
            
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
                @$p=new DireccionCliente($pr[0],$pr[1],$pr[2],$pr[3],$pr[4],$pr[5],$pr[6],$pr[7]);
                array_push($c, $p);
            }}
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $c;
    }
        public function getDireccionUnCliente($idCliente){
        try{
            $consulta="SELECT * FROM direcciones_clientes where id_cliente='$idCliente'";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
            if (empty($tClientes)){
            //$c=new Cliente();
            $p=new DireccionesClientes();
        }
        else{
                @$p=new DireccionCliente($tClientes[0][0],$tClientes[0][1],$tClientes[0][2],$tClientes[0][3],$tClientes[0][4],$tClientes[0][5],$tClientes[0][6],$tClientes[0][7]);
            }
       
        } catch (Exception $ex){
            $p=new DireccionesClientes();
            echo "Se ha producido un error en getClientesTodos";
        }
        return $p;
    }
    
    public function addUnaDireccionCliente(DireccionCliente $c){
            try{
                $consulta="INSERT INTO direcciones_clientes (id_cliente,calle,codpostal,localidad,provincia,pais,activo) values (?,?,?,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdCliente());
                @$query->bindParam(2,$c->getCalle());
                @$query->bindParam(3,$c->getCodPostal());
                @$query->bindParam(4,$c->getLocalidad());
                @$query->bindParam(5,$c->getProvincia());
                @$query->bindParam(6,$c->getPais());
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
        public function bajaDireccionCliente($id){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE direcciones_clientes set activo=0 where id=$id";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
        public function altaDireccionCliente($id){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE direcciones_clientes set activo=1 where id=$id";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
            public function updateDireccionCliente($direccion){
        //Hace un borrado lógico
        try{
            $id = $direccion->getId();
            $idCliente = $direccion->getIdCliente();
            $calle = $direccion->getCalle();
            $codPostal = $direccion->getCodPostal();
            $localidad = $direccion->getLocalidad();
            $provincia = $direccion->getProvincia();
            $pais = $direccion->getPais();
            $consulta ="UPDATE direcciones_clientes SET`id_cliente`='$idCliente',`calle`='$calle',`codpostal`='$codPostal',`localidad`='$localidad',`provincia`='$provincia',`pais`='$pais' where id=$id";
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

<?php

require_once 'Conexion.php';

class Clientes {
    private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonClientes(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
    public function getClientesActivos(){
        try{
            $consulta="SELECT * FROM clientes WHERE activo!=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getClientesNoActivos(){
        try{
            $consulta="SELECT * FROM clientes WHERE activo=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getClientesTodos(){
        try{
            $consulta="SELECT * FROM clientes";
            
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
                @$p=new Cliente($pr[0],$pr[1],$pr[2],$pr[3],$pr[4],$pr[5],$pr[6],$pr[7],$pr[8],$pr[9]);
                array_push($c, $p);
            }}
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $c;
    }
    public function getClientesTodos2(){
        try{
            $consulta="SELECT * FROM clientes";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getUnCliente($numCliente) {
        //Conseguimos un cliente concreto que tenga en el id_cliente el que entra como parametro en el método
        try{
            $consulta="SELECT * FROM clientes WHERE id_cliente=$numCliente and activo=1";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getUnCliente";
        }
        if (empty($tClientes)){
            //$c=new Cliente();
            $c=null;
        }
        else{
            $c = new Cliente($tClientes[0][0],$tClientes[0][1],$tClientes[0][2],$tClientes[0][3],$tClientes[0][4],$tClientes[0][5],$tClientes[0][6],$tClientes[0][7],$tClientes[0][8],$tClientes[0][9]);
        }
        return $c;
    }
    public function delUnCliente($numCliente){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE clientes set activo='false' where id_cliente=$numCliente";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
        public function altaCliente($numCliente){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE clientes set activo=1 where id_cliente=$numCliente";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
    public function addUnCliente(Cliente $c){
            try{
                $consulta="INSERT INTO clientes (id_cliente,nombre,apellido1,apellido2,nif,varon,numcta,como_nos_conocio,activo) values (?,?,?,?,?,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdCliente());
                @$query->bindParam(2,$c->getNombre());
                @$query->bindParam(3,$c->getApellido1());
                @$query->bindParam(4,$c->getApellido2());
                @$query->bindParam(5,$c->getNif());
                @$query->bindParam(6,$c->getVaron());
                @$query->bindParam(7,$c->getNumCta());
                @$query->bindParam(8,$c->getComoNosConocimos());
                @$query->bindParam(9,$c->getActivo());
                
                $query->execute();
                $insertado=true;
                // para el proyecto final, contemplar la posibilidad de que se produzca error en la insercion
                // y haya que recuperar el estado anterior de la tabla
            } catch (Exception $ex) {
                $insertado=false;
            }
            return $insertado;
        }
        
        public function getNumeroClienteMismoCodpostal($codPostal) {
            try{
                $consulta = "SELECT COUNT(id) FROM clientes WHERE id_cliente like '$codPostal"."%'";
                $query=$this->db->preparar($consulta);
                $query->execute();
                $tCliente=$query->fetchAll();
                if (empty($tCliente)){
                $numero=0;
                }else{
                    $numero=$tCliente[0][0];
                }
                
            } catch (Exception $ex){
                $numero=-1;
            }
            
            return $numero;
        }
        public function updateCliente($cliente){
        //Hace un borrado lógico
        try{
            $idCliente = $cliente->getIdCliente();
            $nombre = $cliente->getNombre();
            $apellido1 = $cliente->getApellido1();
            $apellido2 = $cliente->getApellido2();
            $nif = $cliente->getNif();
            $varon = $cliente->getVaron();
            $numCta = $cliente->getNumCta();
            $cnc = $cliente->getComoNosConocimos();
            $consulta ="UPDATE clientes SET`nombre`='$nombre',`apellido1`='$apellido1',`apellido2`='$apellido2',`nif`='$nif',`varon`=$varon,`numcta`='$numCta',`como_nos_conocio`='$cnc' where id_cliente=$idCliente";
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

<?php

require_once 'Conexion.php';

class Empleados {
    private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonEmpleados(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
    public function getEmpleadosTodos(){
        try{
            $consulta="SELECT * FROM empleados ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getEmpleadosActivos(){
        try{
            $consulta="SELECT * FROM empleados WHERE activo!=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getEmpleadosNoActivos(){
        try{
            $consulta="SELECT * FROM empleados WHERE activo=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tClientes=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tClientes;
    }
    public function getEmpleadosLocalidad($localidad){
        try{
            $consulta="SELECT * FROM empleados WHERE localidad='$localidad' and activo!=0";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tEmpleados=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getEmpleadosTodos";
        }
        return $tEmpleados;
    }
    
        public function getUnCliente($numEmpleado) {
        //Conseguimos un cliente concreto que tenga en el id_cliente el que entra como parametro en el método
        try{
            $consulta="SELECT * FROM empleados WHERE id_cliente=$numEmpleado and activo!=0";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tEmpleados=$query->fetchAll();
        } catch (Exception $ex){
            echo "Se ha producido un error en getUnEmpleado";
        }
        if (empty($tEmpleados)){
            //$c=new Cliente();
            $c=null;
        }
        else{
            $c = new Empleado($tEmpleados[0][0],$tEmpleados[0][1],$tEmpleados[0][2],$tEmpleados[0][3],$tEmpleados[0][4],$tEmpleados[0][5],$tEmpleados[0][6],$tEmpleados[0][7],$tEmpleados[0][8],$tEmpleados[0][9],$tEmpleados[0][10]);
        }
        return $c;
    }
        public function addUnEmpleado(Empleado $c){
            try{
                $consulta="INSERT INTO empleados (id_empleado,nombre,apellido1,apellido2,numcta,movil,localidad,cod_postal,provincia,activo) values (?,?,?,?,?,?,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdEmpleado());
                @$query->bindParam(2,$c->getNombre());
                @$query->bindParam(3,$c->getApellido1());
                @$query->bindParam(4,$c->getApellido2());
                @$query->bindParam(5,$c->getNumCta());
                @$query->bindParam(6,$c->getMovil());
                @$query->bindParam(7,$c->getLocalidad());
                @$query->bindParam(8,$c->getCodPostal());
                @$query->bindParam(9,$c->getProvincia());
                @$query->bindParam(10,$c->getActivo());
                
                $query->execute();
                $insertado=true;
                // para el proyecto final, contemplar la posibilidad de que se produzca error en la insercion
                // y haya que recuperar el estado anterior de la tabla
            } catch (Exception $ex) {
                $insertado=false;
            }
            return $insertado;
        }
    public function getNumeroEmpleadoMismoCodpostal($codPostal) {
            try{
                $consulta = "SELECT COUNT(id) FROM empleados WHERE id_cliente like '$codPostal"."%'";
                $query=$this->db->preparar($consulta);
                $query->execute();
                $tCliente=$query->fetchAll();
                if (empty($tEmpleado)){
                $numero=0;
                }else{
                    $numero=$tEmpleado[0][0];
                }
                
            } catch (Exception $ex){
                $numero=-1;
            }
            
            return $numero;
        }
            public function delUnEmpleado($numEmpleado){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE empleados set activo=0 where id_empleado=$numEmpleado";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
        public function altaEmpleado($numEmpleado){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE empleados set activo=1 where id_empleado=$numEmpleado";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
        public function getEmpleadosTodos2(){
        try{
            $consulta="SELECT * FROM empleados";
            
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
                @$p = new Empleado($pr[0],$pr[1],$pr[2],$pr[3],$pr[4],$pr[5],$pr[6],$pr[7],$pr[8],$pr[9],$pr[10]);
                array_push($c, $p);
            }}
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $c;
    }
    public function updateEmpleado($empleado){
        //Hace un borrado lógico
        try{
            $idEmpleado = $empleado->getIdEmpleado();
            $nombre = $empleado->getNombre();
            $apellido1 = $empleado->getApellido1();
            $apellido2 = $empleado->getApellido2();
            $numCta = $empleado->getNumCta();
            $movil = $empleado->getMovil();
            $localidad = $empleado->getLocalidad();
            
            $codPostal = $empleado->getCodPostal();
            $provincia = $empleado->getProvincia();
            $consulta ="UPDATE clientes SET`nombre`='$nombre',`apellido1`='$apellido1',`apellido2`='$apellido2',`numcta`='$numCta',`movil`='$movil',`localidad`='$localidad',`cod_postal`='$codPostal',`provincia`='$provincia' where id_empleado=$idEmpleado";
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

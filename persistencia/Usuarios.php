<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author Juan
 */
include_once 'Conexion.php';
class Usuarios {
        private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    public static function singletonUsuarios(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
        public function addUnUsuario(Usuario $c){
            try{
                $consulta="INSERT INTO `usuarios`(`id_usuario`, `id_rol`, `login`, `password`, `activo`) VALUES (?,?,?,?,?)";
                //echo '$consulta<br>';
                //var_dump($c);
                @$query=$this->db->preparar($consulta);
                @$query->bindParam(1,$c->getIdUsuario());
                @$query->bindParam(2,$c->getIdRol());
                @$query->bindParam(3,$c->getLogin());
                @$query->bindParam(4,$c->getPassword() );
                @$query->bindParam(5,$c->getActivo());
               
                
                $query->execute();
                $insertado=true;
            } catch (Exception $ex) {
                $insertado=false;
            }
            return $insertado;
        }
        public function countUsuaariosIdRol($idRol) {
            try{
                $consulta = "SELECT COUNT(id) FROM usuarios WHERE id_rol like '$idRol"."%'";
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
        public function existeUsuario($login) {
            try{
                $consulta = "SELECT COUNT(id) FROM usuarios WHERE login='$login'";
                $query=$this->db->preparar($consulta);
                $query->execute();
                $tCliente=$query->fetchAll();
                if (empty($tCliente)){
                    return false;
                }else{
                    $numero=$tCliente[0][0];
                    if ($numero=="1"){ 
                        return true;
                        
                    } else {
                        return false;
                    }
                }
                
            } catch (Exception $ex){
                return false;;
            }
        }
        
        public function getUsuariosTodos(){
        try{
            $consulta="SELECT * FROM usuarios";
            
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
                @$p=new Usuario($pr[0],$pr[1],$pr[2],$pr[3],$pr[4],$pr[5]);
                array_push($c, $p);
            }}
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $c;
    }
    
    public function bajaUsuario($id){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE usuarios set activo=0 where id='$id'";
            //echo $consulta;
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
    public function altaUsuario($id){
        //Hace un borrado lógico
        try{
            $consulta ="UPDATE usuarios set activo=1 where id='$id'";
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
    
    public function cambiarRol($id,$idRol){
        
        try{

            $consulta ="UPDATE usuarios SET `id_rol`='$idRol' where id='$id'";
            //echo $consulta;
            $query=$this->db->preparar($consulta);
            $query->execute();
            $eliminado=true;
        } catch (Exception $ex){
            $eliminado=false;
        }
        return $eliminado;
    }
    
    public function obtenerUsuario($login) {
        try{
            $consulta="SELECT * FROM usuarios where login='$login'";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $pr=$query->fetchAll();
            if (empty($pr)){
            //$c=new Cliente();
            $p=null;
        }
        else{
            
                @$p=new Usuario($pr[0][0],$pr[0][1],$pr[0][2],$pr[0][3],$pr[0][4],$pr[0][5]);

            }
       
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $p;
    }
}

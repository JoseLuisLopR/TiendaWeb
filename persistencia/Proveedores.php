<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedores
 *
 * @author Juan
 */
require_once 'Conexion.php';
class Proveedores {
    private static $instancia;
    private $db;
    
    function __construct() {
        $this->db= Conexion::singleton_conexion();
    }
    
    
    public static function singletonProveedores(){
        if (!isset(self::$instancia)){
            $miclase=__CLASS__;
            self::$instancia=new $miclase;
        }
        return self::$instancia;
    }
    public function getProveedoresTodos(){
        try{
            
            $tablaObjetosProductos = array();
            $consulta="SELECT * FROM proveedores ";
            
            $query=$this->db->preparar($consulta);
            $query->execute();
            $tProductos=$query->fetchAll();
            foreach ($tProductos as $pr) {
                @$p=new Proveedor($pr[0],$pr[1],$pr[2],$pr[3],$pr[4]);
                array_push($tablaObjetosProductos, $p);
            }
        } catch (Exception $ex){
            echo "Se ha producido un error en getClientesTodos";
        }
        return $tablaObjetosProductos;
    }
            public function existeProveedor($idFamilia) {
             $consulta = "SELECT COUNT(id) FROM proveedores WHERE id_proveedor='$idFamilia'";
                $query=$this->db->preparar($consulta);
                $query->execute();
                $maxId=$query->fetchAll();
                $numero = $maxId[0][0];
                if(!empty($maxId[0][0])){
                    return true;
                }else{
                    return false;
                }
        }
}

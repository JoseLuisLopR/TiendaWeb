<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';

        if (isset($_POST['alta'])){
                $campoasVacios = false;
       foreach ($_POST as $a) {
                    if (empty($a)) {
                        $campoasVacios = true;
                    }
                }
                if (!$campoasVacios) {
            require_once '../../persistencia/Empleados.php';
            require_once '../../objetos/Empleado.php';

            
            $tEmpleado= Empleados::singletonEmpleados();
            
                     
            $codPostal=$_POST['cod_postal'];
            $codigo=$tEmpleado->getNumeroEmpleadoMismoCodpostal($codPostal)+1;
            
            $resta = 4-(strlen($codigo));
            for ($i=1;$i<=$resta;$i++){
                $codigo = "0".$codigo;
                //echo $codigo;
                }
                   
            //echo "<p>El código de cliente será: $codigo <br>";
            $idEmpleado=$codPostal . (string)$codigo;
            //var_dump($_POST);
            @$c = new Empleado($id, $idEmpleado, $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['numCta'], $_POST['movil'], $_POST['localidad'], $_POST['cod_postal'], $_POST['provincia'], 1);
            
            
            $insertado = $tEmpleado->addUnEmpleado($c);
            
            if ($insertado){
                           echo "<h5 class='green darken-1'>Se ha insetado correctamente</h5>";

            }else{
                echo '<p>Se ha producido un error en el insertado</p>';
            }
                }else{           echo "<h5 class='red darken-1'>Faltan campos por rellenar</h5>";}
            }
            
            
            ?>
        <center><h3>Formulario de petición de datos de un empleado</h3>
        <form name="DNI" method="POST" action="altaEmpleado.php"> 
            <div class="input-field col s6"><input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) {echo $_POST['nombre'];} ?>"><label>Nombre</label></div> 
            <div class="input-field col s6"><input type="text" name="apellido1" value="<?php if (isset($_POST['apellido1'])) {echo $_POST['apellido1'];} ?>"><label>Primer Apellido</label></div>  
            <div class="input-field col s6"><input type="text" name="apellido2" value="<?php if (isset($_POST['apellido2'])) {echo $_POST['apellido2'];} ?>"><label>Segundo Apellido</label></div>
            <div class="input-field col s6"><input type="text" name="numCta" value="<?php if (isset($_POST['numCta'])) {echo $_POST['numCta'];} ?>"><label>Número de Cuenta</label></div>
            <div class="input-field col s6"><input type="text" name="movil" value="<?php if (isset($_POST['movil'])) {echo $_POST['movil'];} ?>"><label>Móvil</label></div>  
            <div class="input-field col s6"><input type="text" name="localidad" value="<?php if (isset($_POST['localidad'])) {echo $_POST['localidad'];} ?>"><label>Localidad</label></div>
             
            <div class="input-field col s6"><input type="text" name="cod_postal" value="<?php if (isset($_POST['cod_postal'])) {echo $_POST['cod_postal'];} ?>"><label>Código Postal</label></div>
            <div class="input-field col s6"><input type="text" name="provincia" value="<?php if (isset($_POST['provincia'])) {echo $_POST['provincia'];} ?>"><label>Provincia</label></div>
            
            <br>
            <input class="btn waves-effect waves-light" type="submit" name="alta" value="Dar de alta">
            <input class="btn waves-effect waves-light" type="reset"  value="Limpiar">
        <?php
            echo '</div>';
            include './footer.php';
            }else{header("Location: ../vista_usuario/");} ?>

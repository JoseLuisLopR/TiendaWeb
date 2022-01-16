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
            require_once '../../persistencia/DireccionesClientes.php';
            require_once '../../objetos/DireccionCliente.php';
            $tDireccion = DireccionesClientes::singletonDireccionesClientes();
            @$d = new DireccionCliente($id, $_POST['idCliente'], $_POST['calle'], $_POST['cod_postal'], $_POST['localidad'], $_POST['provincia'], $_POST['pais'], 1);
            $insertado = $tDireccion->addUnaDireccionCliente($d);
                        if ($insertado){
                           echo "<h5 class='green darken-1'>Se ha insetado correctamente</h5>";

            }else{
                echo '<p>Se ha producido un error en el insertado</p>';
            }
                }else{           echo "<h5 class='red darken-1'>Faltan campos por rellenar</h5>";}
            
                    }
            
 ?>
        <form name="DNI" method="POST" action="altaDireccionCliente.php"> 
            <div class="input-field col s6"><input type="text" name="idCliente" value="<?php if (isset($_POST['idCliente'])) {echo $_POST['idCliente'];} ?>"><label>Id Cliente</label></div> 
            <div class="input-field col s6"><input type="text" name="cod_postal" value="<?php if (isset($_POST['cod_postal'])) {echo $_POST['cod_postal'];} ?>"><label>Código Postal</label></div> 
            <div class="input-field col s6"><input type="text" name="calle" value="<?php if (isset($_POST['calle'])) {echo $_POST['calle'];} ?>"><label>Calle</label></div>  
            <div class="input-field col s6"><input type="text" name="localidad" value="<?php if (isset($_POST['localidad'])) {echo $_POST['localidad'];} ?>"><label>Localidad</label></div>
            <div class="input-field col s6"><input type="text" name="provincia" value="<?php if (isset($_POST['provincia'])) {echo $_POST['provincia'];} ?>"><label>Provincia</label></div>  
            <div class="input-field col s6"><input type="text" name="pais" value="<?php if (isset($_POST['pais'])) {echo $_POST['pais'];} ?>"><label>Pais</label></div>

            <br>
            <input class="btn waves-effect waves-light" type="submit" name="alta" value="Dar de alta">
 </form>
        <?php
echo '</div>';
        include './footer.php';

            }else{header("Location: ../vista_usuario/");} ?>
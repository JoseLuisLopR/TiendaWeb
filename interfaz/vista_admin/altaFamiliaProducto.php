<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>

        <?php
                if (isset($_POST['alta'])){
                $campoasVacios = false;
       foreach ($_POST as $a) {
                    if (empty($a)) {
                        $campoasVacios = true;
                    }
                }
                if (!$campoasVacios) {
            require_once '../../persistencia/FamiliasProductos.php';
            require_once '../../objetos/FamiliaProducto.php';

            
            $tFamiliaCliente= FamiliasProductos::singletonFamiliasProductos();
            
            $ultimoId = $tFamiliaCliente->getUltimoId();
            $codigo=$ultimoId+1;
            
            $resta = 3-(strlen($codigo));
            for ($i=1;$i<=$resta;$i++){
                $codigo = "0".$codigo;
                //echo $codigo;
                }
                   

            @$c = new FamiliaProducto($id, $codigo, $_POST['nombre'], $_POST['descripcion'], 1);
            
            
            $insertado = $tFamiliaCliente->addUnaFamiliaProducto($c);
            
            if ($insertado){
                           echo "<h5 class='green darken-1'>Se ha insetado correctamente</h5>";

            }else{
                echo '<p>Se ha producido un error en el insertado</p>';
            }
                }else{           echo "<h5 class='red darken-1'>Faltan campos por rellenar</h5>";}
            }
            ?>
                        <form name="DNI" method="POST" action="altaFamiliaProducto.php"> 
            <div class="input-field col s6"><input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) {echo $_POST['nombre'];} ?>"><label>Nombre</label></div> 
            <div class="input-field col s6"><input type="text" name="descripcion" value="<?php if (isset($_POST['descripcion'])) {echo $_POST['descripcion'];} ?>"><label>Descripción</label></div> 

            <br>
            <input class="btn waves-effect waves-light" type="submit" name="alta" value="Dar de alta">
 </form>
                <?php
            echo '</div>';
            include './footer.php';
            }else{header("Location: ../vista_usuario/");} ?>
<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';

        if (isset($_POST['editar'])){
        ?>
        <h4>Editar Cliente</h4>
        <form name="DNI" method="POST" action="listadoClientesTodos_materialize.php"> 
            <input type='hidden' name='idCliente' value='<?php echo $_POST['idCliente']; ?>'>
            <div class="input-field col s6"><input type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>"><label>Nombre</label></div> 
            <div class="input-field col s6"><input type="text" name="apellido1" value="<?php echo $_POST['apellido1']; ?>"><label>Primer Apellido</label></div>  
            <div class="input-field col s6"><input type="text" name="apellido2" value="<?php echo $_POST['apellido2']; ?>"><label>Segundo Apellido</label></div>
            <div class="input-field col s6"><input type="text" name="nif" value="<?php echo $_POST['nif']; ?>"><label>NIF</label></div>  
            <div class="input-field col s6"><input type="text" name="varon" value="<?php echo $_POST['varon']; ?>"><label>Varón</label></div>
            <div class="input-field col s6"><input type="text" name="numCta" value="<?php echo $_POST['numCta']; ?>"><label>Número de Cuenta</label></div> 
            <div class="input-field col s6"><input type="text" name="cnc" value="<?php echo $_POST['cnc']; ?>"><label>Cómo nos conoció</label></div> 
            <input class="btn waves-effect waves-light" type="submit" name="guardar" value="Guardar cambios">
        </form>
            <?php } 
            
            ?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>

<?php 
session_start();
if ($_SESSION['rol']=='001'){
    include './header.php';
    echo '<div class="container">';
    if (isset($_POST['editar'])){ ?>
        <center><h3>Editar empleado</h3>
            <form name="DNI" method="POST" action="editarEmpleado.php"> 
            <div class="input-field col s6"><input type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>"><label>Nombre</label></div> 
            <div class="input-field col s6"><input type="text" name="apellido1" value="<?php echo $_POST['apellido1']; ?>"><label>Primer Apellido</label></div>  
            <div class="input-field col s6"><input type="text" name="apellido2" value="<?php echo $_POST['apellido2']; ?>"><label>Segundo Apellido</label></div>
            <div class="input-field col s6"><input type="text" name="numCta" value="<?php echo $_POST['numCta']; ?>"><label>Número de Cuenta</label></div>
            <div class="input-field col s6"><input type="text" name="movil" value="<?php echo $_POST['movil']; ?>"><label>Móvil</label></div>  
            <div class="input-field col s6"><input type="text" name="localidad" value="<?php echo $_POST['localidad']; ?>"><label>Localidad</label></div>
             
            <div class="input-field col s6"><input type="text" name="cod_postal" value="<?php echo $_POST['codPostal']; ?>"><label>Código Postal</label></div>
            <div class="input-field col s6"><input type="text" name="provincia" value="<?php echo $_POST['provincia']; ?>"><label>Provincia</label></div>
            
            <br>
            <input class="btn waves-effect waves-light" type="submit" name="alta" value="Dar de alta">
            <input class="btn waves-effect waves-light" type="guardar"  value="Guardar cambios">
        </form>
        <?php
        }
        ?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>

<?php 
session_start();
if ($_SESSION['rol']=='001'){
        include './header.php';
    echo '<div class="container">';
?>
        <?php
        if (isset($_POST['editar'])){
        ?>
      <h4>Cambiar Rol</h4>
      <form name="DNI" method="POST" action="listadoUsuarios_materialeze.php"> 
            <input type='hidden' name='id' value='<?php echo $_POST['id']; ?>'>
            <div class="input-field col s6"><input type="text" name="idRol" value="<?php echo $_POST['idRol']; ?>"><label>Id Rol</label></div> 

            <br>
            <input class="btn waves-effect waves-light" type="submit" name="guardar" value="Guardar cambios">

    </form>
        <?php
        }
 
echo '</div>';
include './footer.php';
            }else{header("Location: ../vista_usuario/");} ?>
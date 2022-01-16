<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';

        if (isset($_POST['editar'])){
        ?>
      <h4>Editar Familia</h4>
      <form name="DNI" method="POST" action="listadoFamiliasProductos.php"> 
            <input type='hidden' name='idFamilia' value='<?php echo $_POST['idFamilia']; ?>'>
            <div class="input-field col s6"><input type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>"><label>Nombre</label></div> 
            <div class="input-field col s6"><input type="text" name="descripcion" value="<?php echo $_POST['descripcion']; ?>"><label>Descripción</label></div> 

            <br>
            <input class="btn waves-effect waves-light" type="submit" name="guardar" value="Guardar cambios">

    </form>
        <?php
        }
        ?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>

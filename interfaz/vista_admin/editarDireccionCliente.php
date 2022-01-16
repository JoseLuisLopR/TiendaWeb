<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';

        if (isset($_POST['editar'])){
        ?>
      <h4>Editar Dirección</h4>
    <form name="DNI" method="POST" action="listadoDireccionesClientes.php"> 
            <input type='hidden' name='id' value='<?php echo $_POST['id']; ?>'>
            <div class="input-field col s6"><input type="text" name="idCliente" value="<?php echo $_POST['idCliente']; ?>"><label>Id Cliente</label></div> 
            <div class="input-field col s6"><input type="text" name="codPostal" value="<?php echo $_POST['codPostal']; ?>"><label>Código Postal</label></div> 
            <div class="input-field col s6"><input type="text" name="calle" value="<?php echo $_POST['calle']; ?>"><label>Calle</label></div>  
            <div class="input-field col s6"><input type="text" name="localidad" value="<?php echo $_POST['localidad']; ?>"><label>Localidad</label></div>
            <div class="input-field col s6"><input type="text" name="provincia" value="<?php echo $_POST['provincia']; ?>"><label>Provincia</label></div>  
            <div class="input-field col s6"><input type="text" name="pais" value="<?php echo $_POST['pais']; ?>"><label>Pais</label></div>

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

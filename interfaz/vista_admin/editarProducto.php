<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';

        if (isset($_POST['editar'])){
        ?>
      <h4>Editar Familia</h4>
      <form name="DNI" method="POST" action="listadoProductos_materialeze.php" enctype="multipart/form-data"> 
            <input type='hidden' name='idProducto' value='<?php echo $_POST['idProducto']; ?>'>
            <input type='hidden' name='rutaFoto' value='<?php echo $_POST['rutaFoto']; ?>'>
            <div class="input-field col s3"><input type="text" name="idFamilia" value='<?php echo $_POST['idFamilia']; ?>'><label>Familia</label></div> 
            <div class="input-field col s6"><input type="text" name="idProveedor" value='<?php echo $_POST['idProveedor']; ?>'><label>Proveedor</label></div> 
            <div class="input-field col s6"><input type="text" name="descripcion" value='<?php echo $_POST['descripcion']; ?>'><label>Descripción</label></div> 
            <div class="input-field col s6"><input type="number" step="any" name="pvp" value='<?php echo $_POST['pvp']; ?>'><label>Precio de venta al publico</label></div> 
            <div class="input-field col s6"><input type="number" step="any" name="precioCoste" value='<?php echo $_POST['precioCoste']; ?>'><label>Precio de coste</label></div> 
            <div class="input-field col s6"><input type="number" step="any" name="iva" value='<?php echo $_POST['iva']; ?>'><label>IVA</label></div> 
            <div class="input-field col s6"><input type="number" name="stockMin" value='<?php echo $_POST['stockMin']; ?>'><label>Stock Mínimo</label></div> 
            <div class="input-field col s6"><input type="number" name="stockMax" value='<?php echo $_POST['stockMax']; ?>'><label>Stock Máximo</label></div> 

<div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="foto">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Foto">
      </div>
    </div>
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

<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
      <h1>Producros</h1>
      <form name="formulario" method="post" action="altaProducto.php">
            <input class="btn waves-effect waves-light" type="submit" name="crear" value="Crear Producto">
        </form>
    <center><form name="formulario" method="post" action="../PDF/imprimirProductosPDF.php">
            <input class="btn waves-effect waves-light" type="submit" name="imprimir" value="Imprimir">
        </form><br>
        <?php
            require_once "../../objetos/Producto.php";
            require_once "../../persistencia/Productos.php";
            
            $tObjeto = Productos::singletonProductos();
            if (isset($_POST["baja"])){
                $tObjeto->delUnProducto($_POST["idProducto"]);
            }
            if (isset($_POST["alta"])){
                $tObjeto->altaProducto($_POST["idProducto"]);
            }if (isset($_POST['guardar'])){
                //print_r($_POST);
                //print_r($_FILES);
                @$prod = new Producto($id, $_POST["idProducto"], $_POST["idFamilia"], $_POST["iva"], $_POST["precioCoste"], $_POST["pvp"], $_POST["descripcion"], $codigoBarras, $_POST["idProveedor"], $stockActual, $_POST["stockMin"], $_POST["stockMax"], $rutaFoto, $activo);
                $tObjeto->updateProducto($prod);
                //echo $_FILES['foto']['name'];
                if($_FILES['foto']['name']!=""){
                    echo 'hola';
                $a = unlink('../'.$_POST['rutaFoto']);
                if($a != true){                    echo 'error al borrar';}else{    echo 'Se ha borrado';}
                $error=move_uploaded_file($_FILES['foto']['tmp_name'],"../".$_POST['rutaFoto']);
                }
                
                
            }
            $objetos=$tObjeto->getProductosTodos2();
            //print_r($objetos);
            
            
echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<th></th>"
                    . "<th>IdProducto</th>"
                    . "<th>IdFamilia</th>"
                    . "<th>IVA</th>"
                    . "<th>Precio Coste</th>"
                    . "<th>Pvp</th>"
                    . "<th>Descripción</th>"
                    . "<th>C.Barras</th>"
                    . "<th>IdProveedor</th>"
                    . "<th>Stock Actual</th>"
                    . "<th>Stock Mínimo</th>"
                    . "<th>Stock Máximo</th>"
                    . "<th>Foto</th>"
                    . "<th>Activo</th>"
                . "</tr>";
            foreach ($objetos as $c) {
                //echo $c->getRutaFoto();
            
                ?>
        <tr>
            <td>
                <!-- Aun no implementado-->
                <form name="formulario" method="post" action="editarProducto.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input type='hidden' name='idProducto' value='<?php echo $c->getIdProducto(); ?>'>
                    <input type='hidden' name='idFamilia' value='<?php echo $c->getIdFamilia(); ?>'>
                    <input type='hidden' name='iva' value='<?php echo $c->getTipoIva(); ?>'>
                    <input type='hidden' name='precioCoste' value='<?php echo $c->getPrecioCoste(); ?>'>
                    <input type='hidden' name='pvp' value='<?php echo $c->getPvp(); ?>'>
                    <input type='hidden' name='descripcion' value='<?php echo $c->getDescripcion(); ?>'>
                    <input type='hidden' name='cBarras' value='<?php echo $c->getCodigoBarras(); ?>'>
                    <input type='hidden' name='idProveedor' value='<?php echo $c->getIdProveedor(); ?>'>                    
                    <input type='hidden' name='stockAct' value='<?php echo $c->getStockActual(); ?>'>
                    <input type='hidden' name='stockMin' value='<?php echo $c->getStockMinimo(); ?>'>
                    <input type='hidden' name='stockMax' value='<?php echo $c->getStockMaximo(); ?>'>
                    <input type='hidden' name='rutaFoto' value='<?php echo $c->getRutaFoto(); ?>'>
                    <input type='hidden' name='activo' value='<?php echo $c->getActivo(); ?>'>
                    <input class="btn waves-effect blue darken-1" type="submit" name="editar" value="Editar">
                </form><br>
                <?php if($c->getActivo()==1){ ?>
                <form name="formulario" method="post" action="listadoProductos_materialeze.php">
                    <input type='hidden' name='idProducto' value='<?php echo $c->getIdPRoducto(); ?>'>
                    <input class="btn waves-effect red darken-1t" type="submit" name="baja" value="Dar de baja">
                </form>
                <?php }else{ ?>
                <form name="formulario" method="post" action="listadoProductos_materialeze.php">
                    <input type='hidden' name='idProducto' value='<?php echo $c->getIdProducto(); ?>'>
                    <input class="btn waves-effect green darken-1t" type="submit" name="alta" value="Dar de alta">
                </form>
                <?php } ?>
            </td>
            <td><?php echo $c->getIdProducto(); ?></td>
            <td><?php echo $c->getIdFamilia(); ?></td>
            <td><?php echo $c->getTipoIva(); ?></td>
            <td><?php echo $c->getPrecioCoste(); ?></td>
            <td><?php echo $c->getPvp(); ?></td>
            <td><?php echo $c->getDescripcion(); ?></td>
            <td><?php echo $c->getCodigoBarras(); ?></td>
            <td><?php echo $c->getIdProveedor(); ?></td>
            <td><?php echo $c->getStockActual(); ?></td>
            <td><?php echo $c->getStockMinimo(); ?></td>
            <td><?php echo $c->getStockMaximo(); ?></td>
            <td><img src='../<?php echo $c->getRutaFoto().'?'.rand(1, 100);?>' width='57'></td>
            <td><?php echo $c->getActivo(); ?></td>
            
        </tr>            
        
                    <?php
            
            }
            echo "</table>";
        ?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>
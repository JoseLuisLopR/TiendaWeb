<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';

        if(isset($_POST['addStock'])||isset($_POST["add"])){
            require_once '../../persistencia/Productos.php';
            require_once '../../objetos/Producto.php';
            echo '<h1>Añadir stock</h1>';
            $idProveedor = $_POST['idProveedor'];
            if(isset($_POST["add"])){
                
                $tProductos = Productos::singletonProductos();
                $perteneceAProveedor = $tProductos->perteneceAProveedor($_POST['idProducto'],$idProveedor);
                if ($perteneceAProveedor){
                    $tProductos->addStock($_POST['idProducto'],$_POST['stock']);
                    ?> 
        <script anguage="JavaScript">
            alert("Stock añadido correctamente");
        </script>    
                    <?php
                }else{
                    ?> 
        <script anguage="JavaScript">
            alert("Error al añadir stock\n El producto indicado no pertenece al proveedor");
        </script>    
                    <?php
                }
            }
            ?>
        <form name="DNI" method="POST" action="addStock.php"> 
        
            <input type="hidden" name="idProveedor" value="<?php echo $idProveedor;?>">
            <div class="input-field col s6"><input type="number" name="idProducto"><label>Id Producto</label></div> 
            <div class="input-field col s6"><input type="number" name="stock"><label>Stock a añadir</label></div> 
            <div><br><input class="btn waves-effect waves-light" type="submit" name="add" value="Añadir stock"></div>
        </form><br>
        <form name="DNI" method="POST" action="listadoProveedores.php">
            <input class="btn waves-effect waves-light" type="submit" name="add" value="Volver">
        </form>
        <?php
        }
        ?>
<?php 
echo '</div>';
include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>

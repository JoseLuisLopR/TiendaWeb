<?php
        require_once '../../objetos/Cliente.php';
        require_once '../../objetos/Producto.php';
        require_once '../../objetos/Pedido.php';
        require_once '../../objetos/LineaPedido.php';

        session_start();
        //print_r($_SESSION['cesta']);
        include './header.php';
        echo '<div class="container">';
        if (isset($_POST['borrar'])) {
            foreach ($_SESSION['cesta'] as $key => $p) {
                if (@$_POST['idProducto'] == $p->getIdProducto()) {
                    unset($_SESSION['cesta'][$key]);
                }
            }
        } else if (isset($_POST['comprar'])) {


//print_r($_SESSION['cesta']);
//unset($_SESSION['cesta']);
            $anadir = true;
            foreach ($_SESSION['cesta'] as $key => $value) {
                if ($_POST['id_producto'] == $value->getIdProducto()) {
                    $anadir = false;
                    $mas = $_SESSION['cesta'][$key];
                    $mas->setUnidades($mas->getUnidades() + $_POST['unidades']);
                    $_SESSION['cesta'][$key] = $mas;
                }
            }
            if ($anadir) {
                $idProducto = $_POST['id_producto'];
                $unidades = $_POST['unidades'];
                $descripcion = $_POST['descripcion'];
                $pvp = $_POST['pvp'];
                $tipoIva = $_POST['tipo_iva'];
//print_r($_POST);
                if (!isset($_SESSION['cesta'])) {
                    $_SESSION['cesta'] = array();
                }

                $detalleProducto = new LineaPedido(0, 0, $idProducto, $unidades, $descripcion, $pvp, $tipoIva, 1);
                array_push($_SESSION['cesta'], $detalleProducto);
            }
        }
        if (count($_SESSION['cesta'])>0 ){
        $cesta = $_SESSION['cesta'];  //Aquí está almacenada la lista de
        //productos y las cantidades que 
        //está comprando el usuario
        echo "<h5>Productos actualmente en tu cesta:</h5><br><br>";
        ?>

        <table class="highlight">
            <tr>
                <th>Referencia</th>
                <th>Unidades</th>
                <th>Descripción</th>
                <th>PVP</th>
                <th>IVA</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
<?php
$baseImponible = 0;
$ivaTotal = 0;
//Investigar el align que en html5 no funciona
foreach ($cesta as $detalleProducto) {
    $subtotal = $detalleProducto->getPvp() *
            $detalleProducto->getUnidades();

    echo "<tr>"
    . "<td>"
    . $detalleProducto->getIdProducto()
    . "</td>"
    . "<td align='right'>"
    . $detalleProducto->getUnidades()
    . "</td>"
    . "<td>"
    . $detalleProducto->getDescripcion()
    . "</td>"
    . "<td>"
    . number_format($detalleProducto->getPvp(), 2) . " €"
    . "</td>"
    . "<td>"
    . $detalleProducto->getTipoIva()
    . "</td>"
    . "<td>"
    . number_format($subtotal, 2) . " €"
    . "</td><td>"
    . "<form action='carrito_materialize.php' name='formulario' method='post'><button class=\"btn waves-effect waves-ligh red darken-1t\" type='submit' name='borrar' >Borrar</button>"
    . "<input type='HIDDEN' name='idProducto' value='" . $detalleProducto->getIdProducto() . "'></form>"
    . "</td></tr>";
    if($_SESSION['rol']==null){echo "<h3>Inicia sesión para terminar la compra";}
    $baseImponible += $subtotal;
    $ivaTotal += $subtotal * $detalleProducto->getTipoIva() / 100;
    @$totalCompra = $baseImponible + $ivaTotal;
}
?>
        </table>
            <?php
            echo "Base Imponible: " . number_format($baseImponible, 2) . " €<br>";
            echo "Total de IVA  : " . number_format($ivaTotal, 2) . " €<br>";
            echo "Total de la compra: " . number_format(@$totalCompra, 2) . " €<br>";
        } else {
            echo '<h5>No hay productos en la cesta</h5>';
}
            ?>
        <table class="bordered">
            <tr>
                <td>
                    <form method="get" action="listadoProductos_materialize.php">

                        <button class="btn waves-effect waves-light" type="submit" name="action">Seguir Comprando
                            <i class="material-icons left">replay</i>
                        </button>

                    </form>
                </td>
                <td>
                    <?php if (count($_SESSION['cesta'])>0 && $_SESSION['rol']=='003'){ ?>
                    <form method="post" action="generarPedido.php">

                        <button class="btn waves-effect waves-light" type="submit" name="action">Terminar Compra
                            <i class="material-icons left">done</i>
                        </button>
                        <input type='HIDDEN' name='total' value='<?php echo $totalCompra ?>'>
                    </form>
                    <?php } ?>

                </td>
            </tr>
        </table>
<?php 
            echo '</div>';
            include './footer.php';
?>

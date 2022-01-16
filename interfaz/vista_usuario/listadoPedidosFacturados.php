<?php 
session_start();
if ($_SESSION['rol']=='003'){
    include './header.php';
    ?>
<div class="container">
    <h4>Listado de pedidos facturados</h4> 
        <?php
require_once '../../persistencia/Productos.php';
require_once '../../persistencia/Pedidos.php';
require_once '../../persistencia/Clientes.php';
require_once '../../persistencia/LineasPedidos.php';

//session_start();
//$idCliente=$_SESSION['idCliente'];
$idCliente=$_SESSION['usuario'];
//echo $idCliente;
$tPedido=Pedidos::singletonPedidos();
if(isset($_POST['buscar'])){
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    if(empty($_POST['fechaInicio'])){$fechaInicio="0000-00-00";}
    if(empty($_POST['fechaFin'])){$fechaFin=date("Y-m-d");}
    $listaPedidos=$tPedido->getPedidosFiltroFechasCliente($idCliente,$fechaInicio,$fechaFin);
}else{
$listaPedidos=$tPedido->getPedidosFacturadosCliente($idCliente);
}
//print_r($listaPedidos);
?>
    
    <div class="row">
            <form  name="formulario" method="post" action="listadoPedidosFacturados.php">
                <div class="col s2"><label>Fecha inicial</label><input type="date" value="<?php echo $fechaInicio; ?>" name="fechaInicio"></div>
                <div class="col s2"><label>Fecha final</label><input type="date" name="fechaFin" value="<?php echo $fechaFin; ?>"></div>
                <div class="col s1"><br><button class="btn waves-effect red darken-1t" type="submit" name="buscar" ><i class='material-icons'>search</i></button></div>
            </form>
        </div>
    
    <?php
echo "<ul class='collapsible' data-collapsible='accordion'>";
foreach ($listaPedidos as $fila)
{
    
      pintarPedido($fila); 
}
echo "</ul>";



?>
</div>
<?php 
include './footer.php';
}else{header("Location: ./");} 
function pintarLineasUnPedido($numPedido){
    //Pinta las tuplas de la tabla LineasPedidos que coincidan 
    //con el idPedido dado por parámetro
    $tLPedido=LineasPedidos::singletonLineasPedidos();
    $listaLineaPedido=$tLPedido->getlineasUnPedido($numPedido);
    
    
    $cabeceraTabla= "<table class='highlight'>
    <tr>
        <th>Unidades</th>
        <th>Descripción</th>
        <th>PVP</th>
        <th>IVA</th>
        <th>Subtotal</th>
    </tr>";
    
    $cuerpoTabla="";
    foreach ($listaLineaPedido as $linea) {
        $subtotal=$linea['pvp']*$linea['unidades'];
        $fila= "<tr><td>".$linea['unidades']."</td>"
            . "<td>".$linea['descripcion']."</td>"
            . "<td>".$linea['pvp']."€</td>"
            . "<td>".$linea['tipo_iva']."%</td>"
             ."<td>".$subtotal."€</td></tr>";
        $cuerpoTabla=$cuerpoTabla.$fila;
    }
    
    return $cabeceraTabla.$cuerpoTabla."</table>";
    
}


function pintarTuplaPedido($tuplaPedido){
    $cabeceraTabla= "<table class='highlight'>
    <tr><td><form name=\"formulario\" method=\"post\" action=\"../PDF/imprimirPedidoPDF.php\">
        <input type='hidden' name='numPedido' value='".$tuplaPedido['id_pedido']."'>
                    <button class=\"btn waves-effect red darken-1t\" type=\"submit\" name=\"pdf\" ><i class='material-icons'>print</i></button>
                </form></td>
        <th>Núm Pedido</th>
        <th>Fecha</th>
        <th>Facturado</th>
        <th>Núm. Factura</th>
        <th>Fecha</th>
        <th>Pagado</th>
        <th>Fecha Pago</th>
    </tr>
    ";
    
    $fila= "<tr><td></td><td>".$tuplaPedido['id_pedido']."</td>"
            . "<td>".$tuplaPedido['fecha_pedido']."</td>"
            . "<td>".$tuplaPedido['facturado']."</td>"
            . "<td>".$tuplaPedido['id_factura']."</td>"
           ."<td>".$tuplaPedido['fecha_factura']."</td>"
           ."<td>".$tuplaPedido['pagado']."</td>"
           ."<td>".$tuplaPedido['fecha_pago']."</td></tr></table>";
    
    return $cabeceraTabla . $fila;
    
}
function pintarPedido($tuplaPedido)
{
    echo "<li>
      <div class='collapsible-header darken-1'><i class='material-icons'>filter_drama</i>"
      .pintarTuplaPedido($tuplaPedido)."</div>
      <div class='collapsible-body'><span>"
      .pintarLineasUnPedido($tuplaPedido['id_pedido'])
      ."</span></div></li>";
    
  }
<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
    
      <h4>Listado de pedidos</h4> 
   

<?php

require_once '../../persistencia/Productos.php';
require_once '../../persistencia/Pedidos.php';
require_once '../../persistencia/Clientes.php';
require_once '../../persistencia/LineasPedidos.php';

//session_start();
//$idCliente=$_SESSION['idCliente'];
//echo $idCliente;
$tPedido=Pedidos::singletonPedidos();
$listaPedidos=$tPedido->getPedidosActivos();
//print_r($listaPedidos);
echo "<ul class='collapsible' data-collapsible='accordion'>";
foreach ($listaPedidos as $fila)
{
    
      pintarPedido($fila); 
}
echo "</ul>";


?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");}  


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
      <div class='collapsible-header darken-1'><i class='material-icons'>filter_drama</i>
      "
      .pintarTuplaPedido($tuplaPedido)."</div>
      <div class='collapsible-body'><span>"
      .pintarLineasUnPedido($tuplaPedido['id_pedido'])
      ."</span></div></li>";
    
  }

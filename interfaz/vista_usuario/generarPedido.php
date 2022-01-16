<?php 
        require_once "../../objetos/Pedido.php";
        require_once "../../persistencia/Pedidos.php";
        require_once "../../persistencia/LineasPedidos.php";
        require_once "../../objetos/LineaPedido.php";
session_start();

if ($_SESSION['rol']=='003'){
    include './header.php';
    echo '<dic class="container">';
        

//print_r($_POST);

        //session_start();
        //print_r($_SESSION['cesta']);
        $tPedido = Pedidos::singletonPedidos();
        $tLineasPedidos = LineasPedidos::singletonLineasPedidos();
        
        $idCliente = $_SESSION['usuario']; //$_SESSION['idCliente'];
        $fechaPedido = date("Y-m-d");
        $pagado = 0;
        $activo = 1;
        $fechaPago = "";
        $idEmpresaTransporte = "";
        $idEmpleadoEmpaqueta = "";
        $fechaEnvio = "";
        $fechaEntrega = "";
        $facturado = 0;
        $fechaFactura = "";
        $metodoPago = "";
        $codigo=$tPedido->getIdNuevoPedido(date("Ymd"));
            
            $resta = 3-(strlen($codigo));
            for ($i=1;$i<=$resta;$i++){
                $codigo = "0".$codigo;
                
                }
                   
            //echo "<p>El código de cliente será: $codigo <br>";
            $idPedido=(string)date("Ymd") . (string)$codigo;
            //echo $idPedido;
        $idFactura = 0;

        @$p = new Pedido($id, $idPedido, $idEmpleadoEmpaqueta, $idEmpresaTransporte, $fechaPedido, $fechaEnvio, $fechaEntrega, $facturado, $idFactura, $fechaFactura, $pagado, $fechaPago, $metodoPago, $idCliente, $activo);
//print_r($p);
        
        $insertado = $tPedido->addPedido($p);
        if ($insertado) {
           //echo 'Pedido insertado';
        } else {
            //echo 'Pedido no insertado';
        }
//Para cada l'ineaa que tenga la cesta, tengo que contruir un objeto de tipo Lineas_Pedidos
//einsertalo en la tabla lineas_pedidos
        $productos = array();
        foreach ($_SESSION['cesta'] as $lineaCesta) {
            @$lp = new LineaPedido($id, $idPedido, $lineaCesta->getIdProducto(), $lineaCesta->getUnidades(), $lineaCesta->getDescripcion(), $lineaCesta->getPvp(), $lineaCesta->getTipoIva(), 1);
            //@$lp2 = new LineaPedido($id, $idPedido, $lineaCesta->getIdProducto(),$lineaCesta->getUnidades(), $descripcion, $pvp, $tipoIva, $activo);
            $a = array($lineaCesta->getIdProducto(),$lineaCesta->getUnidades());
            array_push($productos, $a);
            $insertado = $tLineasPedidos->addLineaPedido($lp);
            if ($insertado) {
                //echo 'Linea insertado';
            } else {
                //echo 'Linea no insertado';
            }
        }

//echo "<input type='HIDDEN' name='total' value='".$_POST["total"]."'>";
//Voy a suponer que en la anterior consulta me da que el idPedido es 2018-00014
//Cambiar a varchar
//$_SESSION['idPedido']="2018-00014"
        //header('Location: pagar.php');
        /*<form name='formulario' method='post' action='pagar.php'>
            <button class='btn waves-effect waves-ligh' type='submit' name='pagar' >Pagar</button>
            <input type='HIDDEN' name='total' value='<?php echo $_POST['total'] ?>'>
        </form>*/
        ?>
        
        <?php
        //print_r($_POST);
        $total = $_POST['total'];
        $codigoPagado = random_int(0, 1000000);
        $_SESSION["pagado"]=array($idPedido, $codigoPagado);
        $_SESSION["unidadesCesta"]=$productos;
        //echo $total;
        ?>
<!--        <center><div id="paypal-button-container"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
// Render the PayPal button
paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

// Specify the style of the button
style: {
  layout: 'vertical',  // horizontal | vertical
  size:   'medium',    // medium | large | responsive
  shape:  'rect',      // pill | rect
  color:  'gold'       // gold | blue | silver | white | black
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: {
  allowed: [
    paypal.FUNDING.CARD,
    paypal.FUNDING.CREDIT
  ],
  disallowed: []
},

// Enable Pay Now checkout flow (optional)
commit: true,

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client: {
  sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
  production: 'EE6kRmSDtaUCB_w6u6aJvhHPppLwdJcCZaWA698ZRm33tqE79ZpJj3uKfiZyGnMExlMBAxyMGvbG7h3v'
},

payment: function (data, actions) {
  return actions.payment.create({
    payment: {
      transactions: [
        {
          amount: {
            total: '<?php //echo $total ?>',
            currency: 'EUR'
          }
        }
      ]
    }
  });
},

onAuthorize: function (data, actions) {
  return actions.payment.execute()
    .then(function () {
      //window.alert('Payment Complete!');
     window.location.replace("pagado.php");
    });
}
}, '#paypal-button-container');
</script>-->
    <center>
    <!--<form name="formulario" method="post" action="../PDF/imprimirPedidoPDF.php">
        <input type="submit" name="pdf" value="Imprimir pedido">
    </form>-->

    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input name="cmd" type="hidden" value="_cart" /> 
        <input name="upload" type="hidden" value="1" /> 
        <input name="business" type="hidden" value="joseluislopezrastrojo-facilitator@gmail.com" />
        <input name="shopping_url" type="hidden" value="http://localhost/tiendaWebFinal/interfaz/vista_usuario/" />
        <input name="currency_code" type="hidden" value="EUR" />


        <input name="return" type="hidden" value="http://localhost/tiendaWebFinal/interfaz//vista_usuario/?pay_code=<?php echo $codigoPagado?>" />
        <input name="notify_url" type="hidden" value="http://mipagina.com/paypal_ipn.php" />


        <input name="rm" type="hidden" value="2" />       
        <input name="item_number_1" type="hidden" value="PAGO2" />
        <input name="item_name_1" type="hidden" value="PAGO" /> 
        
        <input name="amount_1" type="hidden" value="<?php echo $total ?>" /> 
        <input name="quantity_1" type="hidden" value="1" />

        <input class="btn yellow darken-1" type="submit" value="Pagar con PayPal SandBox" /> 
    </form>
</center>

<?php 
echo '</div>';
include './footer.php';

            }else{header("Location: ./");} ?>
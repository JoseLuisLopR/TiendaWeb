<?php
//Recordad que luego hay que cambiarlo cuando enganchemos con el index.php pricipal
session_start();

include 'header.php';
            if(!empty($_SESSION["pagado"]) && isset($_GET['pay_code'])){
            if (@$_GET['pay_code']==$_SESSION["pagado"][1]){
                //print_r($_SESSION);
                
                require_once "../../persistencia/Pedidos.php";
                require_once "../../persistencia/Productos.php";
                require_once "../../objetos/LineaPedido.php";
                
                $tPedido = Pedidos::singletonPedidos();
                $tProducto = Productos::singletonProductos();
                $tPedido->pagarPedido($_SESSION["pagado"][0]);
                foreach ($_SESSION['unidadesCesta'] as $lp){
                    $tProducto->quitarStock($lp[0],$lp[1]);
                }
                $pagina = "pagado.php";
                $_SESSION["pagado"]=null;
                $_SESSION["cesta"]=array();
                $_SESSION["unidadesCesta"]=null;
                header("Location: ./pagado.php");
            }}else{$_SESSION["pagado"]=null;$_SESSION["unidadesCesta"]=null;}
?>
  <!--Section Parte central de la página-->

        <div class="container">
            <center><h1>Bienvenido/a</h1>
        </div>


<?php 
            include './footer.php';
            
?>

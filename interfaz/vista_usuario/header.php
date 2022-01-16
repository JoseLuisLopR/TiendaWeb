<?php 
if(isset($_GET['cerrarsesion'])){
    $_SESSION['usuario']=null;
    $_SESSION['rol']=null;
    $_SESSION['cesta']=array();
header("Location: ./");
}
if(!isset($_SESSION['usuario'])){$_SESSION['usuario']=null;}
if(!isset($_SESSION['rol'])){$_SESSION['rol']=null;}
if(!isset($_SESSION['cesta'])){$_SESSION['cesta']=array();}
require_once "../../persistencia/Pedidos.php";
if($_SESSION['rol']=='003' || $_SESSION['rol']==null){
    //print_r($_SESSION);
$tPedido = Pedidos::singletonPedidos();
$numPedNoFac = $tPedido->getCantidadPedidosCliente($_SESSION['usuario'],"0");
$numPedFac=$tPedido->getCantidadPedidosCliente($_SESSION['usuario'],"1");
} else if($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){header("Location: ../vista_admin/");}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Tienda Web</title>

  <!-- Podemos usar la api de google con los iconos o bien, referenciarlos de las carpetas de materialize locales  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>


<body>

  
    <header>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
<nav class="orange darken-1" role="navigation">

      <div class="nav-wrapper "><a id="logo-container" href="./"  class="brand-logo" >&nbsp;&nbsp;&nbsp;Mi Tienda</a>
      <ul class="right hide-on-med-and-down">
       <?php if ($_SESSION['rol']=='003'){ ?>
          <li>
            <ul id="dropdown5" class="dropdown-content">
                <li><a href="listadoPedidosCliente_materialize.php" >Todos</a></li>
                <li class="divider"></li> <!--Linea división -->
                <li><a href="listadoPedidosNoFacturados.php" >Sin facturar<span class="badge"><?php echo $numPedNoFac; ?></span></a></li>
                <li><a href="listadoPedidosFacturados.php" >Facturados<span class="badge"><?php echo $numPedFac; ?></span></a></li>
            </ul>
      
            <a class="dropdown-button" href="#" data-activates="dropdown5" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mis pedidos</a> 
        </li>
        <li><a href="misdatos.php" >Mis datos</a></li>
        <?php } ?>
        <li><a href="listadoProductos_materialize.php" >Productos</a></li>
        <li><a  href="carrito_materialize.php" ><i class='material-icons'>shopping_cart</i></a></li>
        <?php if (empty($_SESSION['rol'])){ ?>
        <li class="active"><a href="inicioSesion.php" >Inciar Sesión</a></li>
        <?php }else{ ?>
        <li class="active"><a href="./?cerrarsesion" >Cerrar Sesión</a></li>
        <?php } ?>

      </ul>

      <!--Ahora vamos a definir el menú lateral para móviles o tabletas con pantalla pequeña -->
      <ul id="nav-mobile" class="side-nav">
            <li><a  href="carrito_materialize.php" ><i class='material-icons'>shopping_cart</i></a></li>
<?php if ($_SESSION['rol']=='003'){ ?>
          <li>
            <ul id="dropdown4" class="dropdown-content">
                <li><a href="listadoPedidosCliente_materialize.php" >Todos</a></li>
                <li class="divider"></li> <!--Linea división -->
                <li><a href="listadoPedidosNoFacturados.php" >Sin facturar<span class="badge"><?php echo $numPedNoFac; ?></span></a></li>
                <li><a href="listadoPedidosFacturados.php" >Facturados<span class="badge"><?php echo $numPedFac; ?></span></a></li>
            </ul>
      
            <a class="dropdown-button" href="#" data-activates="dropdown4" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mis pedidos</a> 
        </li>
        <li><a href="misdatos.php" >Mis datos</a></li>
        <?php } ?>
        <li><a href="listadoProductos_materialize.php" >Productos</a></li>
        <?php if (empty($_SESSION['rol'])){ ?>
        <li class="active"><a href="inicioSesion.php" >Inciar Sesión</a></li>
        <?php }else{ ?>
        <li class="active"><a href="./?cerrarsesion" >Cerrar Sesión</a></li>
        <?php } ?>

      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

</header>
    <main>

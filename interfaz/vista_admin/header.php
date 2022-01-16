<?php 
if(isset($_GET['cerrarsesion'])){
    $_SESSION['usuario']=null;
    $_SESSION['rol']=null;
    $_SESSION['cesta']=array();
header("Location: ../vista_usuario/");
}
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){}else{header("Location: ../vista_usuario/");}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Proyecto de ERP en web</title>

  <!-- Podemos usar la api de google con los iconos o bien, referenciarlos de las carpetas de materialize locales  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
    <header>
          <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
  <nav class="#aed581 light-blue darken-4" role="navigation">
    
      <div class="nav-wrapper">
        <a id="logo-container" href="./"  class="brand-logo" >&nbsp;&nbsp;&nbsp;Mi Tienda</a>
      <ul class="right hide-on-med-and-down">
                  <?php if ($_SESSION['rol']=='001'){ ?>      
        <li class="active light-blue darken-4 red-text"><i>Administrador</i></li>
        <?php } ?>
          <li><a href="facturar.php" >Facturar</a></li>
          <li><a href="listadoProveedores.php" >Proveedores</a></li>
        <li><a href="listadoClientesTodos_materialize.php" >Clientes</a></li>
        <li><a href="listadoDireccionesClientes.php" >DireccionesClientes</a></li>
        <li><a href="listadoEmpleados_materialize.php" >Empleados</a></li>
        <li><a href="listadoPedidos_materialize.php" >Pedidos</a></li>
        <li><a href="listadoProductos_materialeze.php" >Productos</a></li>
        <li><a href="listadoFamiliasProductos.php" >Familias Productos</a></li>
        <?php if ($_SESSION['rol']=='001'){ ?>
        <li><a href="listadoUsuarios_materialeze.php" >Usuarios</a></li>        
        <?php } ?>
        <li class="active"><a href="./?cerrarsesion" >Cerrar Sesión</a></li>
      </ul> 

      
   


      <!--Ahora vamos a definir el menú lateral para móviles o tabletas con pantalla pequeña -->
      <ul id="nav-mobile" class="side-nav">
                   <?php if ($_SESSION['rol']=='001'){ ?>      
        <li class="active light-blue darken-4 red-text"><i>Administrador</i></li>
        <?php } ?>
          <li><a href="facturar.php" >Facturar</a></li>
          <li><a href="listadoProveedores.php" >Proveedores</a></li>
        <li><a href="listadoClientesTodos_materialize.php" >Clientes</a></li>
        <li><a href="listadoDireccionesClientes.php" >DireccionesClientes</a></li>
        <li><a href="listadoEmpleados_materialize.php" >Empleados</a></li>
        <li><a href="listadoPedidos_materialize.php" >Pedidos</a></li>
        <li><a href="listadoProductos_materialeze.php" >Productos</a></li>
        <li><a href="listadoFamiliasProductos.php" >Familias Productos</a></li>
        <?php if ($_SESSION['rol']=='001'){ ?>
        <li><a href="listadoUsuarios_materialeze.php" >Usuarios</a></li>        
        <?php } ?>
        <li class="active"><a href="./?cerrarsesion" >Cerrar Sesión</a></li>
      </ul> 
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>

    


  </nav>
    </header>
    <main>

<?php 
session_start();

if ($_SESSION['rol']=='003'){
    include './header.php';
    echo '<div class="container">';
            //Realizamos la consulta a la base de datos con el id que traigamos en el $_SESSION;
            //session_start();
            	require_once '../../objetos/Cliente.php';
            	require_once '../../persistencia/Clientes.php';

            	$idCliente=$_SESSION['usuario'];
                //echo $idCliente;
            	$tCliente=Clientes::singletonClientes();
			    //Lanzo la consulta a la base de datos
			    $datosCliente=$tCliente->getUnCliente($idCliente);
                            if (empty($datosCliente)){                                echo 'hola';}
			    //Ya tengo un objeto de la clase Cliente que puedo mostrar

            ?>

        <div class="col s12">

      <div class="row">
        <div class="input-field col s6 ">
        <!--	<i class="material-icons">face</i>
          <i class="material-icons prefix">account_circle</i>
        -->  
          <input disabled value="<?php echo $datosCliente->getNombre() ?>" id="disabled" type="text" class="validate">
          <label for="disabled">Nombre</label>
        </div>
          </div>
          <div class="row">
        <div class="input-field col s6">
          <input disabled value="<?php echo $datosCliente->getApellido1() ?>" id="disabled" type="text" class="validate">
          <label for="last_name">Primer apellido</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input disabled value="<?php echo $datosCliente->getApellido2()?> " id="disabled" type="text" class="validate">
          <label for="disabled">Segundo apellido</div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input disabled value="<?php echo $datosCliente->getNif() ?>" id="disabled" type="text" class="validate">
          <label for="disabled">NIF</label>
        </div>
      </div>
      <!--<div class="row">
        <div class="col s12">
          This is an inline input field:
          <div class="input-field inline">
            <input id="email_inline" type="email" class="validate">
            <label for="email_inline">Email</label>
            <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
          </div>
        </div>
      </div>-->

        </div>

<?php 
            echo '</div>';
            include './footer.php';
                            }else{header("Location: ./");} ?>
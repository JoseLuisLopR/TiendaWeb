<?php
session_start();
include './header.php';
echo '<div class="container">';

    if (isset($_POST['registrar'])) {
        require_once '../../objetos/Usuario.php';
        require_once '../../persistencia/Usuarios.php';

        $tUsuario = Usuarios::singletonUsuarios();
        if (!$tUsuario->existeUsuario($_POST['email'])) {
            if ($_POST['pass'] == $_POST['pass2']) {
                $campoasVacios = false;
                foreach ($_POST as $a) {
                    if (empty($a)) {
                        $campoasVacios = true;
                    }
                }
                if (!$campoasVacios) {
                    require_once '../../persistencia/Clientes.php';
                    require_once '../../objetos/Cliente.php';

                    require_once '../../persistencia/DireccionesClientes.php';
                    require_once '../../objetos/DireccionCliente.php';

                    $tObjeto = Clientes::singletonClientes();
                    $tDireccion = DireccionesClientes::singletonDireccionesClientes();



                    $codPostal = $_POST['cod_postal'];
                    $codigo = $tObjeto->getNumeroClienteMismoCodpostal($codPostal) + 1;

                    @$resta = 4 - (strlen($codigo));
                    for ($i = 1; $i <= $resta; $i++) {
                        $codigo = "0" . $codigo;
                        echo $codigo;
                    }

                    //echo "<p>El código de cliente será: $codigo <br>";
                    $idCliente = $codPostal . (string) $codigo;
                    var_dump($_POST);
                    @$c = new Cliente($id, $idCliente, $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['nif'], 1, $_POST['numCta'], $_POST['comoNosConocimos'], 1);


                    $insertado = $tObjeto->addUnCliente($c);

                    if ($insertado) {
                        echo '<p>Se ha insertado correctamente</p>';
                    } else {
                        echo '<p>Se ha producido un error en el insertado</p>';
                    }



                    @$d = new DireccionCliente($id, $idCliente, $_POST['calle'], $_POST['cod_postal'], $_POST['localidad'], $_POST['provincia'], $_POST['pais'], 1);
                    $insertado = $tDireccion->addUnaDireccionCliente($d);

                    if ($insertado) {
                        echo '<p>Se ha insertado correctamente</p>';
                    } else {
                        echo '<p>Se ha producido un error en el insertado</p>';
                    }



                    $insertado = $tUsuario->addUnUsuario(new Usuario(0, $idCliente, "003", $_POST['email'], sha1($_POST['pass']), 1));
                    if ($insertado) {
                        echo 'Se ha insertado';
                    } else {
                        echo 'No se ha insertado';
                    }
                    $_SESSION['usuario'] = $idCliente;
                    $_SESSION['nombre'] = $_POST['nombre'];
                    header("Location: ./");
                } else {
                    echo "<h5 class='red darken-1'>Faltan campos por rellenar</h5>";
                }
            } else {
                echo "<h5 class='red darken-1'>Las contraseñas no coinciden</h5>";
            }
        } else {
            echo "<h5 class='red darken-1'>El correo ya está registrado</h5>";
        }
    }
    ?>
    <div class="col s12">
        <form class="col s12" method="post" action="registro.php">
            <div class="row">
                <div class="col s6">
                    <div class="input-field col s12"><p><h4>Datos</h4></p></div>
                    <div class="input-field col s12">
                        <input id="icon_prefix" name="email" type="email" class="validate" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} ?>">
                        <label for="icon_prefix">Usuario</label>
                    </div>
                    <div class="input-field col s12" >
                        <input id="icon_telephone" name="pass" type="password" class="validate"  value="<?php if (isset($_POST['pass'])) {echo $_POST['pass'];} ?>">
                        <label for="icon_telephone">Contraseña</label>
                    </div>
                    <div class="input-field col s12" >
                        <input id="icon_telephone" name="pass2" type="password" class="validate"  value="<?php if (isset($_POST['pass2'])) {echo $_POST['pass2'];} ?>">
                        <label for="icon_telephone">Repite la Contraseña</label>
                    </div>
                    <div class="input-field col s12"><input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) {echo $_POST['nombre'];} ?>"><label>Nombre</label></div>
                    <div class="input-field col s12"><input type="text" name="apellido1" value="<?php if (isset($_POST['apellido1'])) {echo $_POST['apellido1'];} ?>"><label>Primer Apellido</label></div>
                    <div class="input-field col s12"><input type="text" name="apellido2" value="<?php if (isset($_POST['apellido2'])) {echo $_POST['apellido2'];} ?>"><label>Segundo Apellido</label></div>
                    <div class="input-field col s12"><input type="text" name="nif" value="<?php if (isset($_POST['nif'])) {echo $_POST['nif'];} ?>"><label>NIF</label></div>
                    <div class="input-field col s12"><input type="text" name="varon" value="<?php if (isset($_POST['varon'])) {echo $_POST['varon'];} ?>"><label>Varón</label></div>

                    <!--<div class="col s12">     
                        <label>Género</label><br><br>
                        <div class="col s3">
                        <input class="with-gap" id="h" name="group1" type="radio" checked />
                        <label for="h">Hombre</label>
                        </div>
                        <div class="col s3">
                        <input class="with-gap" id="m" name="group1" type="radio" checked />
                        <label for="m">Mujer</label>
                        </div>
                    </div>-->
                    <div class="input-field col s12"><input type="text" name="numCta" value="<?php if (isset($_POST['numCta'])) {echo $_POST['numCta'];} ?>"><label>Número de Cuenta</label></div>
                    <div class="input-field col s12"><input type="text" name="comoNosConocimos"value="<?php if (isset($_POST['nomcomoNosConocimosbre'])) {echo $_POST['comoNosConocimos'];} ?>"><label>Cómo nos conoció</label></div>

                </div>
                <div class="col s6">
                    <div class="input-field col s12"><p><h4>Dirección</h4></p></div>
                    <div class="input-field col s12"><input type="text" name="cod_postal" value="<?php if (isset($_POST['cod_postal'])) {echo $_POST['cod_postal'];} ?>"><label>Código Postal</label></div>
                    <div class="input-field col s12"><input type="text" name="calle" value="<?php if (isset($_POST['calle'])) {echo $_POST['calle'];} ?>"><label>Calle</label></div>
                    <div class="input-field col s12"><input type="text" name="localidad" value="<?php if (isset($_POST['localidad'])) {echo $_POST['localidad'];} ?>"><label>Localidad</label></div>
                    <div class="input-field col s12"><input type="text" name="provincia" value="<?php if (isset($_POST['provincia'])) {echo $_POST['provincia'];} ?>"><label>Provincia</label></div>
                    <div class="input-field col s12"><input type="text" name="pais" value="<?php if (isset($_POST['pais'])) {echo $_POST['pais'];} ?>"><label>Pais</label></div>

                </div>







                <div class="input-field col s12" >          
                    <input class="btn waves-effect " id="icon_telephone" name='registrar' type="submit" value="Registar"  >
                </div>
            </div>
        </form>
<?php
echo '</div>';
include './footer.php';


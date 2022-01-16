<?php 
session_start();
if ($_SESSION['rol']=='001'){
    include './header.php';
    echo '<div class="container">';
        
        if (isset($_POST['registrar'])){
            require_once '../../objetos/Usuario.php';
            require_once '../../persistencia/Usuarios.php';
            
            $tUsuario = Usuarios::singletonUsuarios();
             if(!$tUsuario->existeUsuario($_POST['email'])){
                if($_POST['pass']==$_POST['pass2']){
                    $campoasVacios=false;
                    foreach ($_POST as $a){
                        if(empty($a)){$campoasVacios=true;}
                    }
                    if(!$campoasVacios){
            
                        require_once '../../persistencia/Empleados.php';
                        require_once '../../objetos/Empleado.php';

            
                        $tEmpleado= Empleados::singletonEmpleados();


                        $codPostal=$_POST['cod_postal'];
                        $codigo=$tEmpleado->getNumeroEmpleadoMismoCodpostal($codPostal)+1;

                        $resta = 4-(strlen($codigo));
                        for ($i=1;$i<=$resta;$i++){
                            $codigo = "0".$codigo;
                            //echo $codigo;
                            }

                        //echo "<p>El código de cliente será: $codigo <br>";
                        $idEmpleado=$codPostal . (string)$codigo;
                        //var_dump($_POST);
                        @$c = new Empleado($id, $idEmpleado, $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['numCta'], $_POST['movil'], $_POST['localidad'], $_POST['cod_postal'], $_POST['provincia'], 1);
                        $tEmpleado->addUnEmpleado($c);


                        $insertado =$tUsuario->addUnUsuario(new Usuario(0, $idEmpleado, "002", $_POST['email'], sha1($_POST['pass']), 1));
                        header("Location: ./listadoUsuarios_materialeze.php");
                    }else{echo "<h5 class='red darken-1'>Faltan campos por rellenar</h5>";}
        
                }else{echo "<h5 class='red darken-1'>Las contraseñas no coinciden</h5>";}
                        
            }else{echo "<h5 class='red darken-1'>El correo ya está registrado</h5>";}
                        
        }
        
        ?>
<div class="col 6">
                    <form method="post" action="crarUsuarioEmpleado.php">
      <div class="row">
        <div class="input-field col s12">
            <input id="icon_prefix" name="email" type="email" class="validate" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} ?>">
          <label for="icon_prefix">Usuario</label>
        </div><br>
        <div class="input-field col s12" >
            <input id="icon_telephone" name="pass" type="password" class="validate"  value="<?php if (isset($_POST['pass'])) {echo $_POST['pass'];} ?>">
          <label for="icon_telephone">Contraseña</label>
        </div><br>
        <div class="input-field col s12" >
          <input id="icon_telephon" name="pass2" type="password" class="validate"  value="<?php if (isset($_POST['pass2'])) {echo $_POST['pass2'];} ?>">
          <label for="icon_telephon">Repite la Contraseña</label>
        </div>
        
            <div class="input-field col s12"><input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) {echo $_POST['nombre'];} ?>"><label>Nombre</label></div> 
            <div class="input-field col s12"><input type="text" name="apellido1" value="<?php if (isset($_POST['apellido1'])) {echo $_POST['apellido1'];} ?>"><label>Primer Apellido</label></div>  
            <div class="input-field col s12"><input type="text" name="apellido2" value="<?php if (isset($_POST['apellido2'])) {echo $_POST['apellido2'];} ?>"><label>Segundo Apellido</label></div>
            <div class="input-field col s12"><input type="text" name="numCta" value="<?php if (isset($_POST['numCta'])) {echo $_POST['numCta'];} ?>"><label>Número de Cuenta</label></div>
            <div class="input-field col s12"><input type="text" name="movil" value="<?php if (isset($_POST['movil'])) {echo $_POST['movil'];} ?>"><label>Móvil</label></div>  
            <div class="input-field col s12"><input type="text" name="localidad" value="<?php if (isset($_POST['localidad'])) {echo $_POST['localidad'];} ?>"><label>Localidad</label></div>
             
            <div class="input-field col s12"><input type="text" name="cod_postal" value="<?php if (isset($_POST['cod_postal'])) {echo $_POST['cod_postal'];} ?>"><label>Código Postal</label></div>
            <div class="input-field col s12"><input type="text" name="provincia" value="<?php if (isset($_POST['provincia'])) {echo $_POST['provincia'];} ?>"><label>Provincia</label></div>
        
        <div  >          
            <input class="btn waves-effect " id="icon_telephone" name='registrar' type="submit" value="Registar"  >
        </div>
      </div>
    </form>
</div>
            
<?php 
echo '</div>';
include './footer.php';
            }else{header("Location: ../vista_usuario/");} ?>
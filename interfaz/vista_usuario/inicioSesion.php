<?php
require_once '../../objetos/Usuario.php';
require_once '../../persistencia/Usuarios.php';
session_start();
include './header.php';
echo '<div class="container">';
        if(isset($_POST['iniciar'])){

            $tUsuario = Usuarios::singletonUsuarios();
            //echo 'hola';
            if($tUsuario->existeUsuario($_POST['email'])){
                //echo 'hola';
                $user = $tUsuario->obtenerUsuario($_POST['email']);
                if($user->getActivo()=="1"){
                if($user->getPassword()== sha1($_POST['pass'])){
                    
                    $_SESSION['usuario']=$user->getIdUsuario();
                    $_SESSION['rol']=$user->getIdRol();
                    
                    header("Location: ./");
                }else{echo "<h5 class='red darken-1'>Datos incorrectos</h5>";}
                }else{echo "<h5 class='red darken-1'>Datos incorrectos</h5>";}
        
            }else{echo "<h5 class='red darken-1'>Datos incorrectos</h5>";}
            
        }
        ?>
    <center><div class="row">
            <form class="col s12" method="post" action="inicioSesion.php">
      <div class="row" >
        <div class="input-field inline">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" name="email" type="text" class="validate" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
          <label for="icon_prefix">Usuario</label>
        </div><br>
        <div class="input-field inline" width="30%" height="30%">
          <i class="material-icons prefix">lock</i>
          <input id="icon_telephone"  name="pass" type="password" class="validate" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];} ?>"  >
          <label for="icon_telephone">Contraseña</label>
        </div>
        <div class="input-field " >          
            <input class="btn waves-effect " name="iniciar" type="submit" value="Iniciar Sesión"  >
        </div>
      </div>
    </form>
            <form>
                <a href="registro.php">Registrate ahora</a>
            </form>
  </div>
<?php
echo '</div>';
include './footer.php';

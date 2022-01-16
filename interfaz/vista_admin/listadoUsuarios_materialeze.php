<?php 
session_start();
if ($_SESSION['rol']=='001' ){
    include './header.php';
    echo '<div class="container">';
?>
        <h1>Usuaarios</h1>
        <form method="post" action="crarUsuarioEmpleado.php">
            <button class="btn waves-effect waves-light" type="submit" name="action">Crear usuario empleado</button>
        </form><br>
        <?php
        require_once "../../objetos/Usuario.php";
        require_once "../../persistencia/Usuarios.php";
            
            
            $tObjeto = Usuarios::singletonUsuarios();
            if (isset($_POST["baja"])){
                $tObjeto->bajaUsuario($_POST["id"]);
            }
            if (isset($_POST["alta"])){
                $tObjeto->altaUsuario($_POST["id"]);
            }
            if (isset($_POST['guardar'])){
                //print_r($_POST);
                $tObjeto->cambiarRol($_POST['id'],$_POST['idRol']);
            }
            
                        echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<td></td>"
                    
                    . "<th>Usuario</td>"
                    . "<th>Rol</td>"
                    . "<th>Login</td>"
                    . "<th>Password</td>"
                    . "<th>Activo</td>"
                . "</tr>";
            $clientes = $tObjeto->getUsuariosTodos();
            //print_r($clientes);
            foreach ($clientes as $c) {
                ?>
        <tr>
            <td>
                <form name="formulario" method="post" action="cambiarRol.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input type='hidden' name='idRol' value='<?php echo $c->getIdRol(); ?>'>
                    <input class="btn waves-effect blue darken-1 <?php if ($c->getIdRol()=='001'){echo 'disabled';}?>" type="submit" name="editar" value="Cambiar rol">
                </form><br>
                <?php if($c->getActivo()==1){ ?>
                <form name="formulario" method="post" action="listadoUsuarios_materialeze.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input class="btn waves-effect red darken-1t <?php if ($c->getIdRol()=='001'){echo 'disabled';}?>" type="submit" name="baja" value="Dar de baja">
                </form>
                <?php }else{ ?>
                <form name="formulario" method="post" action="listadoUsuarios_materialeze.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input class="btn waves-effect green darken-1t <?php if ($c->getIdRol()=='001'){echo 'disabled';}?>" type="submit" name="alta" value="Dar de alta">
                </form>
                <?php } ?>
            </td>
            <td><?php echo $c->getIdUsuario(); ?></td>
            <td><?php echo $c->getIdRol(); ?></td>
            <td><?php echo $c->getLogin(); ?></td>
            <td><?php echo $c->getPassword(); ?></td>
            <td><?php echo $c->getActivo(); ?></td>
        </tr>            
        
                    <?php
    
}
            echo "</table>";
        ?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>
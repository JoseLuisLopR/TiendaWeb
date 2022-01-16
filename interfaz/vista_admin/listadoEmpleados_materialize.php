<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
        <h1>Listado de Empleados</h1>
        <?php if ($_SESSION['rol']=='001'){ ?>
        <form name="formulario" method="post" action="altaEmpleado.php">
            <input class="btn waves-effect waves-light" type="submit" name="crear" value="Crear Empleado">
        </form>
        <?php } ?>
    <center><form name="formulario" method="post" action="../PDF/imprimirEmpleadosPDF.php">
            <input class="btn waves-effect waves-light" type="submit" name="imprimir" value="Imprimir">
        </form><br>
        <?php
            require_once "../../objetos/Empleado.php";
            require_once "../../persistencia/Empleados.php";
            
            $tObjeto = Empleados::singletonEmpleados();
            
            if (isset($_POST["baja"])){
                $tObjeto->delUnEmpleado($_POST["idEmpleado"]);
            }
            if (isset($_POST["alta"])){
                $tObjeto->altaEmpleado($_POST["idEmpleado"]);
            }
            if (isset($_POST['guardar'])){
                //print_r($_POST);
                @$cc = new Empleado($id, $_POST['idEmpleado'], $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['numCta'], $_POST['movil'], $_POST['localidad'], $_POST['codPostal'], $_POST['provincia'], $activo);
                $tObjeto->updateEmpleado($cc);
            }
            $objetos=$tObjeto->getEmpleadosTodos2();
            //print_r($clientes)
            //Hasta ahora hemos conseguido en la variable $clientes, una tabla bidimensional con todos los datos de la tabla clientes
            
            echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<th></td>"
                    . "<th>IdEmpleado</td>"
                    . "<th>Nombre</td>"
                    . "<th>Apellido1</td>"
                    . "<th>Apellido2</td>"
                    . "<th>Num Cta</td>"
                    . "<th>Móvil</td>"
                    . "<th>Localidad</td>"
                    . "<th>Cod.Postal</td>"
                    . "<th>Provincia</td>"
                    . "<th>Activo</td>"
                . "</tr>";
            foreach ($objetos as $c) {
                ?>
        <tr>
            <td>
                <form name="formulario" method="post" action="editarEmpleado.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input type='hidden' name='idEmpleado' value='<?php echo $c->getIdEmpleado(); ?>'>
                    <input type='hidden' name='nombre' value='<?php echo $c->getNombre(); ?>'>
                    <input type='hidden' name='apellido1' value='<?php echo $c->getApellido1(); ?>'>
                    <input type='hidden' name='apellido2' value='<?php echo $c->getApellido2(); ?>'>
                    <input type='hidden' name='numCta' value='<?php echo $c->getNumCta(); ?>'>
                    <input type='hidden' name='movil' value='<?php echo $c->getMovil(); ?>'>
                    <input type='hidden' name='localidad' value='<?php echo $c->getLocalidad(); ?>'>
                    <input type='hidden' name='codPostal' value='<?php echo $c->getCodPostal(); ?>'>                    
                    <input type='hidden' name='provincia' value='<?php echo $c->getProvincia(0); ?>'>
                    <input type='hidden' name='activo' value='<?php echo $c->getActivo(); ?>'>
                    <input class="btn waves-effect blue darken-1" type="submit" name="editar" value="Editar">
                </form><br>
                <?php if($c->getActivo()==1){ ?>
                <form name="formulario" method="post" action="listadoEmpleados_materialize.php">
                    <input type='hidden' name='idEmpleado' value='<?php echo $c->getIdEmpleado(); ?>'>
                    <input class="btn waves-effect red darken-1t" type="submit" name="baja" value="Dar de baja">
                </form>
                <?php }else{ ?>
                <form name="formulario" method="post" action="listadoEmpleados_materialize.php">
                    <input type='hidden' name='idEmpleado' value='<?php echo $c->getIdEmpleado(); ?>'>
                    <input class="btn waves-effect green darken-1t" type="submit" name="alta" value="Dar de alta">
                </form>
                <?php } ?>
            </td>
            <td><?php echo $c->getIdEmpleado(); ?></td>
            <td><?php echo $c->getNombre(); ?></td>
            <td><?php echo $c->getApellido1(); ?></td>
            <td><?php echo $c->getApellido2(); ?></td>
            <td><?php echo $c->getNumCta(); ?></td>
            <td><?php echo $c->getMovil(); ?></td>
            <td><?php echo $c->getLocalidad(); ?></td>
            <td><?php echo $c->getCodPostal(); ?></td>
            <td><?php echo $c->getProvincia(); ?></td>
            <td><?php echo $c->getActivo(); ?></td>
        </tr>            
        
                    <?php
            
            }
            echo "</table>";
            /*foreach ($objetos as $cl){
                echo "<tr>";
                foreach ($cl as $indice=>$dato) {
                    if (is_numeric($indice)){
                    echo "<td>$dato</td>";}
                }
                echo "</tr>";
            }*/
        ?>
        
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>

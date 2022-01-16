<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
        <h1>Clientes</h1>
        <form name="formulario" method="post" action="altaCliente.php">
            <input class="btn waves-effect waves-light" type="submit" name="crear" value="Crear Cliente">
        </form>
    <center><form name="formulario" method="post" action="../PDF/listadoClientesTodosPDF.php">
            <input class="btn waves-effect waves-light" type="submit" name="pdf" value="Imprimir">
        </form><br>
        <?php
            require_once "../../objetos/Cliente.php";
            require_once "../../persistencia/Clientes.php";
            
            
            $tObjeto = Clientes::singletonClientes();
            $objetos=$tObjeto->getClientesActivos();
            if (isset($_POST["baja"])){
                $tObjeto->delUnCliente($_POST["idCliente"]);
            }
            if (isset($_POST["alta"])){
                $tObjeto->altaCliente($_POST["idCliente"]);
            }
            if (isset($_POST['guardar'])){
                //print_r($_POST);
                @$cc = new Cliente($id, $_POST['idCliente'], $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['nif'], $_POST['varon'], $_POST['numCta'], $_POST['cnc'], $activo);
                $tObjeto->updateCliente($cc);
            }
            //print_r($clientes)
            //Hasta ahora hemos conseguido en la variable $clientes, una tabla bidimensional con todos los datos de la tabla clientes
            
            echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<td></td>"
                    
                    . "<th>IdCliente</td>"
                    . "<th>Nombre</td>"
                    . "<th>Apellido1</td>"
                    . "<th>Apellido2</td>"
                    . "<th>NIF</td>"
                    . "<th>Varón</td>"
                    . "<th>NúmCta</td>"
                    . "<th>Como Nos Conocio</td>"
                    . "<th>Activo</td>"
                . "</tr>";
            $clientes = $tObjeto->getClientesTodos();
            //print_r($clientes);
            foreach ($clientes as $c) {
                ?>
        <tr>
            <td>
                <form name="formulario" method="post" action="editarClientes.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input type='hidden' name='idCliente' value='<?php echo $c->getIdCliente(); ?>'>
                    <input type='hidden' name='nombre' value='<?php echo $c->getNombre(); ?>'>
                    <input type='hidden' name='apellido1' value='<?php echo $c->getApellido1(); ?>'>
                    <input type='hidden' name='apellido2' value='<?php echo $c->getApellido2(); ?>'>
                    <input type='hidden' name='nif' value='<?php echo $c->getNif(); ?>'>
                    <input type='hidden' name='varon' value='<?php echo $c->getVaron(); ?>'>
                    <input type='hidden' name='numCta' value='<?php echo $c->getNumCta(); ?>'>
                    <input type='hidden' name='cnc' value='<?php echo $c->getComoNosConocimos(); ?>'>
                    <input type='hidden' name='activo' value='<?php echo $c->getActivo(); ?>'>
                    <input class="btn waves-effect blue darken-1" type="submit" name="editar" value="Editar">
                </form><br>
                <?php if($c->getActivo()==1){ ?>
                <form name="formulario" method="post" action="listadoClientesTodos_materialize.php">
                    <input type='hidden' name='idCliente' value='<?php echo $c->getIdCliente(); ?>'>
                    <input class="btn waves-effect red darken-1t" type="submit" name="baja" value="Dar de baja">
                </form>
                <?php }else{ ?>
                <form name="formulario" method="post" action="listadoClientesTodos_materialize.php">
                    <input type='hidden' name='idCliente' value='<?php echo $c->getIdCliente(); ?>'>
                    <input class="btn waves-effect green darken-1t" type="submit" name="alta" value="Dar de alta">
                </form>
                <?php } ?>
            </td>
            <td><?php echo $c->getIdCliente(); ?></td>
            <td><?php echo $c->getNombre(); ?></td>
            <td><?php echo $c->getApellido1(); ?></td>
            <td><?php echo $c->getApellido2(); ?></td>
            <td><?php echo $c->getNif(); ?></td>
            <td><?php echo $c->getVaron(); ?></td>
            <td><?php echo $c->getNumCta(); ?></td>
            <td><?php echo $c->getComoNosConocimos(); ?></td>
            <td><?php echo $c->getActivo(); ?></td>
        </tr>            
        
                    <?php
    
}
            echo "</table>";
            /*foreach ($objetos as $cl){
                
                echo "<tr>";
                $idRecorrido = false;
                
        
            
        
                    
                foreach ($cl as $indice=>$dato) {
                    if (is_numeric($indice)){
                        if($idRecorrido){
                            echo "<td>$dato</td>";
                            
                        }else{$idRecorrido =true;
                        echo '<td><form name="formulario" method="post" action="bajaYEditarClientes.php">';
                            echo '<input class="btn waves-effect waves-light" type="submit" name="editar" value="Editar"><br>';
                            echo '<input class="btn waves-effect waves-light" type="submit" name="baja" value="Dar de baja"><form></td>';
                        }
                        echo "<input type='hidden' name='$indice' value='$dato'>";
                    }
                }

                echo "</tr>";
            }*/
        ?>
        
        
        
   
    <?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>
<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
        <h1>Direcciones de clientes</h1>
        <form name="formulario" method="post" action="altaDireccionCliente.php">
            <input class="btn waves-effect waves-light" type="submit" name="crear" value="Crear Direción">
        </form>
    <center><form name="formulario" method="post" action="../PDF/imprimirFamiliasPDF.php">
            <input class="btn waves-effect waves-light" type="submit" name="pdf" value="Imprimir">
        </form><br>
        <?php
        require_once "../../objetos/DireccionCliente.php";
        require_once "../../persistencia/DireccionesClientes.php";
            
            
            $tObjeto = DireccionesClientes::singletonDireccionesClientes();
            
            if (isset($_POST["baja"])){
                $tObjeto->bajaDireccionCliente($_POST["id"]);
            }
            if (isset($_POST["alta"])){
                $tObjeto->altaDireccionCliente($_POST["id"]);
            }
            if (isset($_POST['guardar'])){
                //print_r($_POST);
                @$cc = new DireccionCliente($_POST['id'], $_POST['idCliente'], $_POST['calle'], $_POST['codPostal'], $_POST['localidad'], $_POST['provincia'], $_POST['pais'], $activo);
                //print_r($cc);
                $tObjeto->updateDireccionCliente($cc);
            }
       echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<td></td>"
                    
                    . "<th>IdCliente</td>"
                    . "<th>Calle</td>"
                    . "<th>Código Postal</td>"
                    . "<th>Localidad</td>"
                    . "<th>Provinncia</td>"
                    . "<th>Pais</td>"
                    . "<th>Activo</td>"
                . "</tr>";
            $clientes = $tObjeto->getDireccionesClientesTodos2();
            //print_r($clientes);
            foreach ($clientes as $c) {
                ?>
        <tr>
            <td>
                <form name="formulario" method="post" action="editarDireccionCliente.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input type='hidden' name='idCliente' value='<?php echo $c->getIdCliente(); ?>'>
                    <input type='hidden' name='calle' value='<?php echo $c->getCalle(); ?>'>
                    <input type='hidden' name='codPostal' value='<?php echo $c->getCodPostal(); ?>'>
                    <input type='hidden' name='localidad' value='<?php echo $c->getLocalidad(); ?>'>
                    <input type='hidden' name='provincia' value='<?php echo $c->getProvincia(); ?>'>
                    <input type='hidden' name='pais' value='<?php echo $c->getPais(); ?>'>
                    <input type='hidden' name='activo' value='<?php echo $c->getActivo(); ?>'>
                    <input class="btn waves-effect blue darken-1" type="submit" name="editar" value="Editar">
                </form><br>
                <?php if($c->getActivo()==1){ ?>
                <form name="formulario" method="post" action="listadoDireccionesClientes.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input class="btn waves-effect red darken-1t" type="submit" name="baja" value="Dar de baja">
                </form>
                <?php }else{ ?>
                <form name="formulario" method="post" action="listadoDireccionesClientes.php">
                    <input type='hidden' name='id' value='<?php echo $c->getId(); ?>'>
                    <input class="btn waves-effect green darken-1t" type="submit" name="alta" value="Dar de alta">
                </form>
                <?php } ?>
            </td>
            <td><?php echo $c->getIdCliente(); ?></td>
            <td><?php echo $c->getCalle(); ?></td>
            <td><?php echo $c->getCodPostal(); ?></td>
            <td><?php echo $c->getLocalidad(); ?></td>
            <td><?php echo $c->getProvincia(); ?></td>
            <td><?php echo $c->getPais(); ?></td>
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
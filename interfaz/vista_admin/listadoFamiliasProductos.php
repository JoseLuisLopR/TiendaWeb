<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
        <h1>Direcciones de clientes</h1>
        <form name="formulario" method="post" action="altaFamiliaProducto.php">
            <input class="btn waves-effect waves-light" type="submit" name="crear" value="Crear Familia">
        </form>
    <center><form name="formulario" method="post" action="../PDF/imprimirFamiliasPDF.php">
            <input class="btn waves-effect waves-light" type="submit" name="imprimir" value="Imprimir">
        </form><br>
        <?php
        require_once "../../objetos/FamiliaProducto.php";
        require_once "../../persistencia/FamiliasProductos.php";
        $tObjeto = FamiliasProductos::singletonFamiliasProductos();
            
            if (isset($_POST["baja"])){
                $tObjeto->bajaFamiliaProducto($_POST["idFamilia"]);
            }
            if (isset($_POST["alta"])){
                $tObjeto->altaFamiliaProducto($_POST["idFamilia"]);
            }
            if (isset($_POST['guardar'])){
                //print_r($_POST);
                @$cc = new FamiliaProducto($id, $_POST["idFamilia"],$_POST["nombre"], $_POST["descripcion"], $activo);
                //print_r($cc);
                $tObjeto->updateFamiliaProducto($cc);
            }echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<td></td>"
                    
                    . "<th>IdFamilia</td>"
                    . "<th>Nombre</td>"
                    . "<th>Descripción</td>"
                    . "<th>Activo</td>"
                . "</tr>";
            $clientes = $tObjeto->getFamiliasProductosTodas2();
            //print_r($clientes);
            foreach ($clientes as $c) {
                ?>
        <tr>
            <td>
                <form name="formulario" method="post" action="editarFamiliaProducto.php">                   
                    <input type='hidden' name='idFamilia' value='<?php echo $c->getIdFamilia(); ?>'>
                    <input type='hidden' name='nombre' value='<?php echo $c->getNombre(); ?>'>
                    <input type='hidden' name='descripcion' value='<?php echo $c->getDescripcion(); ?>'>
                    <input type='hidden' name='activo' value='<?php echo $c->getActivo(); ?>'>
                    <input class="btn waves-effect blue darken-1" type="submit" name="editar" value="Editar">
                </form><br>
                <?php if($c->getActivo()==1){ ?>
                <form name="formulario" method="post" action="listadoFamiliasProductos.php">
                    <input type='hidden' name='idFamilia' value='<?php echo $c->getIdFamilia(); ?>'>
                    <input class="btn waves-effect red darken-1t" type="submit" name="baja" value="Dar de baja">
                </form>
                <?php }else{ ?>
                <form name="formulario" method="post" action="listadoFamiliasProductos.php">
                    <input type='hidden' name='idFamilia' value='<?php echo $c->getIdFamilia(); ?>'>
                    <input class="btn waves-effect green darken-1t" type="submit" name="alta" value="Dar de alta">
                </form>
                <?php } ?>
            </td>
            <td><?php echo $c->getIdFamilia(); ?></td>
            <td><?php echo $c->getNombre(); ?></td>
            <td><?php echo $c->getDescripcion(); ?></td>
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
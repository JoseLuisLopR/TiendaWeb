<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
        <h1>Listado de proveedores</h1>
        <?php
        require_once '../../persistencia/Proveedores.php';
        require_once '../../objetos/Proveedor.php';
        //Enlazo la tabla Productos en $tProducto
       // session_start();
        $tProveedor= Proveedores::singletonProveedores();

        //Hago la consulta con todos los productos y
        //devuelvo un array bidimensional en $productos
        $proveedores=$tProveedor->getProveedoresTodos();
        echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<td></td>"
                    
                    . "<th>IdProveedor</td>"
                    . "<th>Nombre</td>"
                    . "<th>Telefono</td>"
                    . "<th>Activo</td>"
                . "</tr>";
            
            //print_r($clientes);
            foreach ($proveedores as $c) {
                ?>
        <tr>
            <td>
                
                <form name="formulario" method="post" action="addStock.php">
                    <input type='hidden' name='idProveedor' value='<?php echo $c->getIdProveedor(); ?>'>
                    <input class="btn waves-effect blue darken-1" type="submit" name="addStock" value="Añadir stock">
                </form><br>               

            </td>
            <td><?php echo $c->getIdProveedor(); ?></td>
            <td><?php echo $c->getNombre(); ?></td>
            <td><?php echo $c->getTelefono(); ?></td>
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
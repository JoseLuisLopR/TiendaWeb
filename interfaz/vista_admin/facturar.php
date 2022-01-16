<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';

        echo '<h2>Facturación de pedidos</h2>';

        
            require_once '../../persistencia/Pedidos.php';
            require_once '../../objetos/Pedido.php';

            //session_start();
            //$idCliente=$_SESSION['idCliente'];
            //echo $idCliente;
            $tPedido=Pedidos::singletonPedidos();
            if (isset($_POST['facturar'])){
                $codigo = $tPedido->getCantidadPedidoFacturados()+1;
                $resta = 10-(strlen($codigo));
            for ($i=1;$i<=$resta;$i++){
                $codigo = "0".$codigo;
                
                }
             $tPedido->facturarPedido($_POST["idPedido"],$codigo);
            }
            $listaPedidos=$tPedido->getPedidosNoFacturados();
            //print_r($listaPedidos);
        
            echo "<center><table class=\"striped\">"
            ."<tr>"
                    ."<td></td>"
                    
                    . "<th>Pedido</td>"
                    . "<th>Fecha pepido</td>"
                    . "<th>Cliente</td>"

                . "</tr>";
            
            foreach ($listaPedidos as $p) {
                ?>
        <tr>
            <td>
                <form name="formulario" method="post" action="facturar.php">
                    <input type='hidden' name='idPedido' value='<?php echo $p->getIdPedido(); ?>'>
                    <input class="btn waves-effect blue darken-1" type="submit" name="facturar" value="Facturar">
                </form><br>
                <form name="formulario" method="post" action="../PDF/imprimirPedidoPDF.php">
                    <input type='hidden' name='numPedido' value='<?php echo $p->getIdPedido(); ?>'>
                    <input class="btn waves-effect red darken-1t" type="submit" name="pdf" value="Ver">
                </form>
            </td>
            <td><?php echo $p->getIdPedido(); ?></td>
            <td><?php echo $p->getFechaPedido(); ?></td>
            <td><?php echo $p->getIdCliente(); ?></td>
        </tr>            
        
                    <?php
    
}
            echo "</table>";
        ?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>

<?php 
session_start();
if ($_SESSION['rol']=='003'){
    include './header.php';
?>
    <div class="container">





        <?php
        echo "<center> <h5>Su pedido ha sido pagado con éxito</h5><br><br>";
        
        ?>
        <form method="post" action="listadoProductos_materialize.php">

                        <button class="btn waves-effect waves-light" type="submit" name="action">Seguir Comprando
                            <i class="material-icons left">replay</i>
                        </button>

                    </form>
            </div>

<?php 
include './footer.php';

}else{header("Location: ./");} ?>

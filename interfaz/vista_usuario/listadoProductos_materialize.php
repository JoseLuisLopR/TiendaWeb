<?php

require_once '../../persistencia/Productos.php';
require_once '../../objetos/Producto.php';
require_once '../../objetos/LineaPedido.php';
//Enlazo la tabla Productos en $tProducto
session_start();
include './header.php';
echo '<div class="container">';
$tProducto=Productos::singletonProductos();

//Hago la consulta con todos los productos y
//devuelvo un array bidimensional en $productos
$productos=$tProducto->getProductosTodos2();


echo "<div class='row'>";
    foreach ($productos as $p){
    /*en cada vuelta tengo en $fila la información
    * completa de un producto
     */
          pintarArticulo($p); 
    }
echo "</div>";


function pintarArticulo($p){
    //echo $p->getStockActual();
    if($p->getStockActual()>0){
        $bloquear = "";
        $stock = "(".$p->getStockActual()." unidades disponibles)";
    }else{
        $bloquear = "disabled";
        $stock = "<font color=\"red\">Sin Stock</font>";
    }

    $maxCant = $p->getStockActual()-cantidadEnCesta($p->getIdProducto());
    echo "
    <div class='col s12 m3'>
        <div class='card' >
            <div class='card-image waves-effect waves-block waves-light'>
                <img src='../". $p->getRutaFoto() . "' height='200'>
                <span class='card-title'>". $p->getDescripcion()."</span>
            </div>
            
            <div class='card-action'>
                <span style='color:blue;font-weight:bold; 
                    font-size:20px;'>PVP: ". $p->getPvp()."€</span><br>
                <form action='carrito_materialize.php' name='formulario' method='post'>
                    <center><div><font size=3>Cantidad: </font><input type='number' placeholder='1' name='unidades' min='1' 
                        max='". $maxCant. "' maxlength='3' value='1'
                        style='width: 3em; font-size=3em;
                        border:1px solid;' ".$bloquear."/><br><center>".$stock."</div><br> 
                    <input type='hidden' name='id_producto' 
                        value='".$p->getIdProducto()."' /> 
                    <input type='hidden' name='descripcion' 
                        value='" .  $p->getDescripcion(). "'/>
                    <input type='hidden' name='pvp' 
                        value='".$p->getPvp()."'/>
                    <input type='hidden' name='tipo_iva' 
                        value='". $p->getTipoIva()."'/>
                    <center><input class=\"btn ".$bloquear." waves-effect waves-light\" type='submit' name='comprar' value='comprar'  />
            
                </form>
              
            </div>
        </div>
    </div>";    

}
    function cantidadEnCesta($idProducto){
        $catidad=0;
        foreach ($_SESSION['cesta'] as $lp) {
            if($lp->getIdProducto()==$idProducto){
                $catidad = $lp ->getUnidades();
            }
        }
        return $catidad;
    }
echo '</div>';
include './footer.php';
?>

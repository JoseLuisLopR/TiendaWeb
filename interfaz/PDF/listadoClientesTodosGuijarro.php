<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado de Clientes</title>
    </head>
    <body>
        <h1>Listado de Clientes</h1>
        <?php
        require_once '../objetos/Cliente.php';
        require_once '../persistencia/Clientes.php';

        $tObjeto = Clientes::singletonClientes();
        $objetos = $tObjeto->getClientesActivos();

        // print_r($clientes);
        echo "<table border>"
        . "<tr>"
        . "<td>Id</td>"
        . "<td>IdCliente</td>"
        . "<td>Nombre</td>"
        . "<td>Apellido1</td>"
        . "<td>Apellido2</td>"
        . "<td>NIF</td>"
        . "<td>Varón</td>"
        . "<td>Núm Cta</td>"
        . "<td>Nos conoció</td>"
        . "<td>Activo</td>"
        . "</tr>";
        print_r($objetos);
        
        foreach ($objetos as $cl) {
            echo "<tr>";
            foreach ($cl as $indice=>$dato) {
                if (is_numeric($indice)) {
                echo "<td>" . $dato . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<br><br><br>";
        
        ?>
    <center>
        <form name="formulario" method="post" action="imprimirPDF/listadoClientesTodosPDF.php">
            <input type="submit" name="pdf" value="Imprimir">
        </form>
    </center>
    </body>
</html>

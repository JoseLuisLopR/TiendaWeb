<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <center><table>
            <tr>
            <td>
                <form name="formulario" method="post" action="imprimirEmpleadosPDF.php">  
            <label><h3>Empleados</h3></label>
                <label>
                 <input type="radio" name="rbuttons" value="Todos" checked>Todos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo Activos">Solo Activos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo no Activos">Solo no Activos
                </label><br><br>
                <label>
                 <input type="submit" name="imprimir" value="Imprimir PDF">
                </label>
        </form>
            </td>
            <td>
                <form name="formulario" method="post" action="imprimirClientesPDF.php">  
            <label><h3>Clientes</h3></label>
                <label>
                 <input type="radio" name="rbuttons" value="Todos" checked>Todos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo Activos">Solo Activos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo no Activos">Solo no Activos
                </label><br><br>
                <label>
                 <input type="submit" name="imprimir" value="Imprimir PDF">
                </label>
        </form>
            </td>
            <td>
                <form name="formulario" method="post" action="imprimirProductosPDF.php">  
            <label><h3>Productos</h3></label>
                <label>
                 <input type="radio" name="rbuttons" value="Todos" checked>Todos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo Activos">Solo Activos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo no Activos">Solo no Activos
                </label><br><br>
                <label>
                 <input type="submit" name="imprimir" value="Imprimir PDF">
                </label>
        </form>
            </td>
            <td>
                <form name="formulario" method="post" action="imprimirFamiliasPDF.php">  
            <label><h3>Familias</h3></label>
                <label>
                 <input type="radio" name="rbuttons" value="Todos" checked>Todos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo Activos">Solo Activos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo no Activos">Solo no Activos
                </label><br><br>
                <label>
                 <input type="submit" name="imprimir" value="Imprimir PDF">
                </label>
        </form>
            </td>
            <td>
                <form name="formulario" method="post" action="imprimirPedidiosPDF.php">  
            <label><h3>Pedidos</h3></label>
                <label>
                 <input type="radio" name="rbuttons" value="Todos" checked>Todos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo Activos">Solo Activos
                </label><br>
                <label>
                 <input type="radio" name="rbuttons" value="Solo no Activos">Solo no Activos
                </label><br><br>
                <label>
                 <input type="submit" name="imprimir" value="Imprimir PDF">
                </label>
        </form>
            </td>
            </tr>
            </table>
        <?php
        // put your code here
        ?>
    </body>
</html>

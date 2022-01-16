<?php 
session_start();
if ($_SESSION['rol']=='001' || $_SESSION['rol']=='002'){
    include './header.php';
    echo '<div class="container">';
?>
<?php
    //iniciamos la sesión.
    require_once '../../objetos/Producto.php';  
    require_once '../../persistencia/Productos.php';
    require_once '../../persistencia/FamiliasProductos.php';
    require_once '../../persistencia/Proveedores.php';
   //print_r($_POST);
   //var_dump($_POST);
   #if (isset($_POST['submit']) 
   $submit=filter_input(INPUT_POST,'submit'); 
    //$submit=$_POST['submit']
   if (isset($submit))
   {
       
       $tProducto=Productos::singletonProductos();
    
       //aislamos las variables que vienen del formulario
       $familia=filter_input(INPUT_POST,'familia');
       //echo "La familia es: $familia";
       $nombre=filter_input(INPUT_POST,'nombre');
       $pvp=filter_input(INPUT_POST,'pvp');
       $pCoste=filter_input(INPUT_POST,'pCoste');
       $iva=filter_input(INPUT_POST,'iva');
       
       ///echo "<br><br><hr>";
       //print_r($_FILES); //sólo para ver qué contiene el $_FILES
       
       $nombreOriginal=$_FILES['foto']['name'];
      // echo "<br>El nombre de la images es: $nombreOriginal<br>";
       $posPunto=strpos($nombreOriginal,".")+1;
       $extensionOriginal=substr($nombreOriginal, $posPunto, 3);
       
      // echo "La extensión es: $extensionOriginal";
       
       $tipo=$_FILES['foto']['type'];
       $tamanio=$_FILES['foto']['size'];
       $id=$tProducto->getNumeroProductoMismoIdFamilia($_POST['familia'])+1; //Averiguamos cuál es el id del último producto
       //print_r($id);
       $codigoString=(string)$id;
       
       $tFamilia = FamiliasProductos::singletonFamiliasProductos();
        $tProveedor = Proveedores::singletonProveedores();
       
       $numCaracteres= strlen($codigoString);
       $resta=5-$numCaracteres;
       for ($i=1;$i<=$resta;$i++){
           $codigoString='0'.$codigoString;
       }
       
       $codigoFormateado=$familia.$codigoString;
       //echo "<br>El codigo formateado es $codigoFormateado";
       /* Ahora vamos a darle formato a la ruta de la 
        * foto de cada producto
       Una alternativa simple, puede ser 
       
       $nombreNuevo="../fotos/productos/".$_FILES['foto']['name'];

        * Y otra un poco más elaborada:
        *         */
       $campoasVacios = false;
       $idProveedor=$_POST['idProveedor'];
       foreach ($_POST as $a) {
                    if (empty($a)) {
                        $campoasVacios = true;
                    }
                    if(@empty($_FILES[foto][name])){$campoasVacios = true;}
                }
                if (!$campoasVacios) {
        if($tFamilia->existeFamilia($familia)){
            if($tProveedor->existeProveedor($idProveedor)){
       $nombreNuevo="fotos/productos/pro_" . $codigoFormateado. "." . $extensionOriginal;
       
       echo "El nuevo nombre es: $nombreNuevo";
       
       $error=move_uploaded_file($_FILES['foto']['tmp_name'],"../".$nombreNuevo);
       
       if ($error==0)
       {
           echo "Se ha producido un error en la subida"."<br>";
       }
       else {
        
        $idProducto=$codigoFormateado;
        $tipoIva=$iva;
        $precioCoste=$pCoste;
        $pvp=$pvp;
        $descripcion=$nombre;
        $rutaFoto=$nombreNuevo;
        
        /* Me invento estos datos para agilizar.
         * 
        * Como tarea para el alumno, ampliar el formulario de captura
        * de datos para que admita todos estos campos.
         * Ese formulario debe ser ya hecho con materialize para que
         * se adapte al interfaz de la vista_admin
         * Otra tarea es minimizar el número de variables
         * de este script (altaProductos.php)
         */
        
        $codigoBarras="123139128";
        
        $stockActual=0;
        $stockMinimo=$_POST['stockMin'];
        $stockMaximo=$_POST['stockMax'];
        $familia=$_POST['familia'];
        
        
        
        
        $activo=1;  
        //echo $familia;
        $p=new Producto(0,$idProducto,$familia,$tipoIva,$precioCoste,$pvp,$descripcion,
                $codigoBarras,$idProveedor,$stockActual,$stockMinimo,$stockMaximo,
                $rutaFoto,$activo);
        //print_r($p);
                
                $insertado=$tProducto->addUnProducto($p);
                if ($insertado)
                {
                    echo "<h5 class='green darken-1'>Producto insertado corectamente</h5>";
                }
                else
                {
                    echo "Error en la inserción del producto";
       }}
                }else{
           echo "<h5 class='red darken-1'>Proveedor no valido</h5>";
       }
       
       }else{
           echo "<h5 class='red darken-1'>Familia no valida</h5>";
       }
       }else{
           echo "<h5 class='red darken-1'>Faltan campos por rellenar</h5>";
       }
       }
   


?>
        <div>
            <center><h1>Datos de un producto
             </h1></center>
            
            <form name="formulario1" action="altaProducto.php"
                  method="POST" enctype="multipart/form-data">
              
            <div class="input-field col s3"><input type="text" name="familia" value="<?php if (isset($_POST['familia'])) {echo $_POST['familia'];} ?>"><label>Familia</label></div> 
            <div class="input-field col s6"><input type="text" name="idProveedor" value="<?php if (isset($_POST['idProveedor'])) {echo $_POST['idProveedor'];} ?>"><label>Proveedor</label></div> 
            <div class="input-field col s6"><input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) {echo $_POST['nombre'];} ?>"><label>Descripción</label></div> 
            <div class="input-field col s6"><input type="number" step="any" name="pvp" value="<?php if (isset($_POST['pvp'])) {echo $_POST['pvp'];} ?>"><label>Precio de venta al publico</label></div> 
            <div class="input-field col s6"><input type="number" step="any" name="pCoste" value="<?php if (isset($_POST['pCoste'])) {echo $_POST['pCoste'];} ?>"><label>Precio de coste</label></div> 
            <div class="input-field col s6"><input type="number" step="any" name="iva" value="<?php if (isset($_POST['iva'])) {echo $_POST['iva'];} ?>"><label>IVA</label></div> 
            <div class="input-field col s6"><input type="number" name="stockMin" value="<?php if (isset($_POST['stockMin'])) {echo $_POST['stockMin'];} ?>"><label>Stock Mínimo</label></div> 
            <div class="input-field col s6"><input type="number" name="stockMax" value="<?php if (isset($_POST['stockMax'])) {echo $_POST['stockMax'];} ?>"><label>Stock Máximo</label></div> 

<div class="file-field input-field">
      <div class="btn">
        <span>Foto</span>
        <input type="file" name="foto">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Foto">
      </div>
    </div>
                
                
                    <input class="btn waves-effect waves-light" type="submit" value="Crear" name="submit">
            </form>
                
            
        
        </div>



<?php
              /*Familia:<select name="familia" >
                    <option value="0" >cERO</option>
                    <option value="1" >Uno</option>
                    <option value="2" >dOS</option>
                </select>
              
                $tFamilia = FamiliasProductos::singletonFamiliasProductos();    
                $ffamilia = $tFamilia->getFamiliasProductosTodos();
                //print_r($ffamilia);
                //var_dump($familia);echo "<br><hr>";echo "<br><hr>";echo "<br><hr>";
               /* echo 'Familia:<select name="fam" >';
                echo "<br><hr>";
                foreach ($ffamilia as $indice->$f) {
                    echo $indice;
                    echo "Hola<br>";
                    //var_dump($f);
                }
                foreach ($familia as $fea){
                    print_r($familia);
                    var_dump($fea);echo "<br>fffffff<br>";
                    echo "<option value=".$f->getIdFamilia. ">".$f->getNombre."</option>";
                }
                
                echo "</select>";*/
                 ?>
<?php 
                 echo '</div>';
                 include './footer.php';
                }else{header("Location: ../vista_usuario/");} ?>
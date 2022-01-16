<?php
if (isset( $_POST['imprimir'])){
        require_once '../../objetos/Empleado.php';
        require_once '../../persistencia/Empleados.php';
        require_once '../../lib/tcpdf/tcpdf.php';
        
        // creamos el nuevo documento pdf
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 
                PDF_PAGE_FORMAT, true, 'UTF-8', true);
        
        $tObjeto = Empleados::singletonEmpleados();
        if ($_POST["rbuttons"]=="Todos"){
            $objetos = $tObjeto->getEmpleadosTodos();
            $pdf->SetTitle('Listado de Todos los Empleados de la tienda online');
        }else if ($_POST["rbuttons"]=="Solo Activos"){
            $objetos = $tObjeto->getEmpleadosActivos();
            $pdf->SetTitle('Listado de Empleados Activos de la tienda online');
        }else if ($_POST["rbuttons"]=="Solo no Activos"){
            $objetos = $tObjeto->getEmpleadosNoActivos();
            $pdf->SetTitle('Listado de Empleados No Activos de la tienda online');
        }else{
            $objetos = $tObjeto->getEmpleadosTodos();
        }

        //print_r($objetos);
               
        $textoHtml= "<table border>"
        . "<tr>"
        . "<td>Id</td>"
        . "<td>IdEmpleado</td>"
        . "<td>Nombre</td>"
        . "<td>Apellido1</td>"
        . "<td>Apellido2</td>"
        . "<td>Núm Cta</td>"
        . "<td>Movil</td>"
        . "<td>Localidad</td>"
        . "<td>Cod Poltal</td>"
        . "<td>Provincia</td>"
        . "<td>Activo</td>"
        . "</tr>";
        
        
        foreach ($objetos as $cl) {
            $textoHtml=$textoHtml . "<tr>";
            foreach ($cl as $indice=>$dato) {
                if (is_numeric($indice)) {
                $textoHtml=$textoHtml . "<td>" . $dato . "</td>";
                }
            }
            $textoHtml=$textoHtml . "</tr>";
        }
        $textoHtml=$textoHtml . "</table>";
        
        

        // información del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Empresa, SL');
        
        //En el archivo tcpdf_autoconfig.php se puede cambiar la ruta
        //del logo de la empresa.
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH-12, 
        "Empresa, S.L.", "Avda. Ramón y Cajal, s/n.\n "
        . "06001 Badajoz \n CIF: B-0611111 \n Tlf: 924010101");



        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('Times', 'B', 10);

        // add a page
        $pdf->AddPage();

        if ($_POST["rbuttons"]=="Todos"){
            $pdf->Write(15, 'Listado de Todos los Empleados', '', 0, 'C', true, 0, false, false, 0);            
        }else if ($_POST["rbuttons"]=="Solo Activos"){
            $pdf->Write(15, 'Listado de Empleados Activos', '', 0, 'C', true, 0, false, false, 0);
        }else if ($_POST["rbuttons"]=="Solo no Activos"){
            $pdf->Write(15, 'Listado de Empleados No Activos', '', 0, 'C', true, 0, false, false, 0);
        }

        $pdf->SetFont('helvetica', '', 8);
        $pdf->Write(16, '', '', 0, 'L', true, 0, false, false, 0);
        // -----------------------------------------------------------------------------
        $pdf->writeHTML($textoHtml, true, false, false, false, '');
        $pdf->SetFont('Times', 'B', 10);
        
        $pdf->lastPage();
        //header('Content-type: application/pdf');
        //header('Content-Disposition: attachment; filename="file.pdf"');
        ob_end_clean();
        $pdf->Output('ejemplo.pdf','I');
        //$pdf->Output('example_048.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
}
       
      

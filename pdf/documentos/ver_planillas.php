<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
		
    }
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");
	$id_planilla= intval($_GET['id_planilla']);
	$sql_count=mysqli_query($con,"select * from planilla where id_planilla='".$id_planilla."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('planilla no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con,"select * from planilla where id_planilla='".$id_planilla."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	$num_planilla=$rw_factura['num_planilla'];
	$user_id=$rw_factura['user_id'];
	$club=$rw_factura['club'];
	$fecha=$rw_factura['fecha'];
	$categoria=$rw_factura['categoria'];
	$torneo=$rw_factura['torneo'];
	
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/ver_factura_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

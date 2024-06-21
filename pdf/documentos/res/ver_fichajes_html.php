<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "obedalvarado.pw "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <?php include("encabezado.php");?>
    
    <br>
    

	
    
    
       
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	<tr  class="info">
					
					<th class='midnight-blue'>Recibo</th>
					<th class='midnight-blue'>Documento</th>
					<th class='midnight-blue'>Jugador</th>
					<th class='midnight-blue'>Club</th>
					<th class='midnight-blue'>Cuota</th>
					<th class='midnight-blue'>Monto</th>
					<th class='midnight-blue'>Periodo</th>
					<th class='midnight-blue'>Fecha</th>
					<th class='midnight-blue'>Año</th>
					<th class='midnight-blue'>Estado</th>
					
					
				</tr>

<?php
date_default_timezone_set('America/Argentina/La_Rioja');
setlocale(LC_TIME, 'es');
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from fichajes order by ID desc");
while ($row=mysqli_fetch_array($sql))
	{
		$id=$row['ID'];
						$recibo=$row['RECIBO'];
						$dni=$row['DNI'];
						$jugador=$row['CONTRIBUYENTE'];
						$club=$row['CLUB'];
						$cuota=$row['CUOTA'];
						$monto=$row['MONTO'];
						$periodo=$row['PERIODO'];
						$fecha=date('d/m/Y', strtotime($row['FECHA']));
						$ano=$row['AÑO'];
						$estado=$row['ESTADO'];
						if ($estado=='Habilitado'){$text_estado="Habilitado";$label_class='label-success';}
						else{$text_estado="Desahabilitado";$label_class='label-warning';}
	?>

        <tr>
		           <td class='text-tight'><?php echo $recibo; ?></td>
						<td class='text-tight'><?php echo $dni; ?></td>
						<td class='text-tight' style="width:20%"><?php echo $jugador;?></td>
						<td class='' style="width:15%"><?php echo $club;?></td>
						<td class='text-tight'><?php echo $cuota;?></td>
						<td class='text-tight'style="width:5%">$<?php echo number_format($monto);?></td>
						<td class='text-tight'style="width:10%"><?php echo $periodo;?></td>
						<td class='text-tight'style="width:12%"><?php echo $fecha;?></td>
						<td class='text-right'style="width:5%"><?php echo $ano;?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	//$insert_detail=mysqli_query($con, "INSERT INTO detalle_planilla VALUES ('','$dni','$edad','$camiseta','$num_planilla')");
	
	$nums++;
	}
	
?>
	  
        
    </table>
	
	
	
	<br>
	<p></p>
	<div style="font-size:11pt;text-align:center;font-weight:bold">LA FICHA DE JUEGO FUE CREADA CON EXITO!</div>
	
	
	  

</page>

<?php
?>
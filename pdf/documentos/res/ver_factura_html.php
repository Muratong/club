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
    <?php include("encabezado_factura.php");?>
    
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>INFORMACION DEL CLUB</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_club=mysqli_query($con,"select * from clubes where CLUB LIKE '%".$rw_factura['club']."%'");
				$rw_club=mysqli_fetch_array($sql_club);
				echo "Club: ";
				echo $rw_club['CLUB'];
				echo "<br> Direccion: ";
				echo $rw_club['DIRECCION'];
				echo "<br> Teléfono: ";
				echo $rw_club['TELEFONO'];
				echo "<br> Email: ";
				echo $rw_club['CORREO'];
			?>
			
		   </td> 
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
		   <td style="width:35%;" class='midnight-blue'>ENTRENADOR</td>
           <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:40%;" class='midnight-blue'>TORNEO</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from users where user_id='$user_id'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['firstname']." ".$rw_user['lastname'];
				$torneo=$rw_factura['torneo']; 
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y", strtotime($fecha));?></td>
		  <td style="width:40%;" >
				<?php 
				if ($torneo==1){echo "Apertura";}
				elseif ($torneo==2){echo "Clausura";}
				elseif ($torneo==3){echo "Anual";}
				
				?>
		   </td>
		   
        </tr>
		
        
   
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	<tr>
          <td style="width:20%;" class='midnight-blue'>DNI</td>
		  <td style="width:15%;" class='midnight-blue'>JUGADOR</td>
		  <td style="width:5%;" class='midnight-blue'>EDAD</td>
		  <td style="width:15%;" class='midnight-blue'>CAMISETA</td>
		  <td style="width:15%;" class='midnight-blue'>CATEGORIA</td>
		   
    </tr>

<?php
date_default_timezone_set('America/Argentina/La_Rioja');
setlocale(LC_TIME, 'es');
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from jugadores, planilla, detalle_planilla where planilla.num_planilla=detalle_planilla.num_planilla and  planilla.id_planilla='".$id_planilla."' and jugadores.DNI=detalle_planilla.dni");
while ($row=mysqli_fetch_array($sql))
	{
		$id_detalle=$row["id_detalle"];
	$dni=$row["dni"];
	$jugador=$row['APELLIDO_Y_NOMBRE'];
	$fecha=$row['FECHA'];
	$edad=$row['edad'];
	$club=$row['club'];
	$camiseta=$row['camiseta'];
	$club=$row['categoria'];
	
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
		            <td class='<?php echo $clase;?>' style="width: 15%; text-align: left"><?php echo $dni; ?></td>
					<td class='<?php echo $clase;?>' style="width: 40%; text-align: left"><?php echo $jugador;?></td>
					<td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $edad;?></td>
					<td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $camiseta;?></td>
					<td class='<?php echo $clase;?>' style="width: 15%; text-align: center">
					<?php 
					if ($categoria==1){echo "1-Caballeros";}
					elseif ($categoria==2){echo "1-Damas";}
					elseif ($categoria==3){echo "1-Damas B";}
					elseif ($categoria==4){echo "Sub 19";}
					elseif ($categoria==5){echo "Sub 16";}
					elseif ($categoria==6){echo "Sub 16 Mixto";}
					elseif ($categoria==7){echo "Sub 14";}
					elseif ($categoria==8){echo "Sub 14 Mixto";}
					elseif ($categoria==9){echo "Sub 12";}
					elseif ($categoria==10){echo "Sub 12 Mixto";}
					elseif ($categoria==11){echo "Sub 10";}
					elseif ($categoria==12){echo "Sub 10 Mixto";}
					elseif ($categoria==13){echo "Infantiles";}
					
					?>
					
					</td>
            
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
	<div style="font-size:11pt;text-align:center;font-weight:bold">LA PLANILLA DE JUEGO FUE CREADA CON EXITO!</div>
	
	
	  

</page>

<?php
?>
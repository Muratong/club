<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
 // $id_planilla= $_SESSION['id_planilla'];
$num_planilla= $_SESSION['num_planilla'];
// if (isset($_POST['id'])){$id=intval($_POST['id']);}
if (isset($_POST['id'])){$dni=intval($_POST['id']);}
if (isset($_POST['edad'])){$edad=intval($_POST['edad']);}
if (isset($_POST['camiseta'])){$camiseta=floatval($_POST['camiseta']);} 

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
if (!empty($dni) and !empty($edad) and !empty($camiseta))
{
	$consulta=mysqli_query($con, "SELECT * FROM detalle_planilla where dni='$dni' and num_planilla='$num_planilla'");
	$resulta=mysqli_fetch_array($consulta);
	if ($resulta >0) {
		?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> El/la jugador/a ya ha sido selecionado, elige a otro/a.
			</div>
			<?php 
		}else{
$sql = "SELECT * FROM detalle_planilla WHERE num_planilla='$num_planilla'";
$query_check_cantidad = mysqli_query($con,$sql);
				$query_check_cantidades=mysqli_num_rows($query_check_cantidad);
		 if ($query_check_cantidades == 20) {
  ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Ya no puedes cargar mas de 20 jugadores en la planilla, en caso de cambio solo puedes eliminar y reemplazar.
			</div>
			<?php 
	}else{$insert_tmp=mysqli_query($con, "INSERT INTO detalle_planilla (num_planilla,dni,edad,camiseta) VALUES ('$num_planilla','$dni','$edad','$camiseta')");}
}
}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_detalle=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM detalle_planilla WHERE id_detalle='".$id_detalle."'");
}
?>
<div class="table-responsive">
<table class="table">
<tr>
	<th class='text-center'>DNI</th>
	<th class='text-center'>JUGADOR</th>
	<th class='text-right'>EDAD</th>
	<?php 
if ($_SESSION['user_name'] =='admin'  && $_SESSION['user_name']=='mesa') {
	?>
	<th class="text-right">CLUB</th>
	<?php
}
	?>
	<th class='text-right'>CAMISETA</th>
	<th></th>
</tr>
<?php
	
	$sql=mysqli_query($con, "select * from jugadores, planilla, detalle_planilla where planilla.num_planilla=detalle_planilla.num_planilla and  planilla.num_planilla='$num_planilla' and jugadores.DNI=detalle_planilla.dni");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_detalle=$row["id_detalle"];
	$dni=$row["dni"];
	$jugador=$row['APELLIDO_Y_NOMBRE'];
	$fecha=$row['FECHA'];
	$edad=$row['edad'];
	$club=$row['club'];
	$camiseta=$row['camiseta'];
	// $precio_venta_f=number_format($precio_venta,2);//Formateo variables
	// $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	// $precio_total=$precio_venta_r*$cantidad;
	// $precio_total_f=number_format($precio_total,2);//Precio total formateado
	// $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	// $sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr>
			<td class='text-center'><?php echo $dni;?></td>
			<td class='text-center'><?php echo $jugador;?></td>
			<td class='text-right'><?php echo $edad;?></td>
			<?php 
if ($_SESSION['user_name'] =='admin'  && $_SESSION['user_name']=='mesa') {
	?>
	<td class="text-right"><?php echo $club;?></td>
	<?php
}
	?>
			
			<td class='text-right'><?php echo $camiseta;?></td>
			<?php 
if ($_SESSION['user_name'] !='admin'  && $_SESSION['user_name']!='mesa') {
	?>
			<td class='text-right'><a href="#" onclick="eliminar('<?php echo $id_detalle ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
				<?php
}
	?>
		</tr>		
		<?php
	}
	
?>

</table>
</div>
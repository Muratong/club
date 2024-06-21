<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Editar Planilla | ARH";
	
	/* Connect To Database*/
	require_once ("./config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("./config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	if (isset($_GET['id_planilla']))
	{
		$id_planilla=intval($_GET['id_planilla']);
		 $campos="planilla.club, planilla.fecha, planilla.categoria, planilla.torneo,planilla.num_planilla,detalle_planilla.dni, detalle_planilla.edad, detalle_planilla.camiseta";
		$sql_planilla=mysqli_query($con,"select * from planilla, detalle_planilla where planilla.num_planilla = detalle_planilla.num_planilla and planilla.id_planilla='".$id_planilla."'");
		$count=mysqli_num_rows($sql_planilla);
			
		{
				$rw_planilla=mysqli_fetch_array($sql_planilla);
				$club=$rw_planilla['club'];
				$categoria=$rw_planilla['categoria'];
				$torneo=$rw_planilla['torneo'];
				$dni=$rw_planilla['dni'];
				$edad=$rw_planilla['edad'];
				$entrenador=$rw_planilla['user_id'];
				$fecha=date("d/m/Y", strtotime($rw_planilla['fecha']));
				$camiseta=$rw_planilla['camiseta'];
				$num_planilla=$rw_planilla['num_planilla'];
			   // $_SESSION['id_factura']=$id_factura;
				$_SESSION['num_planilla']=$num_planilla;
				$_SESSION['id_planilla']=$id_planilla;
				
		}	
		
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Editar Planilla</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_jugador.php");
		?>
			<form class="form-horizontal" method="post" role="form" id="datos_planilla" name="datos_planilla">
				<div class="form-group row">
				  <label for="club" class="col-md-1 control-label">Club</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="club" name="club" placeholder="Club" readonly="" value="<?php echo $club;?>"><!-- <?php echo $num_planilla;?> -->
					  <input id="id_planilla" name="id_planilla" type='hidden' value="<?php echo $id_planilla;?>">
				  </div>
				  <label for="torneo" class="col-md-1 control-label">Torneo</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="torneo" name="torneo">
								<option value="1" <?php if ($torneo==1){echo "selected";}?>>Apertura</option>
								<option value="2" <?php if ($torneo==2){echo "selected";}?>>Clausura</option>
								<option value="3" <?php if ($torneo==3){echo "selected";}?>>Anual</option>	
								</select>
							</div>
					
				 </div>
						<div class="form-group row">
							<label for="empresa" class="col-md-1 control-label">Entrenador</label>
							<div class="col-md-3">
							<select class="form-control input-sm" id="user_id" name="user_id">
									<?php
									  session_start();
										$sql_entrenador=mysqli_query($con,"SELECT * FROM users WHERE user_id LIKE '%".$entrenador."%'");
										if ($rw=mysqli_fetch_array($sql_entrenador)){
											$user_id=$rw["user_id"];
											$nombre_entrenador=$rw["firstname"]." ".$rw["lastname"];
											if ($user_id==$_SESSION['user_id']){
												$selected="selected";
											} else {
												$selected="";
											}
											?>
											<option value="<?php echo $entrenador?>" <?php echo $selected;?>><?php echo $nombre_entrenador?></option>
											<?php
										}
									?>
								</select>
							</div>
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo $fecha;?>" readonly>
							</div>
							<label for="categoria" class="col-md-1 control-label">Categoria</label>
							<div class="col-md-3">
							<select class='form-control input-sm' id="categoria" name="categoria">
				<option value="1" <?php if ($categoria==1){echo "selected";}?>>1-Caballeros</option>
                                <option value="14" <?php if ($categoria==14){echo "selected";}?>>1-Caballeros B</option>
				<option value="2" <?php if ($categoria==2){echo "selected";}?>>1-Damas</option>
				<option value="3" <?php if ($categoria==3){echo "selected";}?>>1-Damas B</option>
				<option value="4" <?php if ($categoria==4){echo "selected";}?>>Sub 21</option>
                                <option value="15" <?php if ($categoria==15){echo "selected";}?>>Sub 19 Damas</option>
				<option value="5" <?php if ($categoria==5){echo "selected";}?>>Sub 16 Damas</option>
				<option value="6" <?php if ($categoria==6){echo "selected";}?>>Sub 16 Caballero</option>
				<option value="7" <?php if ($categoria==7){echo "selected";}?>>Sub 14 Damas</option>
				<option value="8" <?php if ($categoria==8){echo "selected";}?>>Sub 13 Mixto</option>
                                <option value="11" <?php if ($categoria==11){echo "selected";}?>>Sub 13 B</option>
				<option value="9" <?php if ($categoria==9){echo "selected";}?>>Sub 12 Damas</option>	
				<option value="10" <?php if ($categoria==10){echo "selected";}?>>Sub 12 Mixto</option>
				<option value="12" <?php if ($categoria==12){echo "selected";}?>>Sub 10 Mixto</option>
				<option value="13" <?php if ($categoria==13){echo "selected";}?>>Infantiles</option>
                                
                                
								</select>
							</div>
						</div>
				
				
			    <div class="col-md-12">
                    <div class="pull-right">
                    <?php 
if ($_SESSION['user_name'] !='admin'  && $_SESSION['user_name']!='mesa') {
	?>	
						<button type="submit" class="btn btn-success" style="background-color: ;">
						  <span class="glyphicon glyphicon-refresh"></span> Actualizar Planilla
						</button>
						
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar Jugador
						</button>
						<?php
}
	?>
						<button type="button" class="btn btn-primary" onclick="imprimir_factura('<?php echo $id_planilla;?>')">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>

			</form>		
			<div class="clearfix"></div>
				<div class="editar_planilla" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
			
		</div>
	</div>		
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/editar_planillas.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#nombre_cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
							minLength: 2,
							select: function(event, ui) { 
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#nombre_cliente').val(ui.item.nombre_cliente);
								$('#tel1').val(ui.item.telefono_cliente);
								$('#dni1').val(ui.item.dni_cliente);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#dni1" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#dni1" ).val("");
						}
			});	
	</script>

  </body>
</html>
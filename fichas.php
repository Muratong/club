<?php
	/*-------------------------
	Autor: INNOVAWEBSV
	Web: www.innovawebsv.com
	Mail: info@innovawebsv.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

    /* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_cargafichajes="active";
	$title="Fichajes";
	$active_administracion ="active";
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
		  <div class="btn-group pull-right">
				<button type='button' class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Cargar Fichajes</button>
			</div>
			<h4><i class='glyphicon glyphicon-list'></i> Listado de Jugadores Fichados</h4>
		</div>
			<div class="panel-body">
			<?php
			include("modal/registro_fichas.php");
			include("modal/editar_fichas.php");
			
			?>
				<form class="form-horizontal" role="form" id="datos_fichas">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Fichajes</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q"  placeholder="Apellido" onkeyup='load(1);'>
							</div>
							
							<div class="col-md-3">
								<button type="button" class="btn btn-info" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							<div class="col-md-12">
							<div class="pull-right">
							<button type="button" class="btn btn-primary" onclick="imprimir_fichas();">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
				</div>
			</div>
						</div>
				
				
				
			</form>
				<div id="resultados">	</div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</div>
	<hr>
	<?php
	include("footer.php");
	?>

	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/fichas.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  </body>
</html>
<script>
	
$( "#guardar_fichas" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
	 var parametros = $(this).serialize();
		 $.ajax({
				type: "POST",
				url: "ajax/nuevo_fichas.php",
				data: parametros,
				 beforeSend: function(objeto){
					$("#resultados_ajax").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$("#resultados_ajax").html(datos);
				$('#guardar_datos').attr("disabled", false);
				load(1);
			  }
		});
  event.preventDefault();
  
})

$( "#editar_fichas" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_fichas.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos2').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})


	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id){
			var dni = $("#dni"+id).val();
			var recibo = $("#recibo"+id).val();
			var contribuyente = $("#contribuyente"+id).val();
			var club = $("#club"+id).val();
			var cuota = $("#cuota"+id).val();
			var monto = $("#monto"+id).val();
			var fecha = $("#fecha"+id).val();
			var periodo = $("#periodo"+id).val();
			var año = $("#año"+id).val();
			var estado = $("#estado"+id).val();
			
			
			$("#mod_id").val(id);
			$("#dni2").val(dni);
			$("#recibo2").val(recibo);
			$("#contribuyente2").val(contribuyente);
			$("#club2").val(club);
			$("#cuota2").val(cuota);
			$("#monto2").val(monto);
			$("#fecha2").val(fecha);
			$("#periodo2").val(periodo);
			$("#estado2").val(estado);
			$("#año2").val(año);
			
			
		}

		$(function() {
						$("#dni").autocomplete({
							source: "./ajax/autocomplete/fichas.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_jugador').val(ui.item.id_jugador);
								$('#contribuyente').val(ui.item.nombre_jugador);
								$('#dni').val(ui.item.dni_jugador);
								$('#club').val(ui.item.origen);

																
								
							 }
						}); 
						 
						
					});
					
	$("#dni" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_jugador" ).val("");
							$("#club" ).val("");
							$("#contribuyente" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#contribuyente" ).val("");
							$("#id_jugador" ).val("");
							$("#club" ).val("");
							$("#dni" ).val("");
						}
			});	
</script>
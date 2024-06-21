<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div style="background-color: #3498db" class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Cargar Fichas</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_fichas" name="guardar_fichas">
			<div id="resultados_ajax"></div>
			<div class="form-group">
				<label for="recibo" class="col-sm-3 control-label">Recibo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="recibo" name="recibo" placeholder="Recibo" required>
				</div>
			  </div>
			<div class="form-group">
				<label for="dni" class="col-sm-3 control-label">Documento</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="dni" name="dni" placeholder="Dni" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="contribuyente" class="col-sm-3 control-label">Jugador</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="contribuyente" name="contribuyente" placeholder="Jugador" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="club" class="col-sm-3 control-label">Club/Equipo</label>
				<div class="col-sm-8">
				  <select class="form-control input-sm" id="club" name="club">
				  	<option value=""></option>
									<?php
										$sql_club=mysqli_query($con,"select * from clubes order by CLUB");
										while ($rw=mysqli_fetch_array($sql_club)){
											$id_club=$rw["ID"];
								$nombre_club=$rw["CLUB"]." ";
											
											?>

											<option value="<?php echo $nombre_club?>"><?php echo $nombre_club?></option>
											<?php
										}
									?>
								</select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="periodo" class="col-sm-3 control-label">Periodo</label>
				<div class="col-sm-8">
				<select class='form-control input-sm ' id="periodo" name="periodo" required="" >
					<option selected disabled required value="0" >Elige el periodo</option>
					<option value="Enero">Enero</option>
					<option value="Febrero">Febrero</option>
					<option value="Marzo">Marzo</option>
					<option value="Abril">Abril</option>
					<option value="Mayo">Mayo</option>
					<option value="Junio">Junio</option>
					<option value="Julio">Julio</option>
					<option value="Agosto">Agosto</option>
					<option value="Septiembre">Septiembre</option>
					<option value="Ocubre">Ocubre</option>
					<option value="Noviembre">Noviembre</option>
					<option value="Diciembre">Diciembre</option>
				</select>
			  </div>
			</div>
			  <div class="form-group">
				<label for="cuota" class="col-sm-3 control-label">Cuota</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="cuota" name="cuota" placeholder="Cuota"required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="monto" class="col-sm-3 control-label">Monto</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="monto" name="monto" placeholder="Monto" required>
				</div>
			  </div>
			 
			 <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				<select class='form-control input-sm ' id="estado" name="estado"  required="" >
					<option selected disabled required value="0" >Elige el estado</option>
					<option value="Habilitado">Habilitado</option>
					<option value="Deshabilitado">Deshabilitado</option>
				</select>
			</div>
			  </div>
			  </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
<script>
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
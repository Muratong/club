<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div style="background-color: #3498db" class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4  class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Modificar datos del Jugador</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_jugador" name="editar_jugador">
			<div id="resultados_ajax2"></div> 
			<div class="form-group">
				<label for="dni2" class="col-sm-3 control-label">Documento</label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="dni2" name="dni2" placeholder="Dni">
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre2" class="col-sm-3 control-label">Apellidos y Nombres</label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="nombre2" name="nombre2" placeholder="apellido y nombre">
				</div>
			  </div>
			  <div class="form-group">
				<label for="fecha2" class="col-sm-3 control-label">Año de Nac.</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="fecha2" name="fecha2" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="titulo2" class="col-sm-3 control-label">Titulo</label>
				<div class="col-sm-8">
				   <input type="text" class="form-control" id="titulo2" name="titulo2" placeholder="Titulo">
				</div>
			  </div>
			  <div class="form-group">
				<label for="uni2" class="col-sm-3 control-label">Universidad</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="uni2" name="uni2" placeholder="Universidad">
				</div>
			  </div>
			  <div class="form-group">
				<label for="provincia2" class="col-sm-3 control-label">Provincia</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="provincia2" name="provincia2" placeholder="Provincia">
				</div>
			  </div>
			  <div class="form-group">
				<label for="direccion2" class="col-sm-3 control-label">Direccion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="direccion2" name="direccion2" placeholder="Direccion" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="social2" class="col-sm-3 control-label">Obra social</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="social2" name="social2" placeholder="Obra social" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono2" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="Telefono" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="historial2" class="col-sm-3 control-label">Historial Medico</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="historial2" name="historial2" placeholder="Historial Medico" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="correo2" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="correo2" name="correo2" placeholder="Correo electrónico" >
				</div>
			  </div>
			<div class="form-group">
				<label for="documentacion2" class="col-sm-3 control-label">Documentacion</label>
				<div class="col-sm-8">
					<select class="form-control" id="documentacion2" name="documentacion2">
						<option value="No Apto">No Apto</option>
						<option value="Apto">Apto</option>
					</select>
				</div>
			  </div>		 
			
			  <div class="form-group">
				<label for="club2" class="col-sm-3 control-label">Equipo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="club2" name="club2" placeholder="Club" readonly="" >
				</div>
			  </div>
			   
		  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos2">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
	<script>
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					$.ajax({
						url: "ajax/editar_jugador.php",        
						type: "POST",             
						data: data, 			  
						contentType: false,       
						cache: false,            
						processData:false,        
						success: function(data)   
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
		</script>
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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo Equipo</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="firstname" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Nombre delegado" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="lastname" class="col-sm-3 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellido delegado" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_name" class="col-sm-3 control-label">Usuario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="nombre Equipo" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Correo electrónico" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_password_new" class="col-sm-3 control-label">Contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_password_repeat" class="col-sm-3 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
			  </div>
			          <div class="col-md-3 col-lg-3 " align="center"> 
				<div id="load_img">
				</div>
				<br>				
					<div class="row">
  						<div class="col-md-12">
							<div class="form-group">
								<input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();" class="form-control">
							</div>
						</div>
						
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
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					$("#load_img").html(data);
				
				}
				
				
			}
    </script>
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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo Jugador</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_jugador" name="guardar_jugador">
			<div id="resultados_ajax"></div>
			<div class="form-group">
				<label for="dni" class="col-sm-2 control-label">Documento</label>
				<div class="col-sm-4">
				  <input type="text" class="form-control" id="dni" name="dni" placeholder="Dni" required>
				</div>
				<label for="club" class="col-sm-2 control-label">Club</label>
				<div class="col-sm-4">
				  <select class="form-control input-sm" id="club" name="club">
				  	<option value="">seleccione un equipo</option>
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
				<label for="nombre" class="col-sm-4 control-label">Nombres y Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="apellido y nombre">
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-4 control-label">Titulo</label>
				<div class="col-sm-8">
				   <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-4 control-label">Universidad</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="uni" name="uni" placeholder="Universidad">
				</div>
			  </div>
			  <div class="form-group">
				<label for="fecha" class="col-sm-2 control-label">Fecha de Nacimiento</label>
				<div class="col-sm-4">
				  <input type="date" class="form-control" id="fecha" name="fecha" value="Y">
				</div>
				<label for="sexo" class="col-sm-2 control-label">Genero</label>
				<div class="col-sm-4">
				<select class="form-control" id="sexo" name="sexo" class="control-form" required="" >
					<option selected disabled required value="0" >Elige el genero</option>
					<option value="Masculino">Masculino</option>
					<option value="Femenino">Femenino</option>
				</select>
			</div>
			  </div>
			   <div class="form-group">
				<label for="provincia" class="col-sm-2 control-label">Provincia</label>
				<div class="col-sm-4">
				  <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia">
				</div>
				<label for="direccion" class="col-sm-2 control-label">Direccion</label>
				<div class="col-sm-4">
				  <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="sanguineo" class="col-sm-2 control-label">Tipo de Sangre</label>
				<div class="col-sm-4">
				  <input type="text" class="form-control" id="sanguineo" name="sanguineo" placeholder="Tipo de Sangre" >
				</div>
				<label for="social" class="col-sm-2 control-label">Obra social</label>
				<div class="col-sm-4">
				  <input type="text" class="form-control" id="social" name="social" placeholder="Obra social">
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-2 control-label">Telefono</label>
				<div class="col-sm-4">
				  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
				</div>
				<label for="historial" class="col-sm-2 control-label">Historial Medico</label>
				<div class="col-sm-4">
				  <input type="text" class="form-control" id="historial" name="historial" placeholder="Historial Medico" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="correo" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-4">
				  <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" >
				</div>
				<label for="documentacion" class="col-sm-2 control-label">Estado</label>
				<div class="col-sm-4">
				  <select class="form-control" id="documentacion" name="documentacion">
				  	<option value="">Seleccione</option>
				  	<option value="Apto">Apto</option>
				  	<option value="No Apto">No Apto</option>
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
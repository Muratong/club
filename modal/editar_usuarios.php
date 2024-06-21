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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar usuario</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div> 
			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="firstname2" name="firstname2" placeholder="Nombres" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="lastname2" class="col-sm-3 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="lastname2" name="lastname2" placeholder="Apellidos" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_name2" class="col-sm-3 control-label">Equipo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_name2" name="user_name2" placeholder="Usuario" required readonly>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_email2" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="user_email2" name="user_email2" placeholder="Correo electrónico" required>
				</div>
			  </div>
				 	 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
    var idClub = document.getElementById("id_club").value;

    if ((typeof file === "object") && (file !== null)) {
        $("#load_img").text('Cargando...');
        var data = new FormData();
        data.append('imagefile', file);
        data.append('id_club', idClub);
        
        $.ajax({
            url: "ajax/imagenes_ajax.php",        
            type: "POST",                         
            data: data,                          
            contentType: false,                   
            cache: false,                         
            processData: false,                  
            success: function(response) {        
                $("#load_img").html(response);
            }
        });
    }
}

				
    </script>
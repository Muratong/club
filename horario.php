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

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_horario="active";	
	$title="Apertura|Cierre";
	
	$query_horario=mysqli_query($con,"select * from horarios where id_horario=1");
	$hora=mysqli_fetch_array($query_horario);
	$dia_inicio = $hora['dia_inicio'];
	$dia_cierre = $hora['dia_cierre'];
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
      <div class="row">
      <form method="post" id="horario">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
<?php if ($dia_inicio=='1'){  $dia = 'Lunes';} ?> 
<?php if ($dia_inicio=='2') { $dia = 'Martes';} ?>
<?php if ($dia_inicio=='3') {$dia = 'Miercoles';} ?>
<?php if ($dia_inicio=='4') { $dia = 'Jueves';} ?>
<?php if ($dia_inicio=='5') { $dia = 'Viernes';} ?>
<?php if ($dia_inicio=='6') {$dia = "Sabado";} ?>
<?php if ($dia_inicio=='7') {$dia = 'Domindo';} ?>
<?php 
if ($dia_cierre=='7') {
  $dias="Domingo";
}else if ($dia_cierre=='1') {
  $dias="Lunes";
}elseif ($dia_cierre=='2') {
  $dias="Martes";
}elseif ($dia_cierre=='3') {
 $dias="Miercoles";
}elseif ($dia_cierre=='4') {
  $dias="Jueves";
}elseif ($dia_cierre=='5') {
 $dias="Viernes";
}elseif ($dia_cierre=='6') {
  $dias="Sabado";
}
 ?> 
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><i class='glyphicon glyphicon-cog'></i> Configuración de apertura y cierre <div class="nav navbar-nav navbar-right"><?php echo $dia ?> <?php echo $hora['apertura']?> hasta <?php echo $dias ?> <?php echo $hora['cierre']?></div></h3>
             
             
            
            </div>
            <div class="panel-body">
              <div class="row">
			                 
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-condensed">
                    <tbody>
                    	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                     <tr>
                        <td class="">Dia inicio:</td>
                        <td><select class='form-control input-sm' id="dia_inicio" name="dia_inicio">
                        	<option value="">Seleccione un dia</option>
				<option value="1" <?php if ($dia_inicio=='1'){echo "selected";}?>>Lunes</option>
				<option value="2" <?php if ($dia_inicio=='2'){echo "selected";}?>>Martes</option>
				<option value="3" <?php if ($dia_inicio=='3'){echo "selected";}?>>Miercoles</option>
				<option value="4" <?php if ($dia_inicio=='4'){echo "selected";}?>>Jueves</option>
				<option value="5" <?php if ($dia_inicio=='5'){echo "selected";}?>>Viernes</option>
				<option value="6" <?php if ($dia_inicio=='6'){echo "selected";}?>>Sabado</option>
				<option value="7" <?php if ($dia_inicio=='7'){echo "selected";}?>>Domingo</option>
									
								</select></td>
                      </tr>
                  </div>
                      <div class="form-group col-lg-6 col-md-6 col-xs-12">
                      <tr>
                      	<td class='col-md-3'>Hora inicio:</td>
                        <td><input type="time" class="form-control input-sm" name="apertura" value="<?php echo $hora['apertura']?>" required></td>
                      </tr>
                  </div>
                      <div class="form-group col-lg-6 col-md-6 col-xs-12">
                      <tr>
                        <td class="">Dia cierre:</td>
                        <td><select class='form-control input-sm' id="dia_cierre" name="dia_cierre">
                        	<option value="">Seleccione un dia</option>
									<option value="1" <?php if ($dia_inicio=='1'){echo "selected";}?>>Lunes</option>
				<option value="2" <?php if ($dia_cierre=='2'){echo "selected";}?>>Martes</option>
				<option value="3" <?php if ($dia_cierre=='3'){echo "selected";}?>>Miercoles</option>
				<option value="4" <?php if ($dia_cierre=='4'){echo "selected";}?>>Jueves</option>
				<option value="5" <?php if ($dia_cierre=='5'){echo "selected";}?>>Viernes</option>
				<option value="6" <?php if ($dia_cierre=='6'){echo "selected";}?>>Sabado</option>
				<option value="7" <?php if ($dia_cierre=='7'){echo "selected";}?>>Domingo</option>
									
								</select></td>
                      </tr>
                  </div>
                      <div class="form-group col-lg-6 col-md-6 col-xs-12">
                      <tr>
                        <td>Hora Cierre:</td>
                        <td><input type="time" class="form-control input-sm" name="cierre" value="<?php echo $hora['cierre']?>" required></td>
                      </tr>
					</div>
                  
                        
                     
                    </tbody>
                  </table>
                  
                  
                </div>
				<div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
              </div>
            </div>
                 <div class="panel-footer text-center">
                    
                     
                            <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-refresh"></i> Actualizar datos</button>
                       
                       
                    </div>
            
          </div>
        </div>
		</form>
      </div>

	
	<?php
	include("footer.php"); 
	?>
  </body>
</html>
<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
<script>
$( "#horario" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_horario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);

		  }
	});
  event.preventDefault();
})





		
</script>

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
						url: "ajax/imagen_ajax.php",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>
<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['apertura'])) {
           $errors[] = "apertura esta vacío";
        }else if (empty($_POST['cierre'])) {
           $errors[] = "cierre esta vacío";
        }else if (empty($_POST['dia_inicio'])) {
           $errors[] = "dia inicio esta vacío";
       }else if (empty($_POST['dia_cierre'])) {
           $errors[] = "dia cierre esta vacío";
        }   else if (
			!empty($_POST['apertura']) &&
			!empty($_POST['dia_inicio']) &&
			!empty($_POST['dia_cierre']) &&
			!empty($_POST['cierre'])
			 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$apertura=mysqli_real_escape_string($con,(strip_tags($_POST["apertura"],ENT_QUOTES)));
		$cierre=mysqli_real_escape_string($con,(strip_tags($_POST["cierre"],ENT_QUOTES)));
		//$estado=mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
		$inicio=mysqli_real_escape_string($con,(strip_tags($_POST["dia_inicio"],ENT_QUOTES)));
		$final=mysqli_real_escape_string($con,(strip_tags($_POST["dia_cierre"],ENT_QUOTES)));
		
		
		$sql="UPDATE horarios SET dia_inicio='".$inicio."', apertura='".$apertura."', dia_cierre='".$final."', cierre='".$cierre."', estado='1' WHERE id_horario='1'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>
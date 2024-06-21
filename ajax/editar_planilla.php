<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$id_planilla= $_SESSION['id_planilla'];
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['user_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['club'])) {
           $errors[] = "Selecciona el club";
        } else if (empty($_POST['categoria'])){
			$errors[] = "Selecciona categoria";
		} else if ($_POST['torneo']==""){
			$errors[] = "Selecciona el torneo";
		} else if (
			!empty($_POST['user_id']) &&
			!empty($_POST['club']) &&
			!empty($_POST['categoria']) &&
			$_POST['torneo']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$user_id=intval($_POST['user_id']);
		$club=$_POST['club'];
		$categoria=intval($_POST['categoria']);

		$torneo=intval($_POST['torneo']);
		
		$sql="UPDATE planilla SET user_id='".$user_id."', club='".$club."', categoria='".$categoria."', torneo='".$torneo."' WHERE id_planilla='".$id_planilla."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Planilla ha sido actualizada satisfactoriamente.";
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
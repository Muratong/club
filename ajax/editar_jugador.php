<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['dni2'])){
            $errors[] = "Dni vac�o";
        } elseif (empty($_POST['nombre2'])){
            $errors[] = "apellido y nombre vac�os";
        }  elseif (empty($_POST['fecha2'])) {
            $errors[] = "fecha vac�o";
        } elseif (empty($_POST['provincia2'])){
            $errors[] = "provincia vac�o";
        }  elseif (empty($_POST['direccion2'])) {
            $errors[] = "direccion vac�o";
        } elseif (empty($_POST['social2'])){
            $errors[] = "obra_social vac�o";
        }  elseif (empty($_POST['telefono2'])) {
            $errors[] = "telefono vac�o";
        }  elseif (empty($_POST['historial2'])) {
            $errors[] = "historial_medical vac�o";
        } elseif (empty($_POST['correo2'])){
            $errors[] = "correo vac�o";
        }  elseif (empty($_POST['documentacion2'])) {
            $errors[] = "documentacion vac�o";
        }  elseif (empty($_POST['club2'])) {
            $errors[] = "club vac�o";
        } elseif (empty($_POST['titulo2'])){
           $errors[] = "Titulo vac�o";
        }elseif (empty($_POST['uni2'])){
           $errors[] = "Universidad vac�o";
        }  elseif (
            !empty($_POST['dni2'])
            && !empty($_POST['nombre2'])
            && !empty($_POST['fecha2'])
            && !empty($_POST['provincia2'])
            && !empty($_POST['direccion2'])
            && !empty($_POST['social2'])
            && !empty($_POST['telefono2'])
            && !empty($_POST['historial2']) 
            && !empty($_POST['correo2'])
            && !empty($_POST['documentacion2'])
            && !empty($_POST['club2'])  
             && !empty($_POST['titulo2'])
            && !empty($_POST['uni2'])
          ){ 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $dni = mysqli_real_escape_string($con,(strip_tags($_POST["dni2"],ENT_QUOTES)));
				$nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre2"],ENT_QUOTES)));
                $titulo = mysqli_real_escape_string($con,(strip_tags($_POST["titulo2"],ENT_QUOTES)));
                $uni = mysqli_real_escape_string($con,(strip_tags($_POST["uni2"],ENT_QUOTES)));
				$fecha = mysqli_real_escape_string($con,(strip_tags($_POST["fecha2"],ENT_QUOTES)));
                $provincia = mysqli_real_escape_string($con,(strip_tags($_POST["provincia2"],ENT_QUOTES)));
				$direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion2"],ENT_QUOTES)));
				$social = mysqli_real_escape_string($con,(strip_tags($_POST["social2"],ENT_QUOTES)));
                $telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono2"],ENT_QUOTES)));
				$historial = mysqli_real_escape_string($con,(strip_tags($_POST["historial2"],ENT_QUOTES)));
				$correo = mysqli_real_escape_string($con,(strip_tags($_POST["correo2"],ENT_QUOTES)));
                $documentacion = mysqli_real_escape_string($con,(strip_tags($_POST["documentacion2"],ENT_QUOTES)));
                $club = mysqli_real_escape_string($con,(strip_tags($_POST["club2"],ENT_QUOTES)));
                $id=intval($_POST['mod_id']);
                    
					
               	// Escribe el nuevo registro
            $sql = "UPDATE jugadores SET DNI='".$dni."', APELLIDO_Y_NOMBRE='".$nombre."',titulo='".$titulo."',universidad='".$uni."' , FECHA='" . $fecha . "', PROVINCIA='" . $provincia . "', DIRECCION='".$direccion."', OBRA_SOCIAL='".$social."', TELEFONO='".$telefono."', HISTORIAL_MEDICO='" .$historial. "', CORREO='" .$correo. "', DOCUMENTACION='" .$documentacion. "', CLUB='" .$club. "'WHERE ID='".$id."';";
                   $query_update = mysqli_query($con,$sql);

                   // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "Los Datos ha sido modificada con �xito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro fall�. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurri�.";
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
                        <strong>�Bien hecho!</strong>
                        <?php
                            foreach ($messages as $message) {
                                    echo $message;
                                }
                            ?>
                </div>
                <?php
            }

?>
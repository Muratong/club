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
            $errors[] = "Dni vacío";
        } elseif (empty($_POST['nombre2'])){
            $errors[] = "apellido y nombre vacíos";
        } elseif (empty($_POST['monto2'])){
            $errors[] = "Monto no puede estar vacíos";
        } elseif (
            !empty($_POST['dni2'])
            && !empty($_POST['nombre2'])
            && !empty($_POST['fecha2'])
            && !empty($_POST['monto2'])
            && !empty($_POST['estado'])
              
          ){ 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                                $dni = mysqli_real_escape_string($con,(strip_tags($_POST["dni2"],ENT_QUOTES)));
				$nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre2"],ENT_QUOTES)));
                                $monto = mysqli_real_escape_string($con,(strip_tags($_POST["monto2"],ENT_QUOTES)));
                                $estado = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
				$id=intval($_POST['mod_id']);
                    
					
               	// Escribe el nuevo registro
            $sql = "UPDATE pases SET DNI='".$dni."', APELLIDO_Y_NOMBRE='".$nombre."', MONTO='".$monto."', ESTADO='".$estado."'WHERE ID='".$id."';";
                      
                   $query_update = mysqli_query($con,$sql);
                   if ($query_update==1) {
        $sql1 = "UPDATE jugadores SET DNI='".$dni."', APELLIDO_Y_NOMBRE='".$nombre."'WHERE DNI='".$dni."';";
                     $update1 = mysqli_query($con,$sql1);
                   }
                    
                   // if user has been added successfully
                    if ($update1==1) {
                        $messages[] = "Los datos han sido modificada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
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
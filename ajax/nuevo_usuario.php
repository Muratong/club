<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Lo siento, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['firstname'])){
			$errors[] = "Nombres vacíos";
		} elseif (empty($_POST['lastname'])){
			$errors[] = "Apellidos vacíos";
		}  elseif (empty($_POST['user_name'])) {
            $errors[] = "Nombre de usuario/club vacío";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $errors[] = "Contraseña vacía";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $errors[] = "La contraseña debe tener como mínimo 6 caracteres";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $errors[] = "Nombre de usuario/club no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (empty($_POST['user_name'])) {
            $errors[] = "Nombre de usuario/club vacio";
        } elseif (empty($_POST['user_email'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['user_email']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['user_name'])
			&& !empty($_POST['firstname'])
			&& !empty($_POST['lastname'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && !empty($_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["firstname"],ENT_QUOTES)));
				$lastname = mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
				$user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name"],ENT_QUOTES)));
                $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["user_email"],ENT_QUOTES)));
				$user_password = $_POST['user_password_new'];
				$date_added=date("Y-m-d H:i:s");
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
					if (isset($_FILES["imagefile"])){
				$target_dir = realpath(__DIR__ . '/../img/') . '/';
				$image_name = time()."_".basename($_FILES["imagefile"]["name"]);
				$target_file = $target_dir . $image_name;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$imageFileZise=$_FILES["imagefile"]["size"];
				if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) and $imageFileZise>0) {
				$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
				} else if ($imageFileZise > 1048576) {//1048576 byte=1MB
				$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
				}else{
						if ($imageFileZise>0){
					move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
					$logo="img/$image_name";
				
				} else { $logo="";}
					}
				}
                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , el nombre de usuario ó la dirección de correo electrónico ya está en uso.";
                } else {
					// write new user's data into database
					mysqli_query($con, 'ALTER TABLE users AUTO_INCREMENT 1');
                    $sql = "INSERT INTO users (firstname, lastname, user_name, user_password_hash, user_email, date_added,imagen)
                            VALUES('".$firstname."','".$lastname."','" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "','".$date_added."','".$logo."');";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "La cuenta ha sido creada con éxito.";
                        mysqli_query($con, 'ALTER TABLE clubes AUTO_INCREMENT 1');
                    $sql = "INSERT INTO clubes (CLUB, CORREO)
                            VALUES('". $user_name . "', '" . $user_email . "');";
                    $query_new_club_insert = mysqli_query($con,$sql);
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
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
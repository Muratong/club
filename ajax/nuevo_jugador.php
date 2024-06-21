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
        if (empty($_POST['dni'])){
            $errors[] = "Dni vacío";
        } elseif (empty($_POST['nombre'])){
            $errors[] = "apellido y nombre vacíos";
        }  elseif (empty($_POST['fecha'])) {
            $errors[] = "fecha vacío";
        } elseif (empty($_POST['provincia'])){
            $errors[] = "provincia vacío";
        }  elseif (empty($_POST['direccion'])) {
            $errors[] = "direccion vacío";
         } elseif (empty($_POST['sanguineo'])){
            $errors[] = "sanguineo vacíos";
        } elseif (empty($_POST['social'])){
            $errors[] = "obra_social vacío";
        }  elseif (empty($_POST['telefono'])) {
            $errors[] = "telefono vacío";
        }  elseif (empty($_POST['historial'])) {
            $errors[] = "historial_medical vacío";
        } elseif (empty($_POST['correo'])){
            $errors[] = "correo vacío";
        }  elseif (empty($_POST['documentacion'])) {
            $errors[] = "documentacion vacío";
        }  elseif (empty($_POST['club'])) {
            $errors[] = "club vacío";
        } elseif (empty($_POST['titulo'])){
           $errors[] = "Titulo vacío";
        }elseif (empty($_POST['uni'])){
           $errors[] = "Universidad vacío";
        }  elseif (empty($_POST['sexo'])) {
            $errors[] = "sexo vacío";
        } elseif (
            !empty($_POST['dni'])
            && !empty($_POST['nombre'])
            && !empty($_POST['fecha'])
            && !empty($_POST['provincia'])
            && !empty($_POST['direccion'])
             && !empty($_POST['sanguineo'])
            && !empty($_POST['social'])
            && !empty($_POST['telefono'])
            && !empty($_POST['historial']) 
            && !empty($_POST['correo'])
            && !empty($_POST['documentacion'])
            && !empty($_POST['club'])
            && !empty($_POST['titulo'])
            && !empty($_POST['uni'])
            && !empty($_POST['sexo'])  
          ){ 
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
            
                // escaping, additionally removing everything that could be (html/javascript-) code
                $dni = mysqli_real_escape_string($con,(strip_tags($_POST["dni"],ENT_QUOTES)));
                $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
                $fecha = mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
                $titulo = mysqli_real_escape_string($con,(strip_tags($_POST["titulo"],ENT_QUOTES)));
                $uni = mysqli_real_escape_string($con,(strip_tags($_POST["uni"],ENT_QUOTES)));
                $provincia = mysqli_real_escape_string($con,(strip_tags($_POST["provincia"],ENT_QUOTES)));
                $direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
                 $sanguineo = mysqli_real_escape_string($con,(strip_tags($_POST["sanguineo"],ENT_QUOTES)));
                $social = mysqli_real_escape_string($con,(strip_tags($_POST["social"],ENT_QUOTES)));
                $telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
                $historial = mysqli_real_escape_string($con,(strip_tags($_POST["historial"],ENT_QUOTES)));
                $correo = mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));
                $documentacion = mysqli_real_escape_string($con,(strip_tags($_POST["documentacion"],ENT_QUOTES)));
                $club = mysqli_real_escape_string($con,(strip_tags($_POST["club"],ENT_QUOTES)));
                 //$categoria = mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
                $sexo = mysqli_real_escape_string($con,(strip_tags($_POST["sexo"],ENT_QUOTES)));
                 $user=$_SESSION["user_name"];
                    
                    
                // Escribe el nuevo registro
            $sql = "INSERT INTO jugadores SET DNI='".$dni."', APELLIDO_Y_NOMBRE='".$nombre."',titulo='".$titulo."',universidad='".$uni."' , FECHA='" . $fecha . "', PROVINCIA='" . $provincia . "', DIRECCION='".$direccion."', GRUPO_SANGUINEO='" . $sanguineo . "', OBRA_SOCIAL='".$social."', TELEFONO='".$telefono."', HISTORIAL_MEDICO='" .$historial. "', CORREO='" .$correo. "', DOCUMENTACION='" .$documentacion. "', CLUB='" .$club. "', SEXO='" . $sexo . "', USUARIO='" . $user . "';";
                   $query_update = mysqli_query($con,$sql);

                   // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "Los Datos del jugador ha sido agregado con éxito.";
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
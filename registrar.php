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
     
    $active_carnet="active";    
    $title="Carnet";
    
    
?>
<?php 
$nombre = $_POST['name'];
$psw = $_POST['psw'];
$foto = $_FILES['foto'];


$tmp_name = $foto['tmp_name'];
$directorio_destino = "images";
    
        $img_file = $foto['name'];
        $img_type = $foto['type'];  
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
 strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            $destino = $directorio_destino . '/' .  $img_file;
            mysqli_query($con, "INSERT INTO  carnets VALUES ('$nombre','$destino','$psw');");
            (move_uploaded_file($tmp_name, $destino))
                ?>

<script type="text/javascript">
     window.location = "carnet.php";
 </script>
                <?php  

            }
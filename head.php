    <?php 
        require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("config/conexion.php");
$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
  $row=mysqli_fetch_array($query_empresa);
     ?>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="css/custom.css">
	<link rel=icon href='<?php echo $row['logo_url']; ?>' sizes="32x32" type="image/png">
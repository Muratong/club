<?php
	/*-------------------------
	Autor: INNOVAWEBSV
	Web: www.innovawebsv.com
	Mail: info@innovawebsv.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
	$row=mysqli_fetch_array($query_empresa);
		
	$title="Home";
	$query_horario=mysqli_query($con,"select * from horarios where id_horario=1");
  $hora=mysqli_fetch_array($query_horario);
  $apertura= $hora['apertura'];
  $cierre=$hora['cierre'];
  $dia_inicio = $hora['dia_inicio'];
  $dia_cierre = $hora['dia_cierre'];
  $hora_actual = date('H:i:s');
  $today = date("w");
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<meta charset="utf-8">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
	<?php include("navbar.php");?> 
    <div class="container">
		<div class="panel panel-info">

		<div class="panel-heading">

		   <?php if ($_SESSION['user_name']!='admin'):?> 
		   <?php if (
              (($dia_cierre >=$today && $cierre>=$hora_actual)|| $dia_cierre>$today && $dia_inicio<=$today )
           ) { ?>
		<h2><i></i> Bienvenidos a la <?php echo $row['impuesto']?></h2>
		 <?php }else{
		 	?>
<h2><i></i> Ya esta cerrado la carga de la <?php echo $row['impuesto']?></h2>
<?php 

		 	   }  ?>
		<?php endif; ?>
		<?php if ($_SESSION['user_name']=='admin'):?>
	<h2><i></i> Bienvenidos al Panel Administrativo </h2>
	<?php endif; ?>
		</div>
		
			<div class="panel-body">
				<?php if ($_SESSION['user_name']!='admin'):?> 
		 <?php if (
              (($dia_cierre >=$today && $cierre>=$hora_actual)|| $dia_cierre>$today && $dia_inicio<=$today )
           ) { ?>
				<form class="form-horizontal" role="form" id="datos_cotizacion">					
				<h4>LA PLATAFORMA LE PERMITIRA REALIZAR LAS SIGUIENTES TAREAS :) 
			    <br>
				<h1 class="fa fa-spinner fa-spin"></h1><i> Consultar el Estado de los Fichajes</i>
                <br>
                <h1 class="fa fa-spinner fa-spin"></h1><i> Verificar Datos Personales de los Jugadores</i>
                <br>
                <h1 class="fa fa-spinner fa-spin"></h1><i> Generar las Planillas de Juego y Actualizarlas</i>   
				</h4>
 <?php }else{
		 	?>
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						 <div class="col-md-12 col-lg-12 " align="center">
				<img class="img-responsive" src="./img/prohibido.jpg" alt="Logo">
</div>
				</h4>
								
			</form>
				
				
			</form>
			<?php 
		 	   }  ?>
		<?php endif; ?>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 <script type="text/javascript">
     setInterval(function(){ load_data(); }, 3000);
  </script>
  </body>
</html>
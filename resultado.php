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
<style>
	#volver{
		position: relative;
		
		margin-left: 10px;
		top: 10px;

	}
	img{
		position: relative;
		display: flex;
		margin-left: 10px;
		
		width: 300px;
		height: 200px;
		border-radius: 20px;

	}
	.card-header{
	position: relative;
	background-color: lightblue;
	border: 1px solid lightblue;
	padding-left: 20px;
	

}

	button.btn{
		position: relative;
		
		top: 10px;
	}
	p{
		
		margin-left: 20px;

	}
	.card{
		position: relative;
		width: 300px;
	}
	h6{
		padding: 10px;
	}
	#update-form{
		
		position: relative;
		display: flex;
		max-width: 600px;
		
		padding: 10px;
	}
	
</style>
<body>
	<?php 
	
	if (isset($_POST['doc'])){
		$doc=$_POST['doc'];
	}

	$consulta = mysqli_query($con, "SELECT * FROM carnets WHERE psw = '$doc';");
	$valores = mysqli_fetch_array($consulta);
	$nombre = $valores['nombre'];
	$psw = $valores['psw'];
	$foto = $valores['foto'];
	 ?>
	 <div class="container">
	 	<div class="row pt-2">
	 		<div class="col-md-4 ">
	 			<div class="card" style="border:none;">
	 				<img src="<?php echo $foto; ?>">
	 				
	 			</div>
	 		</div>
	 		<div class="col-md-4 ">
	 			<div class="card Nombre">
	 				<div class="card-header">
	 					<h4>Datos del jugador/a</h4>
	 				</div>
	 				<p><strong>Nombre :</strong> <?php echo $nombre; ?></p>
	 				<p><strong>Documento :</strong> <?php echo $psw; ?></p>
	 			</div>
	 		</div>
	 		
	 	</div>
	 </div>
	 <div class="container">
  		<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Actualizar</button>
  		<a href="index.php" id="volver" class="btn btn-danger">Volver</a>
  		<div id="demo" class="collapse ">
         <form action="foto.php" id="update-form" class="card-body" method="post" enctype="multipart/form-data">
         	<div class="col-md-8"> 
         	<div class="form-group">
				<input type="hidden"  name="psw" value="<?php echo $psw; ?>">
         	</div>
		 <div class="card-header">
		 	<h4>Ingresar nueva foto del carnet </h4>
		 </div>
		<div class="form-group">
			<input type="file" name="nfoto" id="nfoto" class="form-control">
		</div>
		<input type="submit" class="btn btn-primary" value="Guardar" name="">
		</div>
	     </form>
  </div>
</div>
</body>
</html>
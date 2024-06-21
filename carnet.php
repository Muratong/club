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
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_carnet="active";	
	$title="Carnet";
	
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <style>
  	a.registro{
	border: 1px solid;
	padding: 5px;
	position: relative;
	top: 20px;
	bottom: 5px;
	margin: 5px;
	right: 10px;
	background-color: lightblue;
	list-style: none;
	border-radius: 10px;
	color: whitesmoke;
}
span{
	
	position: relative;
	top: 20px;
	bottom: 5px;
}
.card-header{
	position: relative;
	background-color: lightblue;
}
input{
	padding: 10px;
	position: relative;
	top: 10px;
}
.card{
	border: 1px solid lightblue;
	border-radius: 10px;
	background-color: whitesmoke;

}
  </style>
  <body>
 	<?php
	include("navbar.php");
	?> 
	<div class="container rounded ">
		<div class="row pt-5">
			<!--Form-->
			<div class="col-md-4">
				<div class="card p-4">
					<div class="card-header">
						<h4>CONSULTAR CARNET</h4>
					</div>
					<form id="consulta-form" class="consulta" >
						<div class="form-group">
							<input type="text" name="psw" id="psw" class="form-control" placeholder="Ingrese su DNI" required>
						</div>
				<input type="submit" class="btn btn-primary btn-block" value="Consultar" name="">
					</form>
				</div>
				<span>¿Nuevo registro? </span>
					<a href="" class="registro" data-toggle="collapse" data-target="#demo"> CLIC AQUI</a><br>
					
				<br><br>
			</div>

			<div class="col-md-8" style="border: 1px solid lightblue;">
				          <div id="Resultado"></div>
				<div class="container pt-2">
  				    <div id="demos" class="collapse">
    				<div class="col-md-8">
    					<div class="card">
    						<div class="card-header">
    							<h4>Nuevo Registro</h4>
    						</div>
    						<form action="registrar.php" method="post" enctype="multipart/form-data">
    							<div class="form-group">
    								<input type="text" name="name" class="form-control" placeholder="Nombre completo">
    							</div>
    							<div class="form-group">
    								<input type="text" name="psw" class="form-control" placeholder="Documento">
    							</div>
    							<div class="form-group">
    								<input type="file" name="foto" class="form-control">
    							</div>
    							<input type="submit" name="guardar" value="Registrar" class="btn btn-primary">
    						</form>
    					</div>
    				</div>
  				</div>
				</div>
			</div>
		</div>

	</div>
	
	<?php
	include("footer.php"); 
	?>
	<script>
$(document).ready(function(){
$("#consulta-form").submit(function(e)
{
	e.preventDefault();

	var doc= $("#psw").val();
	
	$.ajax({
    type:"POST",
    data:"doc="+$('#psw').val(),
    url:'resultado.php',
    success:function(datos) {
    $('#Resultado').html(datos);
          }
	    });
      });
  });
 $(".registro").click(function(){
 	$('#Resultado').hide();
 	$('#demos').show();
 	
 });

 $("#consulta-form").click(function(){
 	$('#demos').hide();
 	$('#Resultado').show();
 })

 
</script>
  </body>
</html>

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
	$active_planilla="active";
	$title="Cargar Planilla";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
	<div class="panel panel-info">
		<!-- <div class="panel-content"> -->
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Crear Planilla de Juego</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_jugador.php");
			
		?>
			<form class="form-horizontal" method="post" role="form" id="datos_planilla" name="datos_planilla">
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-1 control-label">Club</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="club" name="club" placeholder="Club" readonly="" value="<?php echo($_SESSION['user_name']);?>">
					  
				  </div>
				  <label for="torneo" class="col-md-1 control-label">Torneo</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="torneo" name="torneo">
									<option value="1">Apertura</option>
									<option value="2">Clausura</option>
									<option value="3">Anual</option>
									
								</select>
							</div>
					
				 </div>
						<div class="form-group row">
							<label for="empresa" class="col-md-1 control-label">Entrenador/a</label>
							<div class="col-md-3">
							<select class="form-control input-sm" id="user_id">
									<?php
									  session_start();
										$sql_vendedor=mysqli_query($con,"SELECT * FROM users WHERE user_name LIKE '%".$_SESSION['user_name']."%'");
										if ($rw=mysqli_fetch_array($sql_vendedor)){
											$user_id=$rw["user_id"];
											$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
											if ($user_id==$_SESSION['user_id']){
												$selected="selected";
											} else {
												$selected="";
											}
											?>
											<option value="<?php echo $user_id?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
											<?php
										}
									?>
								</select>
							</div>
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
							</div>
							<label for="categoria" class="col-md-1 control-label">Categoria</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="categoria" name="categoria">
									<option value="1">Libres</option>                                            
									<option value="2">Veteranos</option>
                  <option value="3">Maxi Veterano </option>
									
                                                                         
								</select>
							</div>
						</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Ingrese Jugadores
						</button>
						<button type="submit" class="btn btn-primary" id="guardar_datos">
						  <span class="glyphicon glyphicon-file"></span> Crear 
						</button>
					</div>	
				</div>
			</form>	
			</div>	
		<div id="resultados" class='col-md-12' style="margin-top:10px ;width: 100%;position: "></div><!-- Carga los datos ajax -->			
		</div>
		
		
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/nueva_planilla.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	

  </body>
</html>
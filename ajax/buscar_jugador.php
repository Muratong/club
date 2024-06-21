<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$user_id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from jugadores where ID='".$user_id."'");
		$rw_user=mysqli_fetch_array($query);
		$count=$rw_user['ID'];
		if ($user_id!=1){
			if ($delete1=mysqli_query($con,"DELETE FROM jugadores WHERE ID='".$user_id."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede borrar el jugador administrador. 
			</div>
			<?php
		}
		
		
		
	}
	
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('club','dni','apellido_y_nombre');//Columnas de busqueda
		 $sTable = "jugadores";
		 $sWhere = "";
		
		if ( $_GET['q'] != "")
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by id desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 20; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_paginas = ceil($numrows/$per_page);
		$reload = './jugadores.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					
					<th class='text-tight'>Dni</th>
					<th class='text-tight'>Jugador</th>
					<th class='text-tight'>Año de Nac.</th>
					<th class='text-tight'>Direccion</th>
					<th class='text-tight'>Telefono</th>
					<th class='text-tight'>Documentacion</th>
					<th class='text-tight'>Club</th>
					<th class="text-right">Titulo</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['ID'];
						$dni=$row['DNI'];
						$jugador=$row['APELLIDO_Y_NOMBRE'];
					    $nacimiento=$row['FECHA'];
						$direccion=$row['DIRECCION'];
						$telefono=$row['TELEFONO'];
						$documentacion=$row['DOCUMENTACION'];
					    $club=$row['CLUB'];
						$historial=$row['HISTORIAL_MEDICO'];
					    $correo=$row['CORREO'];
					    $titulo=$row['titulo'];
					    $uni=$row['universidad'];
						
						
					?>
					<input type="hidden" value="<?php echo $row['DNI'];?>" id="dni<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['APELLIDO_Y_NOMBRE'];?>" id="nombre<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['titulo'];?>" id="titulo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['universidad'];?>" id="uni<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['FECHA'];?>" id="fecha<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['DIRECCION'];?>" id="direccion<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['CLUB'];?>" id="club<?php echo $id;?>">

					<input type="hidden" value="<?php echo $row['DOCUMENTACION'];?>" id="documentacion<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['PROVINCIA'];?>" id="provincia<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['OBRA_SOCIAL'];?>" id="social<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['DIRECCION'];?>" id="direccion<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['TELEFONO'];?>" id="telefono<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['CORREO'];?>" id="correo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['HISTORIAL_MEDICO'];?>" id="historial<?php echo $id;?>">
					
					<tr>
					
					<td class='text-tight'><?php echo $dni; ?></td>
					<td class='text-tight'><?php echo $jugador; ?></td>
					<td class='text-tight'><?php echo $nacimiento;?></td>
					<td class='text-tight'><?php echo $direccion;?></td>
					<td class='text-tight'><?php echo $telefono;?></td>
					<td class='text-tight'><?php echo $documentacion;?></td>
					<td class='text-tight'><?php echo $club;?></td>
					<td class="text-right"><?php echo $titulo; ?></td>
						
						<td ><span class="pull-right">
					<a href="#" class='btn btn-primary' title='Editar Jugador' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					
					<a href="#" class='btn btn-danger' title='Borrar Jugador' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
					
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=6><span class="pull-left">
					<?php
					 echo paginate($reload, $page, $total_paginas, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>

<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	/* Conexion de la base de datos*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('PERIODO','Año','Descripcion');//Columnas de busqueda
		 $sTable = "registros";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by CODIGO desc";
		
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 100; //cuántos registros quieres mostrar
		$adjacents  = 4; //espacio entre páginas después del número de adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuente el número total de filas en su tabla*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		
		//consulta principal para obtener los datos
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//recorrer los datos obtenidos
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>ID</th>
					<th>Descripcion</th>
					<th>Monto</th>
					<th>Concepto</th>
					<th>Periodo</th>
					<th>Año</th>
					
					
				</tr>
				<?php
				$sumar_ingresos=0;
				$sumar_egresos=0;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['CODIGO'];
						$descripcion=$row['DESCRIPCION'];
						$monto=$row['MONTO'];
						$concepto=$row['CONCEPTO'];
						$periodo=$row['PERIODO'];
						$Año= $row['AÑO'];
						//$date_added= date('d/m/Y', strtotime($row['FECHA']));
						if ($concepto == 'Ingreso') {
							$sumar_ingresos=$sumar_ingresos + $monto;
						}
						if ($concepto == 'Egreso') {
							$sumar_egresos=$sumar_egresos + $monto;
						}
						$control_registros=$sumar_ingresos - $sumar_egresos;
					?>
					
				
				
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $descripcion ?></td>
						<td>$<?php echo number_format($monto,2);?></td>
						<td ><?php echo $concepto; ?></td>
						<td ><?php echo $periodo; ?></td>
						<td ><?php echo $Año; ?></td>
						
						
					
					</tr>
					<?php
				}
				?>
				
			  </table>
			  
			</div>
			<div class="row container">
					<div class="col-md-3">
						<div class="form-group">
							<label style="font-size:24px" > Total | Ingreso</label>
							<input type="text" value="$<?php echo number_format($sumar_ingresos,2); ?>" disabled="" style="font-size:20px" class="text-center" >
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label style="font-size:24px"> Total | Egreso</label>
							<input type="text" value="$<?php echo number_format($sumar_egresos,2); ?>" disabled="" style="font-size:20px" class="text-center">
						</div>
					</div>	
					<div class="col-md-4">
						<div class="form-group">
							<label style="font-size:24px" > Total | Diferencia</label>
							<input type="text" value="$<?php echo number_format ($control_registros,2); ?>" disabled="" style="font-size:20px" class="text-center">
						</div>
					</div>	
			  </div>
			<?php
		}
	}
?>
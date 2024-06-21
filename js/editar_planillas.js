
		$(document).ready(function(){
			load(1);
			$( "#resultados" ).load( "ajax/editar_planillacion.php" );
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/jugador_planilla.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	function agregar (id)
		{
			
			var camiseta=document.getElementById('camiseta_'+id).value;
			var edad=document.getElementById('edad_'+id).value;
			//Inicia validacion
			if (isNaN(camiseta))
			{
			alert('Esto no es un numero');
			document.getElementById('camiseta_'+id).focus();
			return false;
			}
			if (isNaN(edad))
			{
			alert('Esto no es un numero');
			document.getElementById('edad_'+id).focus();
			return false;
			}
			
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/editar_planillacion.php",
        data: "id="+id+"&camiseta="+camiseta+"&edad="+edad,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/editar_planillacion.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}

		$("#datos_planilla").submit(function(event){
		  var id_planilla = $("#id_planilla").val();
	  
		  if (id_planilla==""){
			  alert("Debes seleccionar un planilla");
			  $("#club").focus();
			  return false;
		  }
			var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/editar_planilla.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".editar_planilla").html("Mensaje: Cargando...");
					  },
					success: function(datos){
						$(".editar_planilla").html(datos);
					}
			});
			
			 event.preventDefault();
	 	});
		
		// $("#datos_planilla").submit(function(){
		//   var club = $("#club").val();
		//   var user_id = $("#user_id").val();
		//   var categoria = $("#categoria").val();
		//   var torneo = $("#torneo").val();
		//    var id_planilla = $("#id_planilla").val();
		  
		  
		//  VentanaCentrada('./pdf/documentos/ver_planillas_pdf.php?club='+club+'&user_id='+user_id+'&categoria='+categoria+'&torneo='+torneo+'&id_planilla='+id_planilla,'Planilla','','1024','768','true');
	 // 	});
		function imprimir_factura(id_planilla){
			VentanaCentrada('./pdf/documentos/ver_planillas.php?id_planilla='+id_planilla,'Planilla','','1024','768','true');
		}

	$(document).ready(function() {
		
		
    });
		
	$("input.numbers").keypress(function(event) {
			//if (String.fromCharCode(event.keyCode).match(/[^0-9]/g)) return false; work only integer
			//if (String.fromCharCode(event.keyCode).match(/^[0-9.,]+$/)) { work integer and decimal
			if (String.fromCharCode(event.keyCode).match(/^[0-9.,]+$/)) {
				return true;
			} else {
				return false;
			}
		});
		
		$("input.intnumbers").keypress(function(event) {
			if (String.fromCharCode(event.keyCode).match(/[^0-9]/g)) return false;
		});
		
	});

	//Se guarda el documento a la tabla tmp (Temporal)
	function agregar (id) 	{
			var cantidad = $("#cantidad_"+id).val();
			var precio_venta = $("#precio_venta_"+id).val();
			var dato_adicional = $("#dato_adicional_"+id).val();
		
			n_c = n_c.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
		
			//Inicia validacion
			if (isNaN(cantidad)) {
				window.alert('Dato cantidad tiene que ser númerico!');
				document.getElementById('cantidad_'+id).focus();
				return false;
			} else if(cantidad=="") {
				window.alert('Dato cantidad no puede quedar en blanco!');
				document.getElementById('cantidad_'+id).focus();
				return false;
			}
			
			if (isNaN(precio_venta)) {
				window.alert('Dato precio venta tiene que ser númerico!');
				document.getElementById('precio_venta_'+id).focus();
				return false;
			} else if(precio_venta=="") {
				window.alert('Dato precio venta no puede quedar en blanco!');
				document.getElementById('precio_venta_'+id).focus();
				return false;
			}
			//Fin validacion
			
			$.ajax({
				type: "POST",
				url: "./ajax/agregar_facturacion.php",
				data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad+"&dato_adicional="+dato_adicional,
				 beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$("#resultados").html(datos);
				}
			});
	}
		

	function eliminar (id) 	{
			
		$.ajax({
			type: "GET",
			url: "./ajax/agregar_facturacion.php",
			data: "id="+id,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			}
		});

	}

	function update_detalle_tmp (id) {
		
		var modo = 1;
		
		var n_c = $("#cantidad_tmp_"+id).val();
		var d_a = $("#dato_adicional_"+id).val();
		var n_p = $("#precio_tmp_"+id).val();
		
		if (isNaN(n_c)) {
			window.alert('Dato cantidad tiene que ser númerico!');
			$("#cantidad_tmp_"+id).focus();
			return false;
		} else if(n_c=="") {
			window.alert('Dato cantidad no puede quedar en blanco!');
			$("#cantidad_tmp_"+id).focus();
			return false;
		}
		
		if (isNaN(n_p)) {
			window.alert('Dato precio venta tiene que ser númerico!');
			$("#precio_tmp_"+id).focus();
			return false;
		} else if(n_p=="") {
			window.alert('Dato precio venta no puede quedar en blanco!');
			$("#precio_tmp_"+id).focus();
			return false;
		}
		
		$.ajax({
			type: "GET",
			url: "./ajax/agregar_facturacion.php",
			data: "id="+id+"&modo="+modo+"&d_a="+d_a+"&n_c="+n_c+"&n_p="+n_p,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			}
		});
	}

	function add_del_tax (id) 	{
		var add_del_tax=1;
		
		$.ajax({
			type: "POST",
			url: "./ajax/agregar_facturacion.php",
			data: "id="+id+"&add_del_tax="+add_del_tax,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			}
		});

	}
		
	//Se guarda el documento a la tabla facturas y se pasa a la generación del pdf
	$("#datos_factura").submit(function(){
		  var tipo_doc = $("#tipo_doc").val();
		  var name_doc;
		  
		  if (tipo_doc==1) {
			  name_doc="Venta";
		  } else {
			  name_doc="Cotización";
		  }
		  
		  var id_cliente = $("#id_cliente").val();
		  var name_cliente = $("#nombre_cliente").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  
		  if (id_cliente=="" )  {
			  if (name_cliente !== null ) {
					alert("Cliente no seleccionado del catálogo, se tomará como cliente foraneo");
					id_cliente=0;
					var datoc1 = $("#nombre_cliente").val();
					var datoc2 = $("#tel1").val();
					var datoc3 = $("#mail").val();
			  } else {
					alert("Se debe seleccionar un cliente");
					$("#nombre_cliente").focus();
					return false;				 
			  }
			} else {
				var datoc1 = "";
				var datoc2 = "";
				var datoc3 = "";
			}
			  
		 VentanaCentrada('./pdf/documentos/documento_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor
		 +'&condiciones='+condiciones+'&tipo_doc='+tipo_doc+'&datoc1='+datoc1+'&datoc2='+datoc2+'&datoc3='+datoc3,
		 name_doc, '', '1024', '768', 'true');
	});
	
	
	$( "#guardar_proveedor" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var param = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_proveedor.php",
					data: param,
					beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
	})
	
	
	$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
	})

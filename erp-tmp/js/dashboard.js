$(document).ready(function(){
		load(1);
	});

	var agreterm=false;
	
	function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_dashboard.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	
		
	function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar el usuario")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_dashboard.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}
	
	
	//Descargar la factura de la lista de documentos principal
	function _print_cards(id_user, nhra, nsaldo, nMedida, nPrecPr, nPrintP) {
		//alert("id_user:"+id_user+",nhra:"+nhra+",saldo:"+nsaldo+",nMedidas: "+nMedida+",nPrecPr:"+nPrecPr+", nPrintP:"+nPrintP);
		if (nsaldo==0) {
			alert("Aviso, no tiene fichas activadas para imprimir!");
			exit
		}	
		VentanaCentrada('./pdf/documentos/ver_documento_pdf.php?id_user='+id_user+'&nhra='+nhra+'&nMedida='+nMedida+'&nPrecPr='+nPrecPr+'&nPrintP='+nPrintP, 'Documento', '', '1024', '768', 'true');
	}


	function print_cards(id_user, nhra, nsaldo, nMedida, nPrecPr, nPrintP) {
		
		//alert("id_user:"+id_user+",nhra:"+nhra+",saldo:"+nsaldo+",nMedidas: "+nMedida+",nPrecPr:"+nPrecPr+", nPrintP:"+nPrintP);
		
		if (nsaldo==0) {
			alert("Aviso, no tiene fichas activadas para imprimir!");
			return false;
		}
		
		// Define the Dialog and its properties.
		agreterm=false;
		$("#dialog-confirm").dialog({
				resizable: false,
				modal: true,
				title: "Politica de Aceptación",
				open: function(event, ui) {
					$(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
				},
				height: 550,
				width: 600,
				closeOnEscape: true,
				create: function (e, ui) {
					var pane = $(this).dialog("widget").find(".ui-dialog-buttonpane")
					$("<label class='shut-up' ><input type='checkbox' />Aceptar terminos</label>").prependTo(pane)
				},
				buttons: {
					"Aceptar": function () {
						//alert( "agreterm:"+agreterm );
						if (agreterm) {
							
							VentanaCentrada('./pdf/documentos/ver_documento_pdf.php?id_user='+id_user+'&nhra='+nhra+'&nMedida='+nMedida+'&nPrecPr='+nPrecPr+'&nPrintP='+nPrintP, 'Documento', '', '1024', '768', 'true');
							
							$(this).dialog('close');
							return callback(true);

						}
					},
						"No Aceptar": function () {
						$(this).dialog('close');
						return callback(false);
					}
				}
			});
	}



	function fnOpenNormalDialog( id_user, nhra, nsaldo, nPrecPr, print_pf ) {
	
		//alert("id_user:"+id_user+", nhra:"+nhra+", saldo:"+nsaldo+", nPrecPr:"+nPrecPr+", print_pf:"+print_pf);
		//return false;
		
		if (nsaldo==0) {
			alert("Aviso, no tiene fichas activadas para imprimir!");
			return false;
		}
		
		// Define the Dialog and its properties.
		agreterm=false;
		$("#dialog-confirm").dialog({
				resizable: false,
				modal: true,
				title: "Aceptar los términos",
				open: function(event, ui) {
					$(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
				},
				height: 550,
				width: 600,
				closeOnEscape: true,
				create: function (e, ui) {
					var pane = $(this).dialog("widget").find(".ui-dialog-buttonpane")
					$("<label class='shut-up' ><input type='checkbox' />Aceptar terminos</label>").prependTo(pane)
				},
				buttons: {
					"Aceptar": function () {
						//alert( "agreterm:"+agreterm );
						if (agreterm) {
							
							var q= $("#q").val();
							var page='./reportes/rpt_fichas.php?id_user='+id_user+'&nhra='+nhra+'&nsaldo='+nsaldo+'&nPrecPr='+nPrecPr+'&print_pf='+print_pf;

							$("#loader").fadeIn('slow');
							$.ajax({
								url: page,
								type: "POST",
								datatype: "json",
								beforeSend: function(objeto) {
								$('#loader').html('<img src="./img/ajax-loader.gif"> Enviando por correo...');
							  },
								success:function(data) {
									$('#loader').html('');
									var opResult = JSON.parse(data);
									//alert("sam: "+opResult.sam);
									window.location = opResult.url;
									//alert("well: "+opResult.status);
								},
								error: function (jqXHR, textStatus, errorThrown) {
									alert('Error: '+textStatus+", "+errorThrown);
								}
							})
							
							$(this).dialog('close');
							return callback(true);

						}
					},
						"No Aceptar": function () {
						$(this).dialog('close');
						return callback(false);
					}
				}
			});
	}

	
	$(document).on("change", ".shut-up input", function () {
		agreterm=this.checked;
	})

	function callback(value) {
		$('.shut-up input').attr('checked', false);
		if (value) {
			load(1);
		} else {
			//alert("Rejected");
		}
	}
	
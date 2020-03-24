<style>
	.back-to-top {
		position: fixed;
		bottom: 4em;
		right: 0px;
		text-decoration: none;
		color: #000000;
		background-color: rgba(210, 30, 44, 0.9);
		font-size: 12px;
		padding: 1em;
		display: none;
		}
	.back-to-top:hover {    
		background-color: rgba(9, 216, 60, 0.8);
		}
	.ui-autocomplete.ui-widget {
		  font-family: Verdana,Arial,sans-serif;
		  font-size: 10px;
		  width: 500px;
		  z-index:100;
	}
	
	.category-select label {
    float: left;
    margin: 1px;
}
		
</style>
	
<?php
	
	/*-------------------------
	Autor: Elio Mojica
	Web: maximcode.com
	Mail: admin@maximcode.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
    }
	
	$active_facturas="";
	$active_compras="active";
	$active_clientes="";
	$active_usuarios="";
	$title="Nueva consulta | Maxim Card";

	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
	header("Pragma: no-cache"); // HTTP 1.0.
	header("Expires: 0"); // Proxies.

	//* Connect To Database
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	//* Get data tables as id user
	$tot_1hora=0;$tot_2hora=0;$tot_3hora=0;$tot_4hora=0;$tot_5hora=0;$tot_6hora=0;

	//date_default_timezone_set('America/Mexico_city');
	//echo date_default_timezone_get();

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
	  
    <div class="container-fluid">
	<div class="panel panel-primary">
		<a href="#" class="back-to-top">Volver arriba</a>
		<div class="panel-heading">
			<button type="button" class="btn btn-success pull-right" id="return_doc" onclick="freturn_doc();">
				  <span class="glyphicon glyphicon-list-alt"></span> Regresar...
			</button>
			<h4><i class='glyphicon glyphicon-edit'></i> Nueva Consulta</h4>
		</div>
		<div class="panel-body">
		<?php 
			//include("modal/buscar_productos.php");
			//include("modal/registro_proveedores.php");
			//include("modal/registro_productos.php");
		?>
			<form class="form-horizontal" role="form" id="datos_nueva_consulta">
					
					<div class="form-group">
					  	<label for="comuni" class="col-md-1 control-label">Comunidad:</label>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" id="nombre_comuni" name="nombre_comuni" required>
							<input type='hidden' id="id_comuni" name="id_comuni" >
						</div>
						<label for="usersfromcomuni" class="col-md-1 control-label">Usuarios:</label>
						<div class="col-md-4">
							<select class='form-control input-sm' id="user_comuni" name="user_comuni">
							</select>
						</div>
					</div>
					
					<div class="panel panel-info">
						<div class="panel-heading">DATOS DEL USUARIO
							<div class="form-group">
								<div class="col-sm-2" >
								 <label for="comuni" class="control-label">Nombre:</label>
								  <input type="text" class="form-control input-sm" id="firstname" name="firstname" disabled >
								</div>
								<div class="col-sm-3" >
								<label for="comuni" class="control-label">Apellidos:</label>  
								  <input type="text" class="form-control input-sm" id="lastname" name="lastname" disabled >
								</div>
								<div class="col-sm-3" >
								<label for="comuni" class="control-label">Whatsap:</label>  
								  <input type="text" class="form-control input-sm" id="user_whatsap" name="user_whatsap" disabled >
								</div>
								<div class="col-sm-3" >
								<label for="comuni" class="control-label">Facebook:</label>  
								  <input type="text" class="form-control input-sm" id="user_facebook" name="user_facebook" disabled >
								</div>
							</div>
							
							<div class="panel panel-warning">
								<div class="panel-heading">LIMITES... 
									<div class="form-group">
										
										<label for="lbl1" class="radio-inline col-md-1 control-label" >
										<input type="radio" id="lh1" name="limith" checked = "checked" onclick="fchangeopt(1);" >
										1 Hora:</label>
										<div class="col-md-1">
											<input type="text" class="form-control input-sm" id="d1h" name="d1h" value="<?php echo $tot_1hora;?>" disabled >
										</div>

										<label for="lbl2" class="radio-inline col-md-1 control-label" >
										<input type="radio" id="lh2" name="limith" onclick="fchangeopt(2);" >
										2 Horas:</label>
										<div class="col-md-1">
											<input type="text" class="form-control input-sm" id="d2h" name="d2h" value="<?php echo $tot_2hora;?>" disabled >
										</div>

										<label for="lbl3" class="radio-inline col-md-1 control-label" >
										<input type="radio" id="lh3" name="limith" onclick="fchangeopt(3);" >
										3 Horas:</label>
										<div class="col-md-1">
											<input type="text" class="form-control input-sm" id="d3h" name="d3h" value="<?php echo $tot_3hora;?>" disabled >
										</div>
										
										<label for="lbl4" class="radio-inline col-md-1 control-label" >
										<input type="radio" id="lh4" name="limith" onclick="fchangeopt(4);" >
										4 Horas:</label>
										<div class="col-md-1">
											<input type="text" class="form-control input-sm" id="d4h" name="d4h" value="<?php echo $tot_4hora;?>" disabled >
										</div>
										
										<label for="lbl5" class="radio-inline col-md-1 control-label" >
										<input type="radio" id="lh5" name="limith" onclick="fchangeopt(5);" >
										5 Horas:</label>
										<div class="col-md-1">
											<input type="text" class="form-control input-sm" id="d5h" name="d5h" value="<?php echo $tot_5hora;?>" disabled >
										</div>
										
										<label for="lbl6" class="radio-inline col-md-1 control-label" >
										<input type="radio" id="lh6" name="limith" onclick="fchangeopt(6);">
										6 Horas:</label>
										<div class="col-md-1">
											<input type="text" class="form-control input-sm" id="d6h" name="d6h" value="<?php echo $tot_6hora;?>" disabled >
										</div>
										
									</div>
								</div>
							</div>
							
							
						</div>
					</div>
				
				<div class="col-md-12">
					
					<label for="lblnewcant" id="lblnewcant" class="text-inline col-md-1 control-label">1 Hora:</label>
					<div class="col-md-1">
						<input type="number" class="form-control input-sm" id="new_cant" name="new_cant" min="1" max="50" step="1" value="1" >
					</div>
					
					<div class="pull-right">
						<button type="button" class="btn btn-primary" id="add_new_cant" >
						 <span class="glyphicon glyphicon-search"></span> Agregar
						</button>
						<button type="button" class="btn btn-primary" onclick="deleteall('tab_logic');" >
						 <span class="glyphicon glyphicon-search"></span> Eliminar seleccionados
						</button>
						<button type="submit" class="btn btn-primary" >
						 <span class="glyphicon glyphicon-search"></span> Guardar
						</button>
						
						<button type="button" class="btn btn-primary" onclick="pruebas();" >
						 <span class="glyphicon glyphicon-search"></span> Pruebas
						</button>
						
					</div>
				</div>
				
				<div class="container-fluid">
				<div class="row clearfix">
					<div class="col-md-12 column">
						<table class="table table-bordered table-hover" id="tab_logic">
							<tr>
								<th>
									<INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" />
								</th>
								<th>#</th>
								<th>USUARIO</th>
								<th>CONTRASEÑA</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
				
			</form>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
		</div>
		
	</div>		
		  <div class="row-fluid">
			<div class="col-md-12">
			</div>	
		 </div>
	</div>
	<hr>
	<?php
		include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/nueva_consulta.js"></script>
	<link rel="stylesheet" href="js/jquery-ui.css">
	<script src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/cssrefresh.js"></script>
	<script src="js/bootbox.js"></script>
	
	<script>
		//---------------------------------------------------------------------------------------------------- Busqueda por comunidad
		
		var nnidopt=1;	//hrs default
		var cNameUser="";
		var nnIdUser=0;
		
		$(function() {
			$("#nombre_comuni").autocomplete({
				source: "./ajax/autocomplete/comunidad.php",
				minLength: 3,
				select: function(event, ui) {
					event.preventDefault();
					$('#id_comuni').val(ui.item.id_comunidad);
					$('#nombre_comuni').val(ui.item.nombre_comunidad);
				}
			});
		});
					
		$("#nombre_comuni" ).on( "keydown", function( event ) {
				if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP ||  event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE ) {
					$("#id_comuni" ).val("");
				}
				if (event.keyCode==$.ui.keyCode.DELETE) {
					$("#nombre_comuni" ).val("");
					$("#id_comuni" ).val("");
				}
		});
		
		$("#_nombre_comuni").bind('autocompletechange', function(event, ui) {
			//alert(ui.item.id_comunidad);
		});
		
		$('#nombre_comuni').change(function() {
			var idc = $('#id_comuni').val();
			
			$('#user_comuni').html("");
			
			$.getJSON('ajax/autocomplete/user_comunidad.php', {'id_comunidad':idc}, function(data) {
				$("#user_comuni").val(0);
				var options = '';
				
				for (var x = 0; x < data.length; x++) {
				  options += '<option value="' + data[x]['user_id'] + '">' + data[x]['user_name'] + '</option>';
				}
				//$("#user_comuni").append(options);
				$('#user_comuni').html(options);
				$('#user_comuni').load();
				$( "#user_comuni" ).trigger( "click" );
				
			});
		});
		
		$("#_nombre_comuni" ).on( "blur", function( event ) {
		});
		
		//---------------------------------------------------------------------------------------------------- Busqueda UserxComunida
		$('#user_comuni').click(function() {
			var e = document.getElementById("user_comuni");
			var nidUser = e.options[e.selectedIndex].value;
			cNameUser = e.options[e.selectedIndex].text;
			
			cNameUser =  cNameUser.slice(0,1);
			nnIdUser=nidUser;	//Numero usuario id
			
			$.getJSON('ajax/autocomplete/get_user.php', {'idusercom':nidUser}, function(data) {
				var data1 = data[0]['firstname'];
				var data2 = data[0]['lastname'];
				var data3 = data[0]['user_email'];
				var data4 = data[0]['user_whatsap'];
				var data5 = data[0]['user_facebook'];
				$('#firstname').val(data1);
				$('#lastname').val(data2);
				$('#user_email').val(data3);
				$('#user_whatsap').val(data4);
				$('#user_facebook').val(data5);
				
				/*Get data
				alert("id user: "+nidUser);
				$tot_1hora=232;
				$tot_2hora=1231;
				$tot_3hora=676;
				*/
				$.getJSON('ajax/autocomplete/get_hrs_per_user.php', {'idusercom':nidUser}, function(data) {
					$('#d1h').val(data[0]['gethrs1']);
					$('#d2h').val(data[0]['gethrs2']);
					$('#d3h').val(data[0]['gethrs3']);
					$('#d4h').val(data[0]['gethrs4']);
					$('#d5h').val(data[0]['gethrs5']);
					$('#d6h').val(data[0]['gethrs6']);
				});
				
				/*Despues de la selecccion del usuario se busca en la tabla record_cards basado en el users.user_id y record_cards.record_card_user_id los registros basados en record_cards.record_card_num_hora=1hrs,2hrs,etc.
				Si no haya ninguno inicia por ejemplo a001 ubicando primero de una hra por default */
				
			});
		});
		
		function fchangeopt (id) {
			if (id==1) {
				cFlag="Hora: ";
			} else {
				cFlag="Horas: ";
			}
			
			nnidopt = id;
			
			lblnewcant.innerText = id + ' ' + cFlag;
			$("#new_cant").focus();
		}
			
		
		$("#add_new_cant").click(function() {
			 
			//Validar id user seleccionado
			if (nnIdUser==0) {
				window.alert("No se ha seleccionado ningun usuario, ubique la comunidad y el usuario para poder agregar");
				return false;
			}
			
			var new_cant = $("#new_cant").val();
			 
			 if (new_cant<1 || new_cant>50 ) {
				 alert("ficha(s) no pueden ser menor de 1 ni mayor de 50");
				 return false;
			 }
			 
			 var table = document.getElementById('tab_logic');

			 var ngetcount=0;
			 
			if (nnidopt==1) {
				ngetcount = $('#d1h').val();
				if (ngetcount==0) {
					 ngetcount=1;
				 } else {
					 ngetcount++;
				 }
			 } else if(nnidopt==2) {
				 ngetcount = $('#d2h').val();
				if (ngetcount==0) {
					 ngetcount=1;
				 } else {
					 ngetcount++;
				 }
			 } else if(nnidopt==3) {
				 ngetcount = $('#d3h').val();
				if (ngetcount==0) {
					 ngetcount=1;
				 } else {
					 ngetcount++;
				 }
			 } else if(nnidopt==4) {
				 ngetcount = $('#d4h').val();
				if (ngetcount==0) {
					 ngetcount=1;
				 } else {
					 ngetcount++;
				 }
			 } else if(nnidopt==5) {
				 ngetcount = $('#d5h').val();
				if (ngetcount==0) {
					 ngetcount=1;
				 } else {
					 ngetcount++;
				 }
			 } else if(nnidopt==6) {
				 ngetcount = $('#d6h').val();
				if (ngetcount==0) {
					 ngetcount=1;
				 } else {
					 ngetcount++;
				 }	 
			 }
				 
			 var i;
			 for (i=1;i<=new_cant;i++) {
				 var rowCount = table.rows.length;
				 var row = table.insertRow(rowCount);

				 var cell1 = row.insertCell(0);
				 var element1 = document.createElement("input");
				 element1.type = "checkbox";
				 element1.name = "chkbox[]";
				 cell1.appendChild(element1);

				 var cell2 = row.insertCell(1);
				 cell2.innerHTML = rowCount;
				 
				 var cell3 = row.insertCell(2);  // Una Letra usuario y numeracion de registros
				 //cell3.innerHTML = "e"+ngetcount;
				 cell3.innerHTML = cNameUser + padDigits(ngetcount, 3);
				 ngetcount++;
				 
				 var cell4 = row.insertCell(3);	// Se genera pasw
				 cell4.innerHTML = fgetrandom();

				 var cell5 = row.insertCell(4);
				 cell5.innerHTML = "<td> <button name='dele"+i+"' class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick='fDelete("+rowCount+");' ></button> </td>"
			 }
		 });
		
		function padDigits(number, digits) {
			return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
		}
		
		function fgetrandom() {
			var val = Math.floor(1000 + Math.random() * 9000);
			return val;
		}
		
		function deleteall(tableID) {
		 try {
			 var table = document.getElementById(tableID);
			 var rowCount = table.rows.length;
			 
			 if (rowCount==1) {
				 window.alert("No existen elementos seleccionados");
				 return false;
			 }

			 for (var i = 1; i < rowCount; i++) {
				 var row = table.rows[i];
				 var chkbox = row.cells[0].childNodes[0];
				 if (null != chkbox && true == chkbox.checked) {
					 table.deleteRow(i);
					 rowCount--;
					 i--;
				 }
			 }
			 } catch (e) {
				 alert(e);
			 }
			 
			 for (var i = 1; i <rowCount; i++) {
				 table.rows[i].cells["1"].innerHTML = i;
				 table.rows[i].cells["4"].innerHTML = "<td> <button name='dele"+i+"' class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick='fDelete("+(i)+");' ></button> </td>"
			}
			 
		}
		
		function fDelete (id) {
			var table = document.getElementById('tab_logic');
			table.deleteRow(id);
			
			//2 paso renumerar
			//var table = document.getElementById('tab_logic');
			var rowCount = table.rows.length;
			//window.alert("rowCount:"+rowCount);
			for (var i = 1; i <rowCount; i++) {
				 //window.alert("i:"+i);
				 table.rows[i].cells["1"].innerHTML = i;
				 table.rows[i].cells["4"].innerHTML = "<td> <button name='dele"+i+"' class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick='fDelete("+(i)+");' ></button> </td>"
			}
		}

		
		function checkAll(ele) {
			 var checkboxes = document.getElementsByTagName('input');
			 if (ele.checked) {
				 for (var i = 0; i < checkboxes.length; i++) {
					 if (checkboxes[i].type == 'checkbox') {
						 checkboxes[i].checked = true;
					 }
				 }
			 } else {
				 for (var i = 0; i < checkboxes.length; i++) {
					 console.log(i)
					 if (checkboxes[i].type == 'checkbox') {
						 checkboxes[i].checked = false;
					 }
				 }
			 }
		 }
		
		
		$(".table").on('click', 'tr', function () {
		var trValue = $(this).attr('value');
		var tdValue = $(this).children('td').map(function (index, val) {
				return $(this).text();
			}).toArray();
		// all td value with comma seprated
		//alert(tdValue);
		// current tr attr value
		//alert(trValue);
		});
		
		//******* OJO http://jsfiddle.net/praveen_jegan/7Dqqf/82/
		
		
		//---------------------------------------------------------------------------------------------------------------------Submit
		
		//Se guarda el documento a la tabla facturas y se pasa a la generación del pdf______________________________________
		$("#datos_nueva_consulta").submit(function(event) {
		
		  event.preventDefault();
		
		  //var id_cliente = $("#id_cliente").val();
			
		  bootbox.confirm("Seguro de guardar los datos ?.", function (confirmed) {
			  
			  var table = document.getElementById('tab_logic');
			  var rowCount = table.rows.length;
			  
			  var nperhrs=$('#d'+nnidopt+'h').val();
			  
			  nperhrs = parseInt(nperhrs, 10);
			  var ncountrow = parseInt(rowCount, 10)-1;
			  
			  var nsumresult = nperhrs + ncountrow;
			  
			  //alert("nsumresult: "+nsumresult);
			  //alert("nperhrs: "+nperhrs+",rowCount: "+rowCount);
		  
			  if (confirmed) {
  				
				for (var i = 1; i <rowCount; i++) {
					
					var cCardUser=table.rows[i].cells["2"].innerHTML;
					var cPaswUser=table.rows[i].cells["3"].innerHTML;
					
					var aparam={'id_user':nnIdUser,'num_hra':nnidopt,'card_user':cCardUser,'pasw_user':cPaswUser};
		  			var jsonString = JSON.stringify(aparam);
				  
					$.ajax({
							type: "POST",
							url:'ajax/save_new_records.php',
							data: {'data' : jsonString},
							cache: false,
							dataType: "JSON",
							beforeSend: function(objeto) {
							},
								success:function(data) {
									//alert("Success: "+data[0]['status']);
									//$("#tab_logic tr").remove();
									autodeleteall();
									
									/* Por cada insert se actualiza la leyenda solo de la hora seleccionada */
									//$.getJSON('ajax/autocomplete/get_only_hrs_per_user.php', {'idusercom':nnIdUser,'nnidopt':nnidopt}, function(data) {
										//alert("="+data[0]['gethrsel']);
										//$('#d1h').val(data[0]['gethrsel']);
									//});
									
									$('#d'+nnidopt+'h').val(nsumresult);
									
							},
								error: function(data) {
									//var returnedData = JSON.parse(data);
									//alert("Return error:"+returnedData.status);
									alert("Error: "+data[0]['status']);
							}
						})
					//Reset del form de la nueva factura despues de la impresion
					//$('#datos_factura').get(0).reset();
				}
			  }
			  
		});
			
	});
	
	function autodeleteall() {
		 try {
			 var table = document.getElementById('tab_logic');
			 var rowCount = table.rows.length;

			 for (var i = 1; i < rowCount; i++) {
				 table.deleteRow(i);
				 rowCount--;
				 i--;
			 }
			 } catch (e) {
				 alert(e);
			 }
			 
			 for (var i = 1; i <rowCount; i++) {
				 table.rows[i].cells["1"].innerHTML = i;
				 table.rows[i].cells["4"].innerHTML = "<td> <button name='dele"+i+"' class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick='fDelete("+(i)+");' ></button> </td>"
			}
			 
		}
		
	function pruebas() {
		var table = document.getElementById('tab_logic');
	  	var rowCount = table.rows.length;
			  
		for (var i = 1; i <rowCount; i++) {
		  	alert( "=" + table.rows[i].cells["3"].innerHTML );
		}
			  
		return false;
	}

	</script>

  </body>
</html>

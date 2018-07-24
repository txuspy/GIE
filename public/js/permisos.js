$(document).ready(function(){
	function ocultarDiv(){
		$("#msj-insert").hide();  // Mensaje escrito para poder traducir en view
		$("#msj-deleted").hide(); // Mensaje escrito para poder traducir en view
		$("#msj-error").hide();   // div para meter mensajes personalizados
	}
	function Mostrar(btn){
		var URL_BASE_DEFAULT = $("#URL_BASE_DEFAULT").val();
		var route = "http://localhost:8000/genero/"+btn.value+"/edit";

		$.get(route, function(res){
			$("#genre").val(res.genre);
			$("#id").val(res.id);
		});
	}
	$('#crearPermiso').click(function(){
		ocultarDiv();
		var name = $("#name").val();
		var display_name = $("#display_name").val();
		var description = $("#description").val();
		var URL_BASE_DEFAULT = $("#URL_BASE_DEFAULT").val();
		var route = URL_BASE_DEFAULT + "/permisos/store";
		var token =$("#token").val();
		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data:{
				name: name,
				display_name: display_name,
				description: description,
			},
			success:function(msj){
				$("#msj-insert").fadeIn();
				$("#datos tr:first").after("<tr id='linea"+msj.id+"'><td> <input type='checkbox' name='id_permiso' value='"+msj.id+"' /> "+name+"</td><td>"+display_name+"</td><td>"+description+"</td><td><a href='/permisos/"+msj.id+"/edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td></tr>");
				$("#name").val("");
				$("#display_name").val("");
				$("#description").val("");
				$("#name").focus();
			},
			error:function(msj){
				var errors = msj.responseJSON;
				var errorsHtml = '<p>ERROR INSERT</p><ul>';
		        	$.each( errors , function( key, value ) {
		            	errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
		        	});
		        errorsHtml += '</ul>';
		        $("#msj-error").html(errorsHtml);
				$("#msj-error").fadeIn();
			}
		});
	});
	$(".editarPermiso").keyup(function(){
		ocultarDiv();
		var valorCampo = $(this).val();
		var nombreCampo = $(this).attr("nombreCampo");
		var valorId    =$(this).attr("valorId");
		var token =$(this).attr("token");
		console.log("campo:"+valorCampo+"\nid:"+valorId+"\ntoken:"+token);
		var URL_BASE_DEFAULT = $("#URL_BASE_DEFAULT").val();
		var route = URL_BASE_DEFAULT + "/permisos/"+valorId;
		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'PUT',
			dataType: 'json',
			data:{
				valorCampo : valorCampo,
				nombreCampo: nombreCampo,
				valorId    : valorId,
				token      : token,
			},
			success:function(msj){
				//$("#msj-success").fadeIn();
			},
			error:function(msj){
				$("#msj-error").html("ERROR UPDATE");
				$("#msj-error").fadeIn();
			}
		});
	});
	$('#borrarPermisos').click(function(){
		ocultarDiv();
		$('input:checkbox:checked').each(function() {
			var id = $(this).val() ;
			console.log( "Borramos valor: "+$(this).val() );
			var URL_BASE_DEFAULT = $("#URL_BASE_DEFAULT").val();
			var route = URL_BASE_DEFAULT + "/permisos/"+id;
			var token =$("#token").val();
			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'DELETE',
				dataType: 'json',
				data:{
					id: id,
				},
				success:function(){
					$("#msj-deleted").show();
					$('#linea'+id).remove();
				},
				error:function(msj){
					$("#msj-error").html("ERROR DELETE");
					$("#msj-error").fadeIn();
				}
			});
		});
	});
});
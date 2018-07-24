 $( document ).ready(function() {
	console.log( "public/js/filesImgScript.js ready!" );
	console.log( "--> Esto es para File e Imagenes" );
	function ocultarDiv(){
		$( "#msj-ok" ).hide();
		$( "#loading" ).hide();
		$( "#msj-error" ).hide();
	}

	$( ".upload" ).click(function() {
		console.log( "Upload click !" ) ;
		ocultarDiv();
		var id = $( this).attr("attrId")  ;
		var tipo = $ ( this ).attr("tipo") ;
		var accion = $ ( this ).attr("tipoArchivo") ;
		$( "#attrId" ).val(id) ;
		$( "#tipo" ).val(tipo) ;
		$( "#tipoArchivo" ).val(accion) ;
		console.log("set valores");
		$( "#dialog" ).modal('show');
		$("#datosFormulario").show();
	});
	//progress bar al subir archivo
	$('#upload').click(function(e){
	   console.log("click en upload");
	   ocultarDiv();
	   var cont = $("#cuantosArchivos").val()  ;
	   var formData = $( this ).serializeArray();
	   var formData = new FormData();
	   formData.append('tipo', $('#tipo').val());
	   formData.append('attrId', $('#attrId').val());
	   formData.append('tipoArchivo', $('#tipoArchivo').val());
	   formData.append('cuantosArchivos', $('#cuantosArchivos').val());
	   for (var i = 1; i <= cont ; i++) {
			var nombreArchivo = "#archivo"+i+"" ;
			console.log('nombre archivo: '+ nombreArchivo);
			formData.append("archivo"+i , $( "#archivo"+i )[0].files[0]);
	   };
	   var token =$("#token").val();
	   var URL_BASE_DEFAULT = $("#URL_BASE_DEFAULT").val();
	   var route = URL_BASE_DEFAULT + "/file-upload";
	   var route = "/file-upload";
	   $.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function() {
				console.log("procesando");
				$("#datosFormulario").hide();
				$('.progress-bar').width(0); //inicio
				$("#loading").show();
			},
			/* progress bar */
			xhr: function () {
               var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.onprogress = function (e) {
                    if (e.lengthComputable) {
                        var progreso = parseInt((e.loaded / e.total) * 100);
                        var strProgreso = progreso + "%";
                        $('.progress-bar').css('width', progreso + '%');
                        $('.percent').html(strProgreso);
                    } else {
                        console.log('No soporta lengthComputable en upload');
                    }
                };
                //Donwload progress
                xhr.onprogress = function (e) {
                    if (e.lengthComputable) {
                        var progreso = parseInt((e.loaded / e.totalSize) * 100);
                        var strProgreso = progreso + "%";
                        $('.progress-bar').css('width', progreso + '%');
                        $('.percent').html(strProgreso);
                    } else {
                        console.log('No soporta lengthComputable en download');
                    }
                };
                        return xhr;
           },
			success:function(msj){
				console.log("Ok, upload \n"+msj);
				$( "#msj-ok" ).html( "<div class='paragraphs'><div class='row'><div class='span4'><div class='clearfix content-heading'>"+msj+"</div></div></div>" );
				$( "#msj-ok" ).show();
				$( "#loading" ).hide();
				$( "#dialog" ).modal('hide');
			},
			error:function(msj){
				console.log("error, upload");
				console.log('Respuesta ERROR %O', msj);
				$( "#msj-error" ).html("ERROR UPLOADED\n");
				$( "#msj-error" ).fadeIn();
				$( "#loading" ).hide();
				$( "#dialog" ).modal('hide');
			}
		});
	});
 	$( "#addFile" ).click(function(e) {
		console.log ( "añadir campo input");
		e.preventDefault();
		var cont = $("#cuantosArchivos").val()  ;
		cont++;
		$( "#cuantosArchivos" ).val(cont) ;
		console.log("valor de cont: "+cont);

		$("#datosFormulario").append('<div class="clearfix"></div><div  class="form-group"><label for="archivo'+cont+'" class="col-lg-3 control-label">Nombre '+cont+': </label><input id="archivo'+cont+'" class="filestyle" data-icon="false" data-buttonName="btn-primary" placeholder="Examina" name="archivo'+cont+'" type="file"></div>');
		$('#archivo'+cont).filestyle({
				icon : false
		});
	});

	$('.delete_field').click(function(e){
		console.log("click en delete ");
	   	ocultarDiv();
	    var attrId      = $ ( this ).attr("attrId")  ;
	    var tipo        = $ ( this ).attr("tipo") ;
	    var tipoArchivo = $ ( this ).attr("tipoArchivo") ;
	    var idFile      = $ ( this ).attr("idFile") ;
	    var nomFile     = $ ( this ).attr("nomFile") ;
	    var tamanoFile     = $ ( this ).attr("tamanoFile") ;
	    var token = $('meta[name="csrf-token"]').attr('content');
	    console.log("attrId: "+attrId);
	    console.log("tipo: "+tipo);
	    console.log("tipoArchivo: "+tipoArchivo);
	    console.log("idFile: "+idFile);
	    console.log("nomFile: "+nomFile);
	    console.log("tamanoFile: "+tamanoFile);
	    console.log("token: "+$('meta[name="csrf-token"]').attr('content'));
	//	var token =$("#token").val();
		var route = "/file-delete/"+idFile;
	 	$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			// dataType: 'json',
			data:{
				attrId: attrId,
				tipo: tipo,
				tipoArchivo: tipoArchivo,
				idFile: idFile,
				nomFile: nomFile,
				tamanoFile: tamanoFile
			},
			beforeSend: function() {
				ocultarDiv();
				console.log("procesando");
				$("#loading").show();
			},
			success:function(msj){
				// habria que limpiar la img por id que tiene q ser igual a su id imagen
				ocultarDiv();
				$("#"+idFile).fadeOut();
				$( "#msj-ok" ).html( "<div class='paragraphs'><div class='row'><div class='span4'> <div class='clearfix content-heading'>DELETED"+msj+"</div></div></div>" );
				$( "#msj-ok" ).show();
			},
			error:function(msj){
				ocultarDiv();
				var errors = msj;
				console.log("ERROR BORRANDO");
				console.log(msj);
			//	console.log(JSON.stringify(msj.responseJSON));
				var errorsHtml = '<p>ERROR BORRANDO</p>'+errors;
				$("#"+idFile).fadeOut();
		        $("#msj-error").html(errorsHtml+msj);
				$("#msj-error").fadeIn();
			}
		});
	});


});

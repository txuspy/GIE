console.log("public/js/autocomplementar.js cargado!")
$(document).on('click',  '.desenlazar', function(){
    var config = {
        id        : $(this).attr('data-id') ,
        id_autor  : $(this).attr('data-idAutor') ,
        carpeta   : $(this).attr('data-carpeta') ,
        tipo      : $(this).attr('data-tipo') ,
    };
    var objeto = $(this);
    var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/"+config.tipo+"/detach/"+config.id+"/"+config.carpeta+"/"+config.id_autor ,
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            beforeSend: function () { console.log("procesando datos detach..."); },
            success: function (data) {
                console.log("datos procesados detach OK");
                objeto.parent().remove();
            },
            error: function (data) { console.log("ERROR: procesados detach ERROR"+data); }
        });

});
$(document).ready(function () {




    console.log("public/js/autocomplementar.js ready!")
    $(".buscadorDeAutor").autocomplete({
        source: "/autor/autocompletar",
        minLength: 3,
        select: function (event, ui) {
            console.log( "Selected: " + ui.item.value + " id " + ui.item.id );
            $(this).next().val(ui.item.nombre);
            $("#id_autor").val(ui.item.id);
            $(this).next().trigger('keyup');
        }
    });
     $(".buscadorDeAutor2").autocomplete({
        source: "/autor/autocompletar",
        minLength: 3,
        select: function (event, ui) {
            console.log( "Selected: " + ui.item.value + " id " + ui.item.id );
            $(this).next().val(ui.item.nombre);
            $("#id_autor2").val(ui.item.id);
            $(this).next().trigger('keyup');
        }
    });
    if($(".buscadorAutor")[0]){
        $(".buscadorAutor").autocomplete({
            source: "/autor/autocompletar",
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                   var config ={
                        id       : $(this).attr('data-id') ,
                        id_autor : ui.item.id,
                        carpeta  : $(this).attr('data-carpeta') ,
                        tipo     : $(this).attr('data-tipo') ,
                        idUl     : $(this).attr('data-idUl')
                    };
                    var idnuevo = enlazar( config );
                    $("#"+$(this).attr('data-idUl')).append('<li class="list-group-item"><a data-id="'+config.id+'" data-idautor="'+config.id_autor+'" data-carpeta="'+config.carpeta+'" data-tipo="'+config.tipo+'" class="desenlazar"><i class="fa fa-trash deleteRelation"></i> </a>'+ui.item.value+'</li>');
                    $(this).val('');
                    $(this).focus();
                    return false;
                }
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        	return $( "<li></li>" )
        		.data( "item.autocomplete", item )
        		.append( "<i class='fa fa-info-circle' title ='Enter edo izenean gainean sakatu erlazioa sortzeko/Pulsa Enter o click para crear una nueva relación.\nTab sakatu datu berria sortzeko/Pulsa Tab para crear registro nuevo.'></i> "+item.label )
        		.appendTo( ul );
        }
    }

    $(".buscadorAutor").focus(function() {
        $(".autorInfo").html('');
        $(".autorInfo").append( "<i class='fa fa-info-circle mostrarCursor' title ='Enter edo izenean gainean sakatu erlazioa sortzeko/Pulsa Enter o click para crear una nueva relación.\nTab sakatu datu berria sortzeko/Pulsa Tab para crear registro nuevo.'></i> " );
    });

    $(".buscadorAutor").keydown(function (e) {
        //if ( (e.which == 9) || (e.which == 13) ){ //(e.which == 13) ENTER ; e.which == 9 TAB
        if ( (e.which == 9) ){ //(e.which == 13) ENTER ; e.which == 9 TAB
            var stringOriginal = $(this).val().trim();
            var string         = stringOriginal.split(' ');
            var apellidoDialog = '';
            var config ={
                id       : $(this).attr('data-id') ,
                carpeta  : $(this).attr('data-carpeta') ,
                tipo     : $(this).attr('data-tipo') ,
                idUl     : $(this).attr('data-idUl')
            };
            console.log(config);
            for(var i = 0; i < string.length; i++){
                if(i==0){
                    var nombreDialog = string[i];
                }else{
                    apellidoDialog+=string[i]+" ";
                }
            }
            console.log("nombraDialog: "+nombreDialog+", apellidoDialog: "+apellidoDialog+",data-idDialog: "+$(this).attr('data-idDialog'));
            var idDialog =$(this).attr('data-idDialog');
            $( "#"+idDialog ).dialog({
                height: 'auto',
                width: 300,
                resizable: false,
                buttons: {
                    "Crear":  function(){
                        insertAutor( idDialog, config );
                        $(this).dialog('close');
                    },
                    "Cerrar": function(){
                       $(this).dialog('close');
                    }
                }
            });
            $(".nombreDialog").val(nombreDialog.trim() );
            $(".apellidoDialog").val(apellidoDialog.trim());
            $(this).val('');
            $(this).focus();
        }
    });
    function enlazar(config){
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/"+config.tipo+"/"+config.id+"/"+config.carpeta+"/"+config.id_autor ,
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            beforeSend: function () { console.log("procesando datos..."); },
            success: function (data) {
                console.log("Enlazado OK");
                console.log(data);

            },
            error: function (data) { console.log("ERROR enlazando "+data); }
        });
    }
    function insertAutor(idDialog, config) {
        var token = $('meta[name="csrf-token"]').attr('content');
        var data  = $('#form'+idDialog).serialize();
        $.ajax({
            url: "/autor/insertAjax",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            data: data,
            beforeSend: function () { console.log("procesando datos...");  },
            success: function (data) {
                console.log("Insertando datos OK");
                config.id_autor = data.id;
                enlazar(config);
                $("#"+config.idUl).append('<li class="list-group-item"><a data-id="'+config.id+'" data-idautor="'+config.id_autor+'" data-carpeta="'+config.carpeta+'" data-tipo="'+config.tipo+'" class="desenlazar"><i class="fa fa-trash deleteRelation"></i> </a>'+data.nombre+' '+data.apellido+'</li>');
            },
            error: function (data) { console.log("ERROR insertando datos "+data); }
        });
    }
    // TITULOS de las cosas
    // Grupo de Investigacion
    $(".buscadorGrupoInvestigacion" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        $(this).autocomplete({
            source: "/grupoInvestigacion/autocompletar/"+name,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                    $(this).attr('data-id')
                    console.log("redirigir");
                    var url = "/grupoInvestigacion/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });
    // Grupo de Investigacion
    $(".buscadorTesisDoctorales" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        $(this).autocomplete({
            source: "/tesisDoctorales/autocompletar/"+name,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                    console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/tesisDoctorales/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });
    // Visitas
    $(".buscadorVisitas" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        $(this).autocomplete({
            source: "/visitas/autocompletar/"+name,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                    console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/visitas/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });
     // Congresos
    $(".buscadorCongresos" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        $(this).autocomplete({
            source: "/congresos/autocompletar/"+name,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                    console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/congresos/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });

    $(".buscadorEquipamientoNuevo" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        $(this).autocomplete({
            source: "/equipamientoNuevo/autocompletar/"+name,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                    console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/equipamientoNuevo/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });
      // Publicaciones
    $(".buscadorPublicaciones" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        var tipo = $(this).closest('input').attr("data-tipo");
        $(this).autocomplete({
            source: "/publicaciones/autocompletar/"+name+"/"+tipo,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                    console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/publicaciones/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });

    $(".buscadorAldikariak" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        $(this).autocomplete({
            source: "/aldizkariak/autocompletar",
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                    /*console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/programasDeIntercambio/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }*/
                }
            }
        });
    });

    $(".buscadorPostgrados" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        var tipo = $(this).closest('input').attr("data-tipo");
        console.log("name:"+name+", tipo: "+tipo);
        $(this).autocomplete({
            source: "/postgrados/autocompletar/"+name+"/"+tipo,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                   console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/postgrados/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });

    $(".buscadorProgramasDeIntercambio" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        var tipo = $(this).closest('input').attr("data-tipo");
        console.log("name:"+name+", tipo: "+tipo);
        $(this).autocomplete({
            source: "/programasDeIntercambio/autocompletar/"+name+"/"+tipo,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                   console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/programasDeIntercambio/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });

    $(".buscadorFormaciones" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        var tipo = $(this).closest('input').attr("data-tipo");
        var modo = $(this).closest('input').attr("data-modo");
        console.log("name:"+name+", tipo: "+tipo);
        $(this).autocomplete({
            source: "/formaciones/autocompletar/"+name+"/"+tipo+"/"+modo,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                   console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/formaciones/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });

    $(".buscadorProyectos" ).focus(function() {
        var name = $(this).closest('input').attr("name");
        var tipo = $(this).closest('input').attr("data-tipo");
        console.log("name:"+name+", tipo: "+tipo);
        $(this).autocomplete({
            source: "/proyectos/autocompletar/"+name+"/"+tipo,
            minLength: 3,
            select: function (event, ui) {
                if(ui.item.id){
                   console.log($(this).attr('name'));
                    console.log("redirigir");
                    var url = "/proyectos/" + ui.item.id + "/edit"; // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                }
            }
        });
    });

});
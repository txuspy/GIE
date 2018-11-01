$(document).ready(function () {
    console.log("public/js/jqueryComunes.js ready!");
     $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
    });
     $('.summernote').summernote({
        height: 300,
        tabsize: 2,
        toolbar: [ ['style', ['bold', 'italic', 'underline']], ['para', ['ul', 'ol'] ],  ['codeview'] ],
        callbacks: {
            onKeyup: function(contents, e) {
                // console.log('Unai change:', contents, e);
                console.log('Summernote KeyUp');
                if($(this).attr('data-nombretabla')){
                    guardarInputEnBD($(this));
                    console.log("Guardando en Bd");
                }
            }
        }
    });
     $('.input-daterange').datepicker({
            weekStart: 1,
            language: "es",
            autoclose: true,
            weekStart: 1,
            format: "yyyy-mm-dd",
            calendarWeeks: true,
            daysOfWeekHighlighted: "0,6"
    });
    $('.datepicker').datepicker({
            weekStart: 1,
            language: "es",
            autoclose: true,
            weekStart: 1,
            format: "yyyy-mm-dd",
            calendarWeeks: true,
            daysOfWeekHighlighted: "0,6"
    });

    $('.mostraOcultar').click(function (e) {
        var nombreDiv = $(this).attr('data-nomDiv');
        if ($("#" + nombreDiv).css('display') == 'block') {
            $("#" + nombreDiv).hide();
        } else {
            $("#" + nombreDiv).show();
        }
    });
    var touchtime = 0;

    $('.mostraOcultarInput').dblclick(function () {
        console.log('click en .mostrarOcultarInput en jqueryComunes.js');
        var nombreDiv = $(this).attr('data-nomDiv');
        $(this).hide();
        $("#" + nombreDiv).show();
        $("#" + nombreDiv).focus();
        $("#" + nombreDiv).val($("#" + nombreDiv).val());
    });

    var tapped=false;
    $('.mostraOcultarInput').on( 'touchstart', function(e){
        // console.log('prueba toque mostraOcultar');
        if(!tapped){ //if tap is not set, set up single tap
            tapped=setTimeout(function(){
            tapped=null
            //insert things you want to do when single tapped
          },300);   //wait 300ms then run single click code
        } else {    //tapped within 300ms of last tap. double tap
            clearTimeout(tapped); //stop single tap callback
            tapped=null
            //codigo doble tap
            console.log('toque en .mostrarOcultarInput en jqueryComunes.js');
            var nombreDiv = $(this).attr('data-nomDiv');
            $(this).hide();
            $("#" + nombreDiv).show();
            $("#" + nombreDiv).focus();
            $("#" + nombreDiv).val($("#" + nombreDiv).val());
            //codigo doble tap
        }
        e.preventDefault();
    });

    $('.guardarBdChecbox').change(function () {
        console.log("change checkbox .guardarBdChecbox  en jqueryComunes js ,para guardar en base de datos mediante ajax()");
        var valorTipoTra = setValueCheckboxArray($(this).attr("data-nombreCampo"));
        var data = getDataInput($(this), valorTipoTra);
        guardarBd(data);
    });
    $(".guardarEnBDInput").keyup(function (e) {
        console.log("onkeyup input textarea .guardarEnBDInput  en jqueryComunes js ,para guardar en base de datos mediante ajax()");
        var valorCampo = $(this).val();
        var data = getDataInput($(this), valorCampo);
        guardarBd(data);
        var code = e.keyCode ? e.keyCode : e.which;
        if (code == 13) { // Enter key is pressed
            console.log("Pulsa enter a cambiar precio");
            console.log($(this));
        }
    });
    $(".guardarEnBDSelect").change(function () {
        console.log("change select .guardarEnBDSelect  en jqueryComunes js ,para guardar en base de datos mediante ajax()");
        var valorCampo = $(this).val();
        var data = getDataInput($(this), valorCampo);
        guardarBd(data);
    });
    function getDataInput(e, valor) {
        var nombreTabla = e.attr("data-nombreTabla");
        var nombreId = e.attr("data-nombreId");
        var nombreCampo = e.attr("data-nombreCampo");
        var valorId = e.attr("data-valorId");
        var valorCampo = valor;
        var token = $('meta[name="csrf-token"]').attr('content');
        console.log(' nombreTabla: ' + nombreTabla);
        console.log(' nombreId: ' + nombreId);
        console.log(' nombreCampo: ' + nombreCampo);
        console.log(' valorId: ' + valorId);
        console.log(' valorCampo: ' + valorCampo);
        if($('#' + nombreCampo + valorId + '_t')){
            $('#' + nombreCampo + valorId + '_t').html(valorCampo);
        }
        var datos = {
            '_token': token,
            'nombreTabla': nombreTabla,
            'nombreId': nombreId,
            'nombreCampo': nombreCampo,
            'valorId': valorId,
            'valorCampo': valorCampo
        };
        return datos;
    }

    function setValueCheckboxArray(nombreCampo) {
        if ($("input[name=" + nombreCampo + "]:checked")) {
            var valorTipoTra = ($("input[name=" + nombreCampo + "]:checked").map(
                function () {
                    return this.value;
                }).get().join("-"));
            return valorTipoTra;
        }
        return false;
    }

    function guardarBd(data) {
        console.log("dentro de funcion guardarBD...");
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/accion/ajaxInput",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',

            data: data,
            beforeSend: function () {
                //$('#txt').html("Procesando, espere por favor...");
                console.log("procesando datos...");
            },
            success: function () {
                console.log("datos procesados OK");
            },
            error: function (data) {
                console.log("datos procesados ERROR"+data);
            }
        }).fail(function (jqXHR) {
            // alert( 'Error!!' );
            if (jqXHR.status === 0) {
                // alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                console.log('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                console.log('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                console.log('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                console.log('Time out error.');
            } else if (exception === 'abort') {
                console.log('Ajax request aborted.');
            } else {
                console.log('Uncaught Error.\n' + jqXHR.responseText);
            }
        });
    }
});// document ready

function disparadorCargarProvincias(idHtmlPais, idHtmlProvincia){
    $(idHtmlPais).change(function () {
        var CountryCode = $(this).val();
        $.ajax({
            method: "get",
            url: "/customer/ajax/provincias",
            data: {CountryCode: CountryCode},
            success: function (dato) {
                $(idHtmlProvincia).empty();
                // console.log(dato);
                // console.log(JSON.parse(dato));
                $.each(JSON.parse(dato), function ( provincia, id_provincia) {
                    $(idHtmlProvincia).append($('<option>', {value: id_provincia, text: provincia}));
                });
            }
        });
    });
}


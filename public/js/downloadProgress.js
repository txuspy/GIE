$(document).ready(function () {
    $(".botonCrearDescarga").click(function (event) {
        event.preventDefault();
        $("#dialog").modal('show');
        var urlDescarga = $(this).attr('href');
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: urlDescarga,
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            //  data: {'_token': token } ,
            beforeSend: function () {
                console.log("procesando datos...");
            },
            xhr: function () {
                //var xhr = new window.XMLHttpRequest();
                var xhr = new XMLHttpRequest();
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
                        console.log('Ha entrado onprogress');
                        console.log('totalSize: ' + e.totalSize);
                        console.log('total: ' + e.total);
                        console.log('loaded: ' + e.loaded);
                        console.log('progreso: ' + progreso);
                        console.log('strProgreso: ' + strProgreso);
                        $('.progress-bar').css('width', progreso + '%');
                        $('.percent').html(strProgreso);
                    } else {
                        console.log('No soporta lengthComputable en download');
                    }
                };
                xhr.onloadstart = function (e) {
                    $('.progress-bar').width('100%');
                    $('.percent').html('Wait...');
                };
                xhr.onloadend = function (e) {
                    /* var progreso = parseInt((e.loaded / e.totalSize) * 100);
                     var strProgreso = progreso + "%";*/
                    var progreso = '100';
                    var strProgreso = '100%';
                    $('.progress-bar').css('width', progreso + '%');
                    $('.percent').html(strProgreso);

                    //$('.progress-bar').value = e.loaded;
                };
                return xhr;
            },
            /*xhrFields: {
                onprogress: function (e) {
                    if (e.lengthComputable) {
                        console.log("Loaded " + Number((e.loaded / e.total * 100)) + "%");
                    }
                    else {
                        console.log("xhrFields Length not computable.");
                    }
                }
            },
            */
            success: function (response) {
                console.log("datos descargados... en teoria OK");
                $("#dialog").modal('hide');
                var a = document.createElement("a");
                a.href = response.file;
                a.download = response.name;
                document.body.appendChild(a);
                a.click();
                a.remove();
            },
            error: function (response) {
                console.log("datos procesados ERROR ");
                console.log(response);
                /*var r = jQuery.parseJSON(response.responseText);
                alert("Message: " + r.Message);
                alert("StackTrace: " + r.StackTrace);
                alert("ExceptionType: " + r.ExceptionType);*/
            }
        });
    });
});
console.log('public/js/funcionesComunes.js ready !');
function valorCombo(what, valor=false) {
    if(valor!=null){
        $("#"+what).val(valor);
    }
}
function CrearDatatable(id){
    var table = $('#'+id).DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "iDisplayLength": 25,
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
        "searching":false,
        'responsive': {
            'details': {
                'display': $('#'+id).dataTable.Responsive.display.childRowImmediate,
                'type': ''
            }
        }
    });
}
function valorCombo(what, valor=false) {
    if(valor!=null){
        $("#"+what).val(valor);
    }
}
function CrearDatatable(id){
    var table = $('#'+id).DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "iDisplayLength": 25,
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
        "searching":false,
        'responsive': {
            'details': {
                'display': $('#'+id).dataTable.Responsive.display.childRowImmediate,
                'type': ''
            }
        }
    });
}

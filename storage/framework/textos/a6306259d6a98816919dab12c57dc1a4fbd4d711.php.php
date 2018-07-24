<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <?php echo Html::style( asset('css/app.css')); ?>

        <?php echo Html::style( asset('css/jquery.dataTables.min.css')); ?>


        <?php echo Html::script('js/app.js'); ?>

        <?php echo Html::script('js/jquery.dataTables.min.js'); ?>

        <?php echo Html::script('js/dataTables.responsive.min.js'); ?>

    </head>
    <body>
        <div class="container">
            <p id="p1" class='dobleToqueable'>parrafo 1</p>
            <p id="p2" class='dobleToqueable'>parrafo 2</p>
            <p id="p3" class='dobleToqueable'>parrafo 3</p>
            <p id="p4" class='dobleToqueable'>parrafo 4</p>

            <?php echo $__env->make('expedientes.lista', ['expedientes' => '', 'urlAjax'=>'/expedientes/154' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <script type="text/javascript">
            var tapped=false;

            // $(".dobleToqueable").on("touchstart", function(e) {dobleTqueBasico(e)} );
            $(".dobleToqueable").on( 'touchstart', function(e){
                console.log('prueba toque mostraOcultar');
                if(!tapped){ //if tap is not set, set up single tap
                    tapped=setTimeout(function(){
                    tapped=null
                    //insert things you want to do when single tapped
                  },300);   //wait 300ms then run single click code
                } else {    //tapped within 300ms of last tap. double tap
                    clearTimeout(tapped); //stop single tap callback
                    tapped=null
                    //codigo doble tap
                    console.log('doble toque en .mostrarOcultarInput');
                    //codigo doble tap
                }
                e.preventDefault();
            });

            // $(".dtr-details").on("touchstart", function(e) {dobleTqueDatatable(e)} );

            function dobleTqueBasico(e){
                if(!tapped){ //if tap is not set, set up single tap
                  tapped=setTimeout(function(){
                      tapped=null
                      //insert things you want to do when single tapped
                  },300);   //wait 300ms then run single click code
                } else {    //tapped within 300ms of last tap. double tap
                  clearTimeout(tapped); //stop single tap callback
                  tapped=null
                  alert('doble tap');
                  console.log(this)
                }
                e.preventDefault()
            };

            // function dobleToqueDatatable(e, table){
            //     console.log('prueba toque datatable');
            //     if(!tapped){ //if tap is not set, set up single tap
            //         tapped=setTimeout(function(){
            //             tapped=null
            //             //insert things you want to do when single tapped
            //       },300);   //wait 300ms then run single click code
            //     } else {    //tapped within 300ms of last tap. double tap
            //         clearTimeout(tapped); //stop single tap callback
            //         tapped=null
            //         alert('doble tap datatable');
            //         var data = table.row(this).data();
            //         var columns = table.settings().init().columns;
            //         var colIndex = table.cell(this).index().column;
            //         if(columns[colIndex].name=='id_cliente'){
            //             // window.location = "/customer/searchName/" + data['id_cliente'];
            //             console.log("/customer/searchName/" + data['id_cliente']);
            //         }
            //         if(columns[colIndex].name=='tit_expediente'){
            //             // window.location = "/expedientes/" + data['id_expediente'] +"/edit";
            //             console.log("/expedientes/" + data['id_expediente'] +"/edit");
            //         }
            //     }
            //     e.preventDefault()
            // };

            // function dobleClickDatatable(e, table){
            //     console.log('prueba click datatable');
            //     if(!tapped){ //if tap is not set, set up single tap
            //         tapped=setTimeout(function(){
            //             tapped=null;
            //             //insert things you want to do when single tapped
            //         },300);   //wait 300ms then run single click code
            //     } else {    //tapped within 300ms of last tap. double tap
            //         clearTimeout(tapped); //stop single tap callback
            //         tapped=null;
            //         alert('doble tap datatable');
            //         var data = table.row(this).data();
            //         var columns = table.settings().init().columns;
            //         var colIndex = table.cell(this).index().column;
            //         if(columns[colIndex].name=='id_cliente'){
            //             window.location = "/customer/searchName/" + data['id_cliente'];
            //             console.log("/customer/searchName/" + data['id_cliente']);
            //         }
            //         if(columns[colIndex].name=='tit_expediente'){
            //             window.location = "/expedientes/" + data['id_expediente'] +"/edit";
            //             console.log("/expedientes/" + data['id_expediente'] +"/edit");
            //         }
            //     }
            //     e.preventDefault();
            // };
        </script>
    </body>
</html>

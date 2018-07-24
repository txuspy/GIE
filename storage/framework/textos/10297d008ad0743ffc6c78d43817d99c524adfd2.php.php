<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function github (){
       return \PDF::loadFile('http://www.github.com/')->stream('github.pdf');
        //return \PDF::loadFile('http://laravel-txuspy.c9users.io/permisos')->stream('github.pdf');
    }

    public function pdfPrueba()
    {
        $now = Carbon::now('Europe/Madrid');
        // return view('layouts.pdf.prueba', ['direccion'=>'La direccion es calle falsa 123', 'telefono'=>'6546546546546', 'bancos' =>'kutxa 15463413']);

        //cabecera y footer
        $header = \View::make('layouts.pdf.cabecera')->render();
        $arrayPie= ['direccion'=>'La direccion es calle falsa 123', 'telefono'=>'6546546546546', 'bancos' =>'kutxa 15463413'];
        $footer = \View::make('layouts.pdf.pie', $arrayPie)->render();

        //prueba vista pie
        // return \View::make('layouts.pdf.pie', $arrayPie)->render();

        //carga de plantilla pdf
        $pdf = \PDF::loadView('layouts.pdf.prueba');
        // $pdf = \PDF::loadView('layouts.pdf.prueba', ['direccion'=>'La direccion es calle falsa 123', 'telefono'=>'6546546546546', 'bancos' =>'kutxa 15463413']);

        $pdf->setPaper('a4');

        //añadir cabecera y footer
        // var_dump($header);
        $pdf->setOption('header-html', $header );
        // var_dump($footer);

        $pdf->setOption('footer-html', $footer );
        // dd();
        // $pdf->setOption('footer-html', 'http://laravel-virgen-txuspy.c9users.io/footer1' );
        // $pdf->setOption('footer-center', $footer );

        //para ver el pie y cabecera bien
        // $pdf->setOption('margin-bottom', 0);
        // $pdf->setOption('margin-top', 0);

        return $pdf->stream();
        // return $pdf->output();
        // return $pdf->stream($now.'-prueba.pdf');
    }

}

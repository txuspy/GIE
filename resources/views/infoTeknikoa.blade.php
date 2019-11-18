@extends('layouts.app')

@section('content')

    <div class="container-fluid col-md-12  margin-tb">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-heading"><strong>{{ __(' Gipuzkoako Ingenieritza Eskolako Memoria Teknikoa.') }}</strong></div>
                
                <div class="panel-body">
                     <h2>Informazioa</h2>
                     <ul>
                         <li>Laravel 5.3, Arquitectura MVC (modelo, vista , controlador) erabiltzen du
                         <ul>
                             <li><a href="https://laravel.com/docs/5.3">Dokumentazio ofiziala</a> </li>
                             <li>Zerbitzaria : GIE bertan dago, Apache Ubuntu batean</li>
                             <li>Web aplikazioa PHP eta JQUERY erabiltzen du</li>
                             <li>Datu basea: MySQL, Eloquent ORM erabiliz</li>
                             <li>Bistak: Blade bitartez kudeatzen dire, Boostrap 3 Framework basearekin</li>
                           
                         </ul>
                         </li>
                         
                     </ul>
                     <h2>Funtzionamenduda</h2>
                     <p>
                        
                        Laravel PHP framework bat da, PHP klase talde batzuk dira funtsean. MVC arquitectura erabiltzen duena, oso komunitate zabala eta aktiboa dauka, Eloquetn ORM erabiltzen du datu baseko datuak objetuak bihurtzeko, ruteo oso errez , Blade plantilla sistemarekin lan egiten dut, eta segurtasun aldetik lan egiten duen frameworka da Token, Auth eta Middelwarekin.<br>
                        Oso gainetik aplikazioak nola lan egiten duen azaltzen sahiatuko naiz.<br>
                        1- Gure aplikazioak, url baten bitartez petizio bat jasotzen du.<br>
                        2- Url hauek, route artxibo batetik pasatu eta ze kontroladoreak zer behar duen ikusten du.<br>
                        3- Kontroladoreak zein funtzio ejekutatu behar duen jakiten du. <br>
                        4- Kontroladorean kalkulo logikoak egiten dira eta behar duen modeloak erabiltzen ditu datu basetik informazioa ateratzeko.<br>
                        5- Azkenik funtzioak bista itzuli eta nabigatzailean erakusten du erakutsi beharreko informazioa.<br>
                         
                     </p>
                    <div>
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

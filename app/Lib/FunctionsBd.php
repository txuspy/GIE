<?php
    /**
     * Created by PhpStorm.
     * User: IRUNWEBSERVER
     * Date: 11/10/2017
     * Time: 10:36
     */

    namespace App\Lib;
    use DB;

    class FunctionsBd
    {
     public static function dameDatoExacto($table, $name, $operador  ,$valor, $campoRespuesta)
        {
            $dato =  DB::table($table)
                ->where($name, $operador, $valor)
                ->value(trim($campoRespuesta));
            return $dato;
        }

        public static function dameDatoExactoTodo($table, $name, $operador  ,$valor, $campoRespuesta)
        {
            $dato =  DB::table($table)
                ->where($name, $operador, $valor)
                ->select($campoRespuesta)
                ->get();
            return $dato;
        }

        public static function listadoTipoMaquinas($txtDefault)
        {
            $miArray =  DB::table('makinaria_tipo_txt')
                ->select('id_makinaria_tipo', 'txt_makinaria_es')
                ->orderBy('txt_makinaria_es')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_makinaria_tipo]= $valor->txt_makinaria_es;
            }
            return $valores;
        }
        public static function listadoFormaPagoCliente($txtDefault)
        {
            $miArray =  DB::table('clientes_fp')
                ->select('id_fp', 'nom_fp')
                ->orderBy('nom_fp')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_fp]= $valor->nom_fp;
            }
            return $valores;
        }
        public static function listadoContactoCliente($id_cliente, $txtDefault=false)
        {
            $miArray =  DB::table('contactos')
                ->where('id_cliente', $id_cliente)
                ->select('id_contactos', 'email_contactos', 'nom_contactos', 'apellido_1_contactos')
                ->orderBy('nom_contactos')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_contactos]= $valor->nom_contactos." ".$valor->apellido_1_contactos." (".$valor->email_contactos.")";
            }
            return $valores;
        }
        public static function listadoTipoPagoCliente($txtDefault)
        {
            $miArray =  DB::table('clientes_tp')
                ->select('id_tp', 'nom_tp')
                ->orderBy('nom_tp')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_tp]= $valor->nom_tp;
            }
            return $valores;
        }
        public static function listadoTipoVisitas($txtDefault)
        {
            $miArray =  DB::table('visitas_tipo')
                ->select('id_vt', 'nom_vt')
                ->orderBy('nom_vt')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_vt]= $valor->nom_vt;
            }
            return $valores;
        }
        public static function listadoMarcaMaquinas($txtDefault)
        {
            $miArray =  DB::table('marca_prov')
                ->select('id_mp', 'nom_mp')
                ->orderBy('nom_mp')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_mp]= $valor->nom_mp;
            }
            return $valores;
        }
        public static function listadoPaises($txtDefault)
        {
            $miArray =  DB::table('paises')
                ->select('Code', 'Name')
                ->orderBy('Name')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->Code]= $valor->Name;
            }
            return $valores;
        }
         public static function listadoTipoDireccionCliente($txtDefault)
        {
            $miArray =  DB::table('clientes_direccion_tp')
                ->select('id_dtp', 'nom_dtp')
                ->orderBy('nom_dtp')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_dtp]= $valor->nom_dtp;
            }
            return $valores;
        }
        public static function listadoTipoDescuento($txtDefault)
        {
            $miArray =  DB::table('clientes_tcli')
                ->select('id_tcli', 'nom_tcli')
                ->orderBy('nom_tcli')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_tcli]= $valor->nom_tcli;
            }
            return $valores;
        }
        public static function listadoSedes($id_cliente, $txtDefault)
        {
            $miArray =  DB::table('clientes_direccion')
                ->select('id_direccion', 'direccion_direccion')
                ->where('id_cliente', $id_cliente)
                ->orderBy('tipo_direccion')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_direccion]= $valor->direccion_direccion;
            }
            return $valores;
        }
        public static function listadoCargo($txtDefault)
        {
            $miArray =  DB::table('contactos_cargo')
                ->select('id_cc', 'nom_cc_1')
                ->orderBy('nom_cc_1')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->id_cc]= $valor->nom_cc_1;
            }
            return $valores;
        }
        public static function listadoProvincias($countryCode, $txtDefault )
        {
            $valores=[];
            $miArray =  DB::table('provincias')
                ->select('provincias.ID', 'provincias.Name')
                ->where('provincias.CountryCode', $countryCode)
                ->groupBy('provincias.Name')
                ->orderBy('provincias.Name', 'ASC')
                ->get();

                foreach ($miArray as $valor){
                    $valores[$valor->ID] = $valor->Name;
                }
                if(empty($valores)){
                    $valores['1'] = '---';
                }
                if($txtDefault){
                    $valores[0] = $txtDefault;
                }

            return $valores;
        }

        public static function listadoProvinciasAjaxOrden($countryCode, $txtDefault )
        {
            $miArray =  DB::table('provincias')
                ->select('provincias.ID', 'provincias.Name')
                ->where('provincias.CountryCode', $countryCode)
                ->groupBy('provincias.Name')
                ->orderBy('provincias.Name', 'ASC')
                ->get();
            $provincias=[];

            if( $miArray->isEmpty() ){

                $provincias['---'] = 0;
            }else{
                if($txtDefault){
                $provincias[$txtDefault] = 0;
            }
                foreach ($miArray as $valor){
                    $provincias[$valor->Name] = $valor->ID;
                }
            }
            return $provincias;
        }

        public static function listadoComuniades($countryCode, $txtDefault)
        {
            $miArray =  DB::table('provincias')
                ->select( 'District')
                ->where('CountryCode', $countryCode)
                ->distinct('District')
                ->orderBy('District')
                ->get();
            $valores[0] = $txtDefault;
            foreach ($miArray as $valor){
                $valores[$valor->District]= $valor->District;
            }
            return $valores;
        }
    }
<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Lib\Functions;
use App\ClientesDirecciones;
use Carbon\Carbon;
use App\Http\Controllers\ImageController;
use App\Departamentos;

trait LimpiarCache
{
    
    public	static function initialize_i18n($locale) {
	    putenv('LANG='.$locale);
	    setlocale(LC_ALL,"");
	    setlocale(LC_MESSAGES,$locale);
	    setlocale(LC_CTYPE,$locale);
	    $locales_root = "/home/ubuntu/environment/resources/lang/i18n/";

	    $domains = glob($locales_root.'/'.$locale.'/LC_MESSAGES/messages-*.mo');
	    $current = basename($domains[0],'.mo');
	    $timestamp = preg_replace('{messages-}i','',$current);

	    
	    bindtextdomain($current,$locales_root);
	    textdomain($current);
    }
}

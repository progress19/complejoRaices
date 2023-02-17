<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model {
	    
	public $table = "fechas";

	public function apartamento()   {
        return $this->belongsTo('App\Apartamento', 'idApartamento');
    }

    public static function getEstadoStatus($estado) {

            switch ( $estado ) {
                    case '0':
                        return '<span class="estado-disponible"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> DISPONIBLE';
                        break;
                    case '1':
                        return '<span class="estado-ocupado"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> OCUPADO';
                        break;
                }
          
    }

    public static function getFechasOcupacion($idRoom, $tipo) { // tipo 0->disponible / tipo 1->ocupado
    
        $fechas = Fecha::where('estado',$tipo)->where('idApartamento',$idRoom)->pluck('fecha');
        return $fechas;
        
    }
	
}


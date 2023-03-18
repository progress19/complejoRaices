<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    protected $table = "reservas";

    public function apartamento()   {
        return $this->belongsTo('App\Apartamento', 'idApartamento');
    }

    public static function getPagoStatus($id, $fpago=1) {
    //return $fpago;

        $reserva = Reserva::find($id);

        switch ($fpago) {
            
            case '1':  // 1:mp / 2:crypto 

                switch ( $reserva->collection_status ) {
                    case 'approved':
                        return '<span class="pago-aprobado"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> APROBADO';
                        break;
                    case 'rejected':
                        return '<span class="pago-rechazado"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> RECHAZADO';
                        break;
                    case 'pending':
                        return '<span class="pago-pendiente"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> PENDIENTE';
                        break;
                    case 'in_process':
                        return '<span class="pago-proceso"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> EN PROCESO';
                        break;
                    case 'cancelado':
                        return '<span class="pago-cancelado"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> CANCELADO';
                        break;
                    default:
                        return '<span class="pago-sinestado"><span class="glyphicon glyphicon-warning-sign" title="Estado desconocido" aria-hidden="true"></span> S/E';
                    break;
                }
                
                break;

            case '2':

                switch ( $reserva->collection_status ) {
                    case 'charge:confirmed':
                        return '<span class="pago-aprobado"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> APROBADO';
                        break;
                    case 'rejected':
                        return '<span class="pago-rechazado"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> RECHAZADO';
                        break;
                    case 'charge:pending':
                        return '<span class="pago-pendiente"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> PENDIENTE';
                        break;
                    case 'in_process':
                        return '<span class="pago-proceso"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> EN PROCESO';
                        break;
                    case 'charge:failed':
                        return '<span class="pago-rechazado"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> CANCELADO';
                        break;
                    default:
                        return '<span class="pago-sinestado"><span class="glyphicon glyphicon-warning-sign" title="Estado desconocido" aria-hidden="true"></span> S/E';
                    break;
                }

                break;

        }

    }

}

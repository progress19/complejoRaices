<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Reserva;
use App\Fun;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class ReservaController extends Controller {

    public function getData() {

        $reservas = Reserva::select()->where('collection_status','!=','')->orderBy('id', 'desc');

        //$reservas = Reserva::select()->orderBy('id', 'desc');
        
        return Datatables::of($reservas)
    
            ->addColumn('id', function ($reserva) {
                return "<a href='edit-reserva/$reserva->id'>$reserva->id</a>"; 
            })

            ->addColumn('fecha', function ($reserva) {
                return '<spam style="font-size:11px">'.Carbon::parse($reserva->fecha)->format('d-m-Y H:i').'hs'.'</spam>';
            })

            ->addColumn('titular', function ($reserva) {
                return Str::limit($reserva->titular, 20); 
            })

            ->addColumn('desde', function ($reserva) {
                return Carbon::parse($reserva->desde)->format('d-m-Y'); 
            })

            ->addColumn('hasta', function ($reserva) {
                return Carbon::parse($reserva->hasta)->format('d-m-Y'); 
            })

            ->addColumn('apartamento', function ($reserva) {
                return $reserva->apartamento->nombre; 
            })

            ->addColumn('total_raw', function ($reserva) {
                return '$'.number_format($reserva->total ,0, ',', '.'); 
            })

            ->addColumn('estado', function ($reserva) {
                return Fun::getIconStatus($reserva->estado); 
            })

            ->addColumn('collection_status', function ($reserva) {
                return Reserva::getPagoStatus($reserva->id, 1); 
            })

            ->addColumn('pago', function ($reserva) {
                return "<img src='".asset('images/mercado-pago-logo.png')."' class='logo-tipopago' >"; 
            })

            ->addColumn('acciones', function ($reserva) {
                return "<a href='delete-reserva/$reserva->id' class='delReg'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
            })

            ->rawColumns(['id','fecha','desde','hasta','estado','acciones','pago','collection_status','apartamento'])    
            ->make(true);

    }

    /*********************************************************/
    /*                      V I E W                          */
    /*********************************************************/    

    public function viewReservas() {

        $reservas = Reserva::orderBy('id','asc')->get();
        return view('admin.reservas.view_reservas')->with(compact('reservas'));
    }

    /*********************************************************/
    /*                      E D I T                          */
    /*********************************************************/

    public function editReserva(Request $request, $id = null) {

        if ($request->isMethod('post')) {

            $data = $request->all();
            
            Reserva::where(['id'=>$id])->update([
                'comentarios' => $data['comentarios'],
                'estado' => $data['estado'],
                ]);

            return redirect('/admin/view-reservas')->with('flash_message','Reserva actualizada correctamente...');
        
        }

        $reserva = Reserva::where(['id'=>$id])->first();
       
        return view('admin.reservas.edit_reserva')->with(compact('reserva'));
    
    }


    /*********************************************************/
    /*                   D E L E T E                       */
    /*********************************************************/

    public function deleteReserva(Request $request, $id = null) {

        if (!empty($id)) {
            Reserva::where(['id'=>$id])->delete();
            return redirect('/admin/view-reservas')->with('flash_message','Reserva eliminada...');
        }

        $reservas = Reserva::get();
        return view('admin.reservas.view_reservas')->with(compact('reservas'));
    
    }


}

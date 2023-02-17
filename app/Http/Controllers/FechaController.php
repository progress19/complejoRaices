<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fecha;
use App\Apartamento;
use App\Fun;
use Yajra\Datatables\Datatables;
use DateTime;
use Carbon\Carbon;

class FechaController extends Controller {

    public function checkFechaNueva(Request $request) {

        $data = $request->all();

        $fecha = Fecha::where(['fecha' => $data['fecha']])->first();

        if (isset($fecha->fecha)) {
        
            echo(json_encode(false));
        
        } else {
        
            echo(json_encode(true));
        
        }
    }


    public function cargaMasiva(Request $request) {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $firstDate  = new DateTime($_REQUEST['desde']);
            $secondDate = new DateTime($_REQUEST['hasta']);
            
            $intvl = $firstDate->diff($secondDate);

            // Total amount of days
            //echo $intvl->days . " days <br>";

            for ( $i = 0; $i < $intvl->days + 1; $i++ ) { 
             
                $fecha = new DateTime($_REQUEST['desde']);
                
                date_add( $fecha, date_interval_create_from_date_string( $i." day" ));
                
                //echo date_format($fecha,"Y-m-d").'<br>';
                
                $fecha_a = date_format($fecha,"Y-m-d");

                $fecha_query = Fecha::where('fecha', '=', $fecha_a)->where('idApartamento', '=', $data['idApartamento'])->first();

                if ($fecha_query) {
                  Fecha::where([ 'id' => $fecha_query->id ])->where([ 'idApartamento' => $fecha_query->idApartamento ])->delete();
                }

                $fecha = new Fecha;
                $fecha->fecha = $fecha_a;
                $fecha->idApartamento = $data['idApartamento'];
                $fecha->t2 = $data['t2'];
                $fecha->t3 = $data['t3'];
                $fecha->t4 = $data['t4'];
                $fecha->t5 = $data['t5'];
                $fecha->t6 = $data['t6'];
                $fecha->estado = 0;
        
                $fecha->save();

            }

            return redirect('/admin/view-fechas')->with('flash_message','Fechas creadas correctamente...');

        }

        $apartamentos = Apartamento::where(['estado'=>1])->orderBy('nombre','asc')->pluck('nombre', 'id');
    
        return view('admin.fechas.cargaMasiva')->with(compact('apartamentos'));
    
    }

    public function eliminarFechas(Request $request) {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $firstDate  = new DateTime($_REQUEST['desde']);
            $secondDate = new DateTime($_REQUEST['hasta']);
            
            $intvl = $firstDate->diff($secondDate);

            // Total amount of days
            //echo $intvl->days . " days <br>";

            for ( $i = 0; $i < $intvl->days + 1; $i++ ) { 
             
                $fecha = new DateTime($_REQUEST['desde']);
                
                date_add( $fecha, date_interval_create_from_date_string( $i." day" ));
                                                
                $fecha_a = date_format($fecha,"Y-m-d");

                $fecha_query = Fecha::where('fecha', '=', $fecha_a)->where('idApartamento', '=', $data['idApartamento'])->first();

                if ($fecha_query) {
                  Fecha::where([ 'id' => $fecha_query->id ])->where([ 'idApartamento' => $fecha_query->idApartamento ])->delete();
                }

            }

            return redirect('/admin/view-fechas')->with('flash_message','Fechas eliminadas correctamente...');

        }

        $apartamentos = Apartamento::where(['estado'=>1])->orderBy('nombre','asc')->pluck('nombre', 'id');
    
        return view('admin.fechas.eliminarFechas')->with(compact('apartamentos'));
    
    }

    public function getData() {
               
        $fechas = Fecha::select(['id','fecha','idApartamento','t2','t3','t4','t5','t6','estado','created_at'])->orderBy('id', 'desc');

        return Datatables::of($fechas)

            ->addColumn('id', function ($fecha) {
                return "<a href='edit-fecha/$fecha->id'>$fecha->id</a>"; 
            })

            /*
            ->editColumn('fecha_test', function ($fecha) {

                $myDateTime = DateTime::createFromFormat('d-m-Y', $fecha->fecha);
                $newDateString = $myDateTime->format('d-m-Y');

               return [
                    'display' => $myDateTime->format('d-m-Y'),
                    'timestamp' => strtotime($newDateString)
               ];
            })
            */

            ->addColumn('apartamento', function ($fecha) {
                return $fecha->apartamento->nombre;
            })

            ->addColumn('fecha', function ($fecha) {
                return Carbon::parse($fecha->fecha)->format('d-m-Y');
            })

            ->addColumn('t2', function ($fecha) {
                return '$'.number_format( $fecha->t2 ,0, ',', '.'); 
            })
            ->addColumn('t3', function ($fecha) {
                return '$'.number_format( $fecha->t3 ,0, ',', '.'); 
            })
            ->addColumn('t4', function ($fecha) {
                return '$'.number_format( $fecha->t4 ,0, ',', '.'); 
            })
            ->addColumn('t5', function ($fecha) {
                return '$'.number_format( $fecha->t5 ,0, ',', '.'); 
            })
            ->addColumn('t6', function ($fecha) {
                return '$'.number_format( $fecha->t6 ,0, ',', '.'); 
            })

            ->addColumn('acciones', function ($fecha) {
                return "<a href='delete-fecha/$fecha->id' class='delReg'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
            })

            ->addColumn('estado', function ($fecha) {
                return Fecha::getEstadoStatus($fecha->estado); 
            })
            
            ->rawColumns(['id','fecha','t2','t3','t4','t5','t6','idApartamento','estado','acciones'])

            ->make(true);

    }

    public function viewFechas() {

        return view('admin.fechas.view_fechas');
    }

    /*********************************************************/
    /*                      A D D                            */
    /*********************************************************/
    
    public function addFecha(Request $request) {
        
        if ($request->isMethod('post')) {
            $data = $request->all();

            $fecha = new Fecha;
            $fecha->fecha = $data['fecha'];
            $fecha->idApartamento = $data['idApartamento'];
            $fecha->t2 = $data['t2'];
            $fecha->t3 = $data['t3'];
            $fecha->t4 = $data['t4'];
            $fecha->t4 = $data['t5'];
            $fecha->t4 = $data['t6'];
    
            $fecha->save();
            return redirect('/admin/view-fechas')->with('flash_message','Fecha creada correctamente...');
        }

       return view('admin.fechas.add_fecha');
    }

    /*********************************************************/
    /*                      E D I T                          */
    /*********************************************************/

    public function editFecha(Request $request, $id = null) {

        if ($request->isMethod('post')) {

            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            
            Fecha::where(['id'=>$id])->update([
                't2' => $data['t2'],
                't3' => $data['t3'],
                't4' => $data['t4'],
                't5' => $data['t5'],
                't6' => $data['t6'],
               ]);

            return redirect('/admin/view-fechas')->with('flash_message','Fecha actualizada correctamente...');
        }

        $fecha = Fecha::where(['id'=>$id])->first();
       
        return view('admin.fechas.edit_fecha')->with(compact('fecha'));
    
    }


    /*********************************************************/
    /*                   D E L E T E                       */
    /*********************************************************/

    public function deleteFecha(Request $request, $id = null) {

        if (!empty($id)) {
            Fecha::where(['id'=>$id])->delete();
            return redirect('/admin/view-fechas')->with('flash_message','Fecha eliminada...');
        }

        $fechas = Fecha::get();
        return view('admin.fechas.view_fechas')->with(compact('fechas'));
    
    }


}

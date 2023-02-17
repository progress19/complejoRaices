<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartamento;
use App\Fun;
use Yajra\Datatables\Datatables;

class ApartamentoController extends Controller {

    public function getData() {
               
        $apartamentos = Apartamento::select();

        return Datatables::of($apartamentos)

            ->addColumn('nombre', function ($apartamento) {
                return "<a href='edit-apartamento/$apartamento->id'>$apartamento->nombre</a>"; 
            })

            ->addColumn('ocupacion', function ($apartamento) {
                return "<a class='ver-ocupacion' href='view-ocupacion/$apartamento->id'><span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span> VER OCUPACION</a>"; 
            })

            ->addColumn('estado', function ($apartamento) {
                return Fun::getIconStatus($apartamento->estado); 
            })

            ->addColumn('acciones', function ($apartamento) {
                return "<a href='delete-apartamento/$apartamento->id' class='delReg'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
            })
            
            ->addColumn('estado', function ($apartamento) {
                return Fun::getIconStatus($apartamento->estado); 
            })

            ->rawColumns(['nombre','ocupacion','estado','acciones'])

            ->make(true);

    }

    /*********************************************************/
    /*                   O C U P A C I O N                   */
    /*********************************************************/

    public function viewOcupacion(Request $request, $id = null) {

        $apartamento = Apartamento::where(['id'=>$id])->first();

        return view('admin.apartamentos.view_ocupacion')->with([
            'apartamento' => $apartamento,
        ]);
    
    }

    public function viewApartamentos() {

        $apartamentos = Apartamento::orderBy('nombre','asc')->get();
        return view('admin.apartamentos.view_apartamentos')->with(compact('apartamentos'));
    }

    /*********************************************************/
    /*                      A D D                            */
    /*********************************************************/
    
    public function addApartamento(Request $request) {
        
        if ($request->isMethod('post')) {
            $data = $request->all();

            $apartamento = new Apartamento;
            $apartamento->nombre = $data['nombre'];
            $apartamento->estado = $data['estado'];
            
            $apartamento->save();
            return redirect('/admin/view-apartamentos')->with('flash_message','Apartamento creado correctamente...');
        }

       return view('admin.apartamentos.add_apartamento');
    }

    /*********************************************************/
    /*                      E D I T                          */
    /*********************************************************/

    public function editApartamento(Request $request, $id = null) {

        if ($request->isMethod('post')) {

            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            
            Apartamento::where(['id'=>$id])->update([
                'nombre' => $data['nombre'],
                'estado' => $data['estado'],
                ]);
            return redirect('/admin/view-apartamentos')->with('flash_message','Apartamento actualizado correctamente...');
        }

        $apartamento = Apartamento::where(['id'=>$id])->first();
       
        return view('admin.apartamentos.edit_apartamento')->with(compact('apartamento'));
    
    }


    /*********************************************************/
    /*                   D E L E T E                       */
    /*********************************************************/

    public function deleteApartamento(Request $request, $id = null) {

        if (!empty($id)) {
            Apartamento::where(['id'=>$id])->delete();
            return redirect('/admin/view-apartamentos')->with('flash_message','Apartamento eliminado...');
        }

        $apartamentos = Apartamento::get();
        return view('admin.apartamentos.view_apartamentos')->with(compact('apartamentos'));
    
    }


}

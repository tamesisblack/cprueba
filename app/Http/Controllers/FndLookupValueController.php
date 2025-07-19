<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use sisVentas\FndLookup;
use sisVentas\FndLookupValue;

use Illuminate\Support\Facades\Redirect;

use Auth;
use DB;

class FndLookupValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 	//route: fnd/tipocliente
    public function lst_typecustomer()
    {
        
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type','TIPO_CLIENTES')->get();
         
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }

    public function getAll()
    {
        return DB::select('SELECT D.idlookup, D.code_value, D.description FROM fnd_lookup_value as D, fnd_lookup as C
                        where D.idlookup = C.idlookup
                        and C.lookup_type = \'Tipo_doc_Ingreso\'');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store11(Request $request)
    {


        $cccodigo33 = $request->get('ccodigo');
        $dddescripcion33 = $request->get('description');
        $panio_desde33 = $request->get('panio_desde');
        $panio_hasta33 = $request->get('panio_hasta');
        $last_id = $request->get('idlo');

        $datefrom = explode('/', $panio_desde33);
        $diafrom = $datefrom[0];
        $mesfrom = $datefrom[1];
        $anofrom = $datefrom[2];
        // fecha formateada
        $datef = "$anofrom-$mesfrom-$diafrom";

        $dateto = explode('/', $panio_hasta33);
        $diato = $dateto[0];
        $mesto = $dateto[1];
        $anoto = $dateto[2];
        // fecha formateada
        $datet = "$anoto-$mesto-$diato";

        $user_id = Auth::id();

        $fndlookupvalue = new FndLookupValue;
        $fndlookupvalue->code_value = $cccodigo33;
        $fndlookupvalue->description = $dddescripcion33;
        $fndlookupvalue->date_from = $datef;
        $fndlookupvalue->date_to = $datet;
        $fndlookupvalue->created_by = $user_id;
        $fndlookupvalue->idlookup = $last_id;
        $fndlookupvalue->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        DB::select("delete from fnd_lookup_value where idlookup = $id");
    }

    public function ajax_edit_lookup(Request $request, $id, $code, $description, $from, $to)
    {
        $fndlookupvalue = FndLookupValue::find($id);

        // Validar y asignar valores a las propiedades
        $fndlookupvalue->code_value = ($code !== 'null') ? $code : null; // Si $code es 'null', asigna null
        $fndlookupvalue->description = ($description !== 'null') ? $description : null; // Si $description es 'null', asigna null
        $fndlookupvalue->date_from = ($from !== 'null') ? $from : null; // Si $from es 'null', asigna null
        $fndlookupvalue->date_to = ($to !== 'null') ? $to : null; // Si $to es 'null', asigna null

        $fndlookupvalue->save();

        return response()->json(['data' => $fndlookupvalue]);
    }
    public function ajax_add_lookup(Request $request, $id, $code, $description)
    {


        $fndlookupvalue = new FndLookupValue();
        $fndlookupvalue->description = $description;
        $fndlookupvalue->code_value = $code;
        $fndlookupvalue->idlookup = $id;
        $fndlookupvalue->save();
        return response()->json(['data' => $fndlookupvalue]);
    }
}

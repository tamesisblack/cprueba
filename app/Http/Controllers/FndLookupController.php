<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use sisVentas\FndLookup;
use sisVentas\FndLookupValue;
use sisVentas\FndLookupFormRequest; 
use Illuminate\Support\Facades\Redirect;

use Auth;
use DB;


class FndLookupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 

 

    public function estado_administrativo()
    {
        $lookup = 'DEPOSITO_ESTADO_ADMINISTRATIVO';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }

    public function estado_vehiculo()
    {
        $lookup = 'DEPOSITO_ESTADO_VEHICULO';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }


                public function partscars()
    {
        $lookup = 'PARTES_VEHICULO';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }

    
    public function categoriaserv()
    {
        $lookup = 'CATEGORIA_LABOR';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }

    public function categoriappto()
    {
        $lookup = 'LISTA_CATEGORIA_PPTO';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }



        public function tipocontrato()
    {
        /* USADO EN: Contrato vehicular / tipo de contrato
        Menu: 
        */
        $lookup = 'DOCUMENTOS_CONTRATO';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }

        public function tipovehiculos()
    {
        $lookup = 'AS_TYPE_VEHICLE';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }

        public function ListaAseguradoras()
    {
        $lookup = 'LISTA_ASEGURADORAS';
        $generico = 1;
        $fndlookups = FndLookup::where('lookup_type',$lookup)->orderBy('idlookup', 'DESC')->get();
        
//dd($generico );
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups)
                                                    ->with('generico', $generico);
    }


    public function index()
    {   
        $generico = 0;
        $fndlookups = FndLookup::orderBy('idlookup', 'DESC')->get();
        return view('configuracion.fndlookup.index')->with('fndlookups', $fndlookups) ->with('generico', $generico);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracion.fndlookup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function storeNUEVO(Request $request)
    {   
        //dd($request);
        $lookup_type = $request->get('lookup_type');
        $description = $request->get('description');
        $customization_level = $request->get('customization_level');

        $user_id = Auth::id();

        $fndlookup = new FndLookup;
        $fndlookup->lookup_type = $lookup_type;
        $fndlookup->description = $description;
        $fndlookup->customization_level = $customization_level;        
        $fndlookup->created_by = $user_id;
        $fndlookup->active = 1;
        $fndlookup->save();
        
        // obtengo el id save()
        $last_id = $fndlookup->idlookup;        

        $cccodigo33 = $request->get('codigo_value');
        $dddescripcion33 = $request->get('descr_value');
        

        $fndlookupvalue = new FndLookupValue;
        $fndlookupvalue->code_value=  $cccodigo33 ;
        $fndlookupvalue->description = $dddescripcion33;
        $fndlookupvalue->created_by=$user_id;
        $fndlookupvalue->idlookup=$last_id;
        $fndlookupvalue->save();

 
        return back()->withInput();  
      //return Redirect::to('configuracion/fndlookup');
       
    }

    public function store(Request $request)
    {   
     
        $lookup_type = $request->get('lookup_type');
        $description = $request->get('description');
        $customization_level = $request->get('customization_level');

        $user_id = Auth::id();

        $fndlookup = new FndLookup;
        $fndlookup->lookup_type = $lookup_type;
        $fndlookup->description = $description;
        $fndlookup->customization_level = $customization_level;        
        $fndlookup->created_by = $user_id;
        $fndlookup->active = 1;
        $fndlookup->save();
        
        // obtengo el id save()
        $last_id = $fndlookup->idlookup;        

        $cccodigo33 = $request->get('cccodigo33');
        $dddescripcion33 = $request->get('dddescripcion33');
       // $panio_desde33 = $request->get('panio_desde33');
        //$panio_hasta33 = $request->get('panio_hasta33');
        $aactivee33 = $request->get('aactivee33');


        $cantidad = count($cccodigo33);
        
        for($i=0;$i<$cantidad;$i++){

         /*
         $datefrom = explode('/', $panio_desde33[$i]);
         $diafrom = $datefrom[0];
         $mesfrom = $datefrom[1];
         $anofrom = $datefrom[2];
         // fecha formateada
         $datef = "$anofrom-$mesfrom-$diafrom";

         $dateto = explode('/', $panio_hasta33[$i]);
         $diato = $dateto[0];
         $mesto = $dateto[1];
         $anoto = $dateto[2];
         // fecha formateada
         $datet = "$anoto-$mesto-$diato";
         */       
                    $fndlookupvalue = new FndLookupValue;
                    $fndlookupvalue->code_value=$cccodigo33[$i];
                    $fndlookupvalue->description=$dddescripcion33[$i];
                    //$fndlookupvalue->date_from=$datef;
                    //$fndlookupvalue->date_to=$datet;
                    $fndlookupvalue->created_by=$user_id;
                    $fndlookupvalue->idlookup=$last_id;
                    $fndlookupvalue->save();
                
        }

         
      return Redirect::to('configuracion/fndlookup');
       
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
        $fndlookupvalue = DB::select("select * from fnd_lookup_value where idlookup = $id");

        return view("configuracion.fndlookup.edit",["fndlookup"=>Fndlookup::findOrFail($id),"fndlookupvalues"=>$fndlookupvalue, 'idfndlookup' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $lookup_type = $request->get('lookup_type');
        $description = $request->get('description');
        $customization_level = $request->get('customization_level');

        $user_id = Auth::id();
        $id = $request->get('idlookup');

        $fndlookup = FndLookup::find($id);
        $fndlookup->lookup_type = $lookup_type;
        $fndlookup->description = $description;
        $fndlookup->customization_level = $customization_level;        
        $fndlookup->created_by = $user_id;
        $fndlookup->active = 1;
        $fndlookup->save();

        //return Redirect::to('configuracion/fndlookup');
        //return Redirect::to('/home');
        return Redirect::back()->withInput();


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
        DB::select("update fnd_lookup set active = 0  where idlookup = $id"); 
       
    }

    public function activar(Request $request)
    {
        $id = $request->get('id');    
        DB::select("update fnd_lookup set active = 1  where idlookup = $id"); 
        
    }

    public function reporte(){


        $registros=DB::table('fnd_lookup')
            ->orderBy('lookup_type','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado de Lookup"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(50,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(50,8,utf8_decode("Descripcion"),1,"","L",true);
        // $pdf::cell(45,8,utf8_decode("Ivg"),1,"","L",true);
        // $pdf::cell(45,8,utf8_decode("Condicion"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {  
            if($reg->condicion==1){
                $condicion = "activo";
            }else{
                $condicion = "inactivo";
            }

            $pdf::cell(50,6,utf8_decode($reg->lookup_type),1,"","L",true);
            $pdf::cell(50,6,utf8_decode($reg->description),1,"","L",true);
         //   $pdf::cell(45,6,utf8_decode($reg->customization_level),1,"","L",true);
         //   $pdf::cell(45,6,utf8_decode($condicion),1,"","L",true);
            
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;

    }


}

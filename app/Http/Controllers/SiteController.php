<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests\SiteFormRequest;
//use Symfony\Component\HttpFoundation\File\UploadedFile;

use sisVentas\User;
use sisVentas\createby;
use sisVentas\Site;
use sisVentas\Impuesto;
use sisVentas\Moneda;
use sisVentas\PromotionSite; 
use Laracasts\Flash\Flash;
use sisVentas\Http\Requests;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;

class SiteController extends Controller
{

    //08.12.20
        public function PromotionSite()
    {
        $datos = PromotionSite::orderBy('id', 'DESC')->get();

        return view('promotion.site.index')->with('data', $datos);
 
    }

    public function index()
    {
        $sites = Site::orderBy('name', 'DESC')->get();
        return view('configuracion.site.index')->with('rssite', $sites);
    }


    public function create()
    {
        $tax = Impuesto::orderBy('name', 'ASC')->lists('name', 'id');
        $currency = Moneda::orderBy('currency_code', 'ASC')->lists('currency_code', 'idcurrency');

        return view('configuracion.site.create')->with('tax', $tax)->with('moneda', $currency) ;
    }                 


    public function store(SiteFormRequest $request)
    {

        if($request->file('path_image_logo') !== null)
        {
            
            $imageName = $request->file('path_image_logo')->getClientOriginalName();
            $path = base_path() . '/public/imagenes/logo/';
            $request->file('path_image_logo')->move($path , $imageName);
        
        }

        $vehiculos = new Site();
        $vehiculos->name = $request->input('name');
        $vehiculos->tax_id = $request->input('tax_id');
        $vehiculos->address = $request->input('address');
        $vehiculos->num_1099 = $request->input('num_1099');
        $vehiculos->bill_to_name = $request->input('bill_to_name');
        $vehiculos->telef = $request->input('telef');
        //$vehiculos->path_image_logo = 'imagenes/logo/'.$imageName;
        $vehiculos->email = $request->input('email');
        $vehiculos->label_tax_code = $request->input('label_tax_code');
        $vehiculos->invserial = $request->input('invserial');
        $vehiculos->invnumber = $request->input('invnumber');
        $vehiculos->bolnumber = $request->input('bolnumber');
        $vehiculos->bolserial = $request->input('bolserial');
        $vehiculos->bol_last_number = $request->input('bol_last_number');        
        
        $vehiculos->created_by = Auth::user()->id;
        $vehiculos->last_updated_by = Auth::user()->id;

        //return $vehiculos;
        $vehiculos->save();
         

        Flash::success("Se ha registrado de manera exitosa!")->important();

        return redirect()->route('configuracion.site.index');
    }
 

    public function edit($id)
    {
        $sites = Site::find($id);
       $tax = Impuesto::orderBy('name', 'ASC')->lists('name', 'id');
        $currency = Moneda::orderBy('currency_code', 'ASC')->lists('currency_code', 'idcurrency');
//        dd($sites);
        return view('configuracion.site.edit')->with('rssite', $sites)->with('tax', $tax)->with('moneda', $currency) ;
    }

    public function update(SiteFormRequest $request, Site $site)
    {

             dd($request);
        if($request->file('path_image_logo') !== null){
            $imageName = $request->file('path_image_logo')->getClientOriginalName();

            if($imageName !== $site->path_image_logo)
            {

                    $path = base_path() . '/public/imagenes/logo/';
                    $request->file('path_image_logo')->move($path , $imageName);

                    $site->path_image_logo = 'imagenes/logo/'.$imageName;
            }
        }

            
               


        $condicion = $request->input('condicion');
        
        if ($condicion == 1) 
            $site->condicion = $condicion ;
        else
            $site->condicion = 0 ;

        $currency = Moneda::where('idcurrency', $request->input('idcurrency'))->get();
        $site->label_currency_symbol = $currency[0]->simbolo;
        $site->desc_long_currency = $currency[0]->descripcion;
        $site->currency_code = $currency[0]->currency_code;

        $tax = Impuesto::where('id', $request->input('tax_id'))->get();
        $site->label_tax_code = $currency[0]->simbolo;
        //factor_convertion_tex
        $site->name = $request->input('name');
        $site->tax_id = $request->input('tax_id');
        $site->address = $request->input('address');
        $site->bill_to_name = $request->input('bill_to_name');
        $site->num_1099 = $request->input('num_1099');
        $site->telef = $request->input('telef');
         $site->invserial = $request->input('invserial');
        $site->invnumber = $request->input('invnumber');
        $site->bolnumber = $request->input('bolnumber');
        $site->bolserial = $request->input('bolserial');
        $site->bol_last_number = $request->input('bol_last_number'); 
        $site->email = $request->input('email');
        $site->created_by = Auth::user()->id;
        $site->last_updated_by = Auth::user()->id;
           
            //return $site;
        $site->save();

         
        Flash::success("El registro ha sido editado con exito!")->important();
        
        return redirect()->route('configuracion.site.index');
    }

    public function export(Request $request, Vehiculo $vehiculos)
    {
       Excel::create('Listado de vehiculos', function($excel) {
            $excel->sheet('listado', function($sheet) {
                 $vehiculos = Vehiculo::orderBy('placa', 'ASC')->get();
                $sheet->loadView('asesor.vehiculo.excel.export')->with('vehiculos', $vehiculos);
            });
        })->export('xls');
    }

    public function selectAjax(Request $request)
    {
        $idmarca = request()->get('idmarca');
        if ($request->ajax()) {
            $modelos = Modelo::orderBy('nombre', 'ASC')->where('condicion', 1)->where('idmarca', $idmarca)->lists('nombre', 'idmodelo');
            $data = view('asesor.vehiculo.partials.ajax-select', compact('modelos'))->render();
            return response()->json(['options' => $data]);
        }
    }

    public function search()
    {
        $dat = Carbon::now()->format('Y-m-d');
        $marcas = Marca::where('condicion', 1)->orderBy('nombre', 'ASC')->lists('nombre', 'idmarca');
        $modelos = Modelo::orderBy('nombre', 'ASC')->where('condicion', 1)->lists('nombre', 'idmodelo');
        $clientes = Cliente::orderBy('full_name', 'ASC')->where('effective_end_date', '>=', $dat)->lists('full_name', 'idcliente');
        $combustions = Combustion::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        return view('asesor.vehiculo.query.search')->with('marcas', $marcas)->with('modelos', $modelos)->with('clientes', $clientes)->with('combustions', $combustions);
    }

    public function query(Request $request)
    {
        $vehiculos = Vehiculo::search($request)->orderBy('placa', 'ASC')->get();
        $placa=1;
        Excel::create('Lista de vehiculos consultados', function($excel) use ($vehiculos){
            $excel->sheet('Listado', function($sheet) use ($vehiculos){
                $placa=1;
                $sheet->loadView('asesor.vehiculo.excel.exportquery')->with('placa', $placa)->with('vehiculos', $vehiculos);
            });
        })->store('xls', storage_path('excel/exports/'.Auth()->user()->id.'/'));
        return view('asesor.vehiculo.query.query')->with('vehiculos', $vehiculos)->with('placa', $placa);
    }

    public function exportquery()
    {
        return response()->download(storage_path('excel/exports/'.Auth()->user()->id.'/Lista de vehiculos consultados.xls'));
    }
}
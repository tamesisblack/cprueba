<?php

namespace sisVentas\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use sisVentas\Buyer;
use sisVentas\DailyRate;
use sisVentas\Direccion;
use sisVentas\Entity;
use sisVentas\FndLookup;
use sisVentas\FndLookupValue;
use sisVentas\Http\Requests;
use sisVentas\FndAttachedDocuments;
use sisVentas\Impuesto;
use sisVentas\Item;
use sisVentas\Moneda;
use sisVentas\Orden;
use sisVentas\OrdenDetalle;
use sisVentas\Vehiculo;
use sisVentas\Site;
use sisVentas\Personal;
use sisVentas\Cliente;
use sisVentas\Proveedor;
use sisVentas\TerminoPagoAR;
use sisVentas\TerminoPagoCP;
use sisVentas\Uom;
use sisVentas\UserSite;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Client;
use Illuminate\Support\Facades\DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

 

class OrdenController extends Controller
{
        protected $currencies = [];
        protected $classes = [];
        protected $sellers = [];
        protected $items = [];
        protected $uoms = [];
        protected $taxes = [];
        protected $terms = [];
        protected $fletes = [];
        protected $ships = [];
        protected $fobs = [];
        protected $enttityTax = 0;


 


    public function makeLists()
    {
        $this->currencies = ['' => 'Seleccione la moneda'] + Moneda::orderBy('descripcion', 'ASC')->get()->pluck('descripcion', 'currency_code')->toArray();

        $this->buyers = ['' => 'Seleccione el comprador'] + 
            Buyer::where('enabled', 1)->orderBy('agent_id', 'ASC')->get()->pluck('buyer_name', 'agent_id')->toArray();  

        $this->vehiculos  = ['' => 'Seleccione el vehiculo'] + 
            Vehiculo::where('no_atender', 0)->orderBy('placa', 'ASC')
                        ->get()->pluck('placa', 'id')->toArray();  
 
        $this->uoms = ['' => 'Seleccione el unidad de medida'] + Uom::orderBy('uom_code', 'ASC')->get()->pluck('uom_code', 'uom_code')->toArray();

        $this->vendors = ['' => 'Seleccione el Proveedor'] + Proveedor::orderBy('vendor_name', 'ASC')->get()->pluck('vendor_name', 'vendor_id')->toArray();

        $entity = Entity::all();

        $this->enttityTax = ($entity->count() > 0) ? $entity[0]['code_tax'] : null;

        $this->direnv =  ['' => 'Seleccione  dirección'] + Direccion::orderBy('location_id', 'ASC')->where('enabled', 1)->where('ship_to_site_flag', 1)->get()->pluck('description', 'location_id')->toArray();

        $this->dirfac =  ['' => 'Seleccione  dirección'] + Direccion::orderBy('location_id', 'ASC')->where('enabled', 1)->where('bill_to_site_flag', 1)->get()->pluck('description', 'location_id')->toArray();

        $this->terms = ['' => 'Seleccione el tipo de pago'] + TerminoPagoCP::orderBy('ap_term_id', 'ASC')->get()->pluck('description', 'ap_term_id')->toArray();    

        $type = FndLookup::where('lookup_type', 'TIPO_OC')->first();
        $type = (isset($type)) ? $type->fndLookupValue->pluck('description', 'code_value')->toArray() : [];
        $this->types = ['' => 'Seleccione el tipo'] + $type;        

        
        $tipomant  = FndLookup::where('lookup_type', 'EAM_TYPE_MAINTENANCE')->first();
        $tipomant  = (isset($tipomant )) ? $tipomant ->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : [];
        $this->tipomant = ['' => 'Seleccione el tipo'] + $tipomant ; 

        $fletes =  FndLookup::where('lookup_type', 'FREIGHT_TERMS')->first();
        $fletes = (isset($fletes) ? $fletes->fndLookupValue->pluck('description', 'code_value')->toArray() : []);
        $this->fletes = ['' => 'Seleccione el tipo de flete'] + $fletes;  

        $ships = FndLookup::where('lookup_type', 'SHIP_VIA')->first();
        $ships = (isset($ships)) ? $ships->fndLookupValue->pluck('description', 'code_value')->toArray() : [];
        $this->ships = ['' => 'Seleccione el transportista'] + $ships;    

        $fobs = FndLookup::where('lookup_type', 'FOB')->first();
        $fobs = isset($fobs) ? $fobs->fndLookupValue->pluck('description', 'code_value')->toArray() : [];
        $this->fobs = ['' => 'Seleccione el FOB'] + $fobs;                                    
    }

    public function sendMailToVendor(Request $req)
     {
             $data = $req->all();

            //dd($req);

             

             $user = FsetupReminder::all();
             $name = 'ddddd.xls';
             $ruta = asset("excel/exports/tempPurchaseOrden/". $name);  
             
             $separador = ","; 
             $mi_cadena = $user[0]->cc;

             $array = explode($separador,$mi_cadena); 
         
       $correo = 'julio.yanarico@asvnets.com' ; //$req->input('x');
       $c1 = $user[0]->correode;
      // return $c1;

        Mail::send('email.message', ['user' => $user], function ($m) use ($user, $correo, $array) {
            $m->from($user[0]->correode, 'Your Application');

            $m->to($correo); //->cc($array)
            $m->subject($user[0]->asunto);
            $m->attach($ruta, [
                'as' => $name,
                'mime' => 'application/pdf'
                ]);
            
        });
         

     }

    public function downloadResumenPoXls($archivo)
    {
        $archivo = $archivo .".xls";
        return response()->download(storage_path('excel/tempfiles/'.Auth()->user()->id.'/' .$archivo));


    }
	
	//route:	query/queryorder
    public function query(Request $request)
    {   //  AsCotizacion::whereYear('created_at','=', $year)->get(); 

        $site_id = $request->get('site_id');
  
        $placa=1;
        $mytime = Carbon::now()->format('d.m.Y H-i-s');
       // $mytime->toDateTimeString();
        $varname =  $mytime;
        $pfilename = 'Ordenes consultados_' .$varname ;
        //dd($varname );

        $v= $request->get('opt_resultado');
         

        if ($v == "C")
        {    
            $ordenes = Orden::where('po_headers_all.site_id','=', $site_id)->search($request)->get();
            /*
            Excel::create($pfilename, function($excel) use ($ordenes){
                $excel->sheet('Listado', function($sheet) use ($ordenes){
                    $placa=1;
                    $sheet->loadView('compras.orden.excel.exportqueryH')->with('placa', $placa)->with('ordenes', $ordenes);
                });
            })->store('xls', storage_path('excel/tempfiles/'.Auth()->user()->id.'/'));
            */
            //dd($ordenes);
            return view('compras.orden.excel.resultHeaders')->with('ordenes', $ordenes)
				->with('placa', $placa)->with('placa', $placa)->with('pfilename', $pfilename);

        }
        elseif ($v == "L")
        {
            $ordenes = Orden::where('po_headers_all.site_id','=', $site_id)->searchLines($request)->get();
            /* 
            Excel::create($pfilename, function($excel) use ($ordenes){
                $excel->sheet('Listado', function($sheet) use ($ordenes){
                    $placa=1;
                    $sheet->loadView('compras.orden.excel.exportqueryL')->with('placa', $placa)->with('ordenes', $ordenes);
                });
            })->store('xls', storage_path('excel/tempfiles/'.Auth()->user()->id.'/'));
            */
            //dd($ordenes);
            return view('compras.orden.excel.resultLines')->with('ordenes', $ordenes)->with('placa', $placa)->with('placa', $placa)->with('pfilename', $pfilename);
        }    
    }

    //funciono hasta DIC-22 de ahi sale error 
    //Array and string offset access syntax with curly braces is deprecated
    //cause: since PHP 7.4 curly braces method to get individual characters inside a string has been deprecated, so change the above syntax into this:

    public function query_2022(Request $request)
    {   //  AsCotizacion::whereYear('created_at','=', $year)->get(); 

        $site_id = $request->get('site_id');
  
        $placa=1;
        $mytime = Carbon::now()->format('d.m.Y H-i-s');
       // $mytime->toDateTimeString();
        $varname =  $mytime;
        $pfilename = 'Ordenes consultados_' .$varname ;
        //dd($varname );

        $v= $request->get('opt_resultado');
         

        if ($v == "C")
        {    
            $ordenes = Orden::where('po_headers_all.site_id','=', $site_id)->search($request)->get();
             
            Excel::create($pfilename, function($excel) use ($ordenes){
                $excel->sheet('Listado', function($sheet) use ($ordenes){
                    $placa=1;
                    $sheet->loadView('compras.orden.excel.exportqueryH')->with('placa', $placa)->with('ordenes', $ordenes);
                });
            })->store('xls', storage_path('excel/tempfiles/'.Auth()->user()->id.'/'));
            //dd($ordenes);
            return view('compras.orden.excel.resultHeaders')->with('ordenes', $ordenes)->with('placa', $placa)->with('placa', $placa)->with('pfilename', $pfilename);

        }
        elseif ($v == "L")
        {
            $ordenes = Orden::where('po_headers_all.site_id','=', $site_id)->searchLines($request)->get();
            
            Excel::create($pfilename, function($excel) use ($ordenes){
                $excel->sheet('Listado', function($sheet) use ($ordenes){
                    $placa=1;
                    $sheet->loadView('compras.orden.excel.exportqueryL')->with('placa', $placa)->with('ordenes', $ordenes);
                });
            })->store('xls', storage_path('excel/tempfiles/'.Auth()->user()->id.'/'));
            //dd($ordenes);
            return view('compras.orden.excel.resultLines')->with('ordenes', $ordenes)->with('placa', $placa)->with('placa', $placa)->with('pfilename', $pfilename);
        }    
    }

    //historial de cotizaciones
    //route:    searchpurchase
   public function historial()

    {   
        $sucursales = Site::select('name', 'id')->where('condicion','=', 1)->orderBy('name', 'ASC')->get();
        $vendor = Proveedor::select('vendor_name', 'vendor_id')->orderBy('vendor_name', 'ASC')->get();
        //$buyers = Buyer::with('personal')->select('FULL_NAME', 'agent_id')->orderBy('PERSON_ID', 'ASC')->get();

        $buyers = ['' => 'Seleccione el compradorS'] + 
            Buyer::orderBy('agent_id', 'ASC')->get()->pluck('buyer_name', 'agent_id')->toArray();   

        $tipomant  = FndLookup::where('lookup_type', 'EAM_TYPE_MAINTENANCE')->first();
        $tipomant  = (isset($tipomant )) ? $tipomant ->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : [];
        $tipomant = ['' => 'Seleccione el tipo'] + $tipomant ; 

        $vehiculo  = ['' => 'Seleccione el vehiculo'] + 
            Vehiculo::where('no_atender', 0)->orderBy('placa', 'ASC')
                        ->get()->pluck('placa', 'id')->toArray();   
 
       //  dd($buyers);
        $direnv = Direccion::select('location_code', 'location_id')->where('ship_to_site_flag','=',1)->orderBy('location_code', 'ASC')->get();
  
        $dirfac = Direccion::select('location_code', 'location_id')->where('bill_to_site_flag','=',1)->orderBy('location_code', 'ASC')->get();


  
        return view('compras.orden.filters')->with('buyers',$buyers)
                                            ->with('sucursales',$sucursales)
                                            ->with('vendors',$vendor)
                                            ->with('dirfac',$dirfac)
                                            ->with('direnv',$direnv)
                                            ->with('direnv',$direnv)
                                            ->with('tipomant',$tipomant);

    }
 

    public function index(Request $request)
    {   
        $site_id = Session::get('site_id');
        
		$rsOrders = Orden::orderBy('created_at', 'desc')
                    //->where ('type_system', 'Taller')
                    ->get(); 

        //$rsOrders = Orden::where('site_id','=', $site_id)->orderBy('created_at', 'desc')->get(); 


        return view('orden.index')->with('rsOrders', $rsOrders);         

    }

    public function create()
    {
            $this->makeLists();
             
            $direnv = $this->direnv;
            
            $currencies = $this->currencies;
            $uoms = $this->uoms;            
                    
            $types = $this->types;            
            $buyers = $this->buyers;
            $terms = $this->terms;            
            $fletes = $this->fletes;
            $ships = $this->ships;  
            $fobs = $this->fobs;
            $tipomant = $this->tipomant;   
            $dirfac = $this->dirfac;
            $operacion = 'Create';
            $locations  = $this->dirfac ; 
            $vehiculos  = $this->vehiculos ; 

            //$vehiculos = Vehiculo::where('no_atender', 0)->orderBy('placa', 'ASC')->lists('placa', 'id');
  
            $rates =  DailyRate::where('conversion_date', date_format(Carbon::now(),"Y-m-d"))->get()->pluck('from_currency');

            $defaultCurrency = Entity::first()->currency_code;
 
            //****** validando sucurssal

            //dd(Session::get('site_id') ) ;

			//*****<I> get site unique ****************
				$ds_tmp1 = Site::where('condicion',1)->get();
				$c = $ds_tmp1->count(); 

				If ($c == 1 ){
					$site_id = $ds_tmp1[0]->id;
					$ds_site = Site::where('id',$site_id)->first();
					$site_name = $ds_site->name;
				}
				else{
					$site_id = Session::get('site_id');  
					 
					if( $site_id  > 0){
						$ds_site = Site::where('id',$site_id)->first();
						$site_name = $ds_site->name;
					}
					else
					{
						 $site_name = 'Seleccione sucursal';
					}
				}      

				$tittle = $site_name;  
				 
				//dd($site_id);
				//*****<F> get site unique **************** 

				//*****<I> validate site_id choose**************** 
				if ($site_id > 0 ) 
					null;
				else{
					$msgerr = 'Seleccione sucursal - POERR001';
					Flash::error($msgerr)->important();
					return view('util.errorsMsg') ;
				}
			//*****<F> validate site_id choose****************  
        
        if($site_id > 0)

            return view("compras.orden.create", compact('currencies', 'uoms', 'types', 'buyers', 'terms','fletes','ships','fobs', 'locations', 'rates', 'defaultCurrency','vehiculos','operacion','dirfac', 'direnv' ,'tipomant')); 
        
        else
            return Redirect::back()->withErrors( "No selecciono ninguna Sucursal")->withInput();

    }



 

    public function show($id)
    {
            $this->makeLists();

            $currencies = $this->currencies;
            $uoms = $this->uoms;                        
            $dirfac = $this->dirfac; 
            $tipomant = $this->tipomant;   
            $types = $this->types;            
            $buyers = $this->buyers;
            $terms = $this->terms;
            $fletes = $this->fletes;
            $ships = $this->ships;
            $direnv = $this->direnv;
            $fobs = $this->fobs;           
            $operacion = 'Edit';
            $rates =  DailyRate::where('conversion_date', date_format(Carbon::now(),"Y-m-d"))->get()->pluck('from_currency');

            $vehiculos = Vehiculo::where('no_atender', 0)->orderBy('placa', 'ASC')->lists('placa', 'id');
              /*  
             $vehiculos = Vehiculo::where('no_atender', 0)
                                    ->where('site_id',$site_id)
                                    ->orderBy('placa', 'ASC')
                                    ->lists('placa', 'id');
            */
            $defaultCurrency = Entity::first()->currency_code;            
            //$site_id = Session::get('site_id');
           //$purchaseOrder =  Orden::find($id); //23.03.20
            $purchaseOrder = Orden::with('attachedDocuments')
                                    ->where('po_header_id',$id)
                                    //->where('site_id',$site_id)
                                    ->first();

        //dd($purchaseOrder);
            //if(Session::get('site_id')>0)
                return view("compras.orden.show", compact('purchaseOrder', 'currencies', 'uoms',  'types', 'buyers', 'terms','fletes','ships','fobs', 'defaultCurrency', 'dirfac', 'direnv','rates', 'purchaseOrder','tipomant','vehiculos','operacion')); 
            //else
             //   return Redirect::back()->withErrors( "No selecciono ninguna Sucursal")->withInput();

    }   

    public function store(Request $request)
    {
        //dd(request()->all());
        $this->validate($request, [
                'vendor_id' => 'required|',
                'ship_to_location_id' => 'required',
                'bill_to_location_id' => 'required',
                'type_lookup_code' => 'required',
                'currency_code' => 'required',
                'agent_id' => 'required',
                //'id_type_maintenance' => 'required', 
        ]);
		
		//*****<I> get site unique ****************
		$ds_tmp1 = Site::where('condicion',1)->get();
		$c = $ds_tmp1->count(); 
		dd($c);
		If ($c == 1 ){
            $ds_site = Site::where('condicion',1)->first();
            $site_id = $ds_site->id;            
            $site_name = $ds_site->name;
		}
		else{
			$site_id = Session::get('site_id');  
			 
			if( $site_id  > 0){
				$ds_site = Site::where('id',$site_id)->first();
				$site_name = $ds_site->name;
			}
			else
			{
				 $site_name = 'Seleccione sucursal';
			}
		}      

		$tittle = $site_name;  
		 
		//dd($site_id);
		//*****<F> get site unique **************** 

		//*****<I> validate site_id choose**************** 
		if ($site_id > 0 ) 
			null;
		else{
			$msgerr = 'Seleccione sucursal - POERR002';
			Flash::error($msgerr)->important();
			return view('util.errorsMsg') ;
		}
		//*****<F> validate site_id choose****************  

        $comments = $request->get('comments');
        $vehicule_id = $request->get('vehicule_id');

        $entity = Entity::first();
        //$segment1 = Orden::count() + 1;
        $segment1 = DB::select( DB::raw(" select MAX( CONVERT(segment1,UNSIGNED INTEGER)) AS num FROM po_headers_all"));

        $numoc = $segment1[0]->num ;
        $segment1 = $numoc  +   1  ;
        $purchaseOrder = Orden::create($request->except('_token'));
        $purchaseOrder->segment1 = $segment1;
        $purchaseOrder->comments = $comments;
        $purchaseOrder->project = $request->get('project');
        $purchaseOrder->luger_entrega = $request->get('luger_entrega');
         $purchaseOrder->forma_pago = $request->get('forma_pago');
        $purchaseOrder->contacto =  $request->get('contacto');
        $purchaseOrder->work_order_num = $request->get('work_order_num');
        $purchaseOrder->id_type_maintenance = $request->get('id_type_maintenance');
        $purchaseOrder->type_system = 'Taller';
        $purchaseOrder->rate_type = $entity->type_convertion;
        $purchaseOrder->rate_date = $purchaseOrder->created_at;
        $purchaseOrder->rate = $purchaseOrder->rate_amount;
        $purchaseOrder->authorization_status = 'INCOMPLETE';
        $purchaseOrder->site_id = $site_id;
        $purchaseOrder->last_updated_by = Auth::user()->id;
        $purchaseOrder->created_by = Auth::user()->id;
        $purchaseOrder->vehicule_id = $vehicule_id;
        $purchaseOrder->save();


        if ($request->hasFile('file')) 
        {
          // $this->validate($request, [
          //     'file' => 'bail|max:2000|mimes:jpeg,jpg,bmp,png',
          //     'desc' => 'bail|max:2000|mimes:jpeg,jpg,bmp,png',
          // ],['max' => 'El Archivo debe ser de 2MB o menos']);
          $files = $request->file('file');
         
          $documento = $purchaseOrder->site_id."_".$purchaseOrder->segment1."_".$request->file('file')->getClientOriginalName();
          $destination = base_path() . '/public/documents/OrdenController';
          try {
            $request->file('file')->move($destination, $documento);
          } catch (\Exception $e) {
            // dd('paso1');
            DB::rollback();
          }
          try {
            $saveFile = FndAttachedDocuments::create([
                                                      'pk1_value' => $purchaseOrder->po_header_id,
                                                      'path_file' => $destination.'/'.$documento,
                                                      'description' => $request->description_adjunto,
                                                      'entity_name' => 'Purchase Order',
                                                      'name_file' => $documento,
                                                      'created_by' => Auth::user()->id,
                                                      'last_updated_by' => Auth::user()->id,
                                                    ]);
          } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
          }
        }
        DB::commit();

        Flash::success("Se ha registrado de manera exitosa!")->important();
       // dd($purchaseOrder);

        return redirect('compras/orden/' . $purchaseOrder->po_header_id);
    }


    public function storeStd(Request $request)
    {
        //dd(request()->all());
        $this->validate($request, [
                'vendor_id' => 'required|',
                'ship_to_location_id' => 'required',
                'bill_to_location_id' => 'required',
                'type_lookup_code' => 'required',
                'currency_code' => 'required',
                'agent_id' => 'required',
                
        ]);

        $comments = $request->get('comments');
        $vehicule_id = $request->get('vehicule_id');

        $entity = Entity::first();
        //$segment1 = Orden::count() + 1;
        $segment1 = DB::select( DB::raw(" select MAX( CONVERT(segment1,UNSIGNED INTEGER)) AS num FROM po_headers_all"));

        $numoc = $segment1[0]->num ;
        $segment1 = $numoc  +   1  ;
        $purchaseOrder = Orden::create($request->except('_token'));
        $purchaseOrder->segment1 = $segment1;
        $purchaseOrder->comments = $comments;
        //$purchaseOrder->project = $request->get('project');
        //$purchaseOrder->luger_entrega = $request->get('luger_entrega');
        $purchaseOrder->forma_pago = $request->get('forma_pago');
        $purchaseOrder->contacto =  $request->get('contacto');
        //$purchaseOrder->work_order_num = $request->get('work_order_num');
       /// $purchaseOrder->id_type_maintenance = $request->get('id_type_maintenance');
        $purchaseOrder->rate_type = $entity->type_convertion;
        $purchaseOrder->rate_date = $purchaseOrder->created_at;
        $purchaseOrder->rate = $purchaseOrder->rate_amount;
        $purchaseOrder->authorization_status = 'INCOMPLETE';
        $purchaseOrder->site_id = Session::get('site_id');
        $purchaseOrder->last_updated_by = Auth::user()->id;
        $purchaseOrder->created_by = Auth::user()->id;
        $purchaseOrder->vehicule_id = $vehicule_id;
        $purchaseOrder->save();


        if ($request->hasFile('file')) 
        {
          // $this->validate($request, [
          //     'file' => 'bail|max:2000|mimes:jpeg,jpg,bmp,png',
          //     'desc' => 'bail|max:2000|mimes:jpeg,jpg,bmp,png',
          // ],['max' => 'El Archivo debe ser de 2MB o menos']);
          $files = $request->file('file');
         
          $documento = $purchaseOrder->site_id."_".$purchaseOrder->segment1."_".$request->file('file')->getClientOriginalName();
          $destination = base_path() . '/public/documents/OrdenController';
          try {
            $request->file('file')->move($destination, $documento);
          } catch (\Exception $e) {
            // dd('paso1');
            DB::rollback();
          }
          try {
            $saveFile = FndAttachedDocuments::create([
                          'pk1_value' => $purchaseOrder->po_header_id,
                          'path_file' => $destination.'/'.$documento,
                          'description' => $request->description_adjunto,
                          'entity_name' => 'Purchase Order',
                          'name_file' => $documento,
                          'created_by' => Auth::user()->id,
                          'last_updated_by' => Auth::user()->id,
                        ]);
          } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
          }
        }
        DB::commit();

        Flash::success("Se ha registrado de manera exitosa!")->important();
       // dd($purchaseOrder);

        return redirect('orden/standard2/' . $purchaseOrder->po_header_id);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
                'vendor_id' => 'required|',
                'ship_to_location_id' => 'required',
                'bill_to_location_id' => 'required',
                'agent_id' => 'required',
            ]);

        $purchaseOrder  = Orden::find($id);
        $comments = $request->get('comments');
        $purchaseOrder->fill($request->except('_token'));
        $purchaseOrder->last_updated_by = Auth::user()->id;     
        $purchaseOrder->site_id = Session::get('site_id');    
        $purchaseOrder->comments = $comments; 
        //2021.05.12 // javier mapfre
        $purchaseOrder->project = $request->get('project');
        $purchaseOrder->luger_entrega = $request->get('luger_entrega');
         $purchaseOrder->forma_pago = $request->get('forma_pago');
        $purchaseOrder->contacto =  $request->get('contacto');

        $vehicule_id = $request->get('vehicule_id');
        $purchaseOrder->vehicule_id = $vehicule_id;
        $purchaseOrder->work_order_num = $request->get('work_order_num');
        $purchaseOrder->id_type_maintenance = $request->get('id_type_maintenance');
       // dd($purchaseOrder);
         $purchaseOrder->save();

        //dd($request->input('file')[0]->getClientOriginalName());
        //INICIO ATTACH DOCUMENT 
        if ($request->hasFile('file')) 
        {
            //dd($purchaseOrder->site_id)  ;
          $files = $request->file('file');
         // dd($files);
          foreach($files as $file) {
            $documento = $purchaseOrder->site_id."_".$purchaseOrder->segment1."_".$file->getClientOriginalName();
            $destination = base_path() . '/public/documents/OrdenController/';
            try {
              $file->move($destination, $documento);
            } catch (\Exception $e) {
              // dd('paso1');
              DB::rollback();
            }
            try {
              $saveFile = FndAttachedDocuments::create([
                                                        'pk1_value' => $purchaseOrder->po_header_id,
                                                        'path_file' => $destination.'/'.$documento,
                                                        'description' => $request->description_adjunto,
                                                        'entity_name' => 'Purchase Order',
                                                        'name_file' => $documento,
                                                        'created_by' => Auth::user()->id,
                                                        'last_updated_by' => Auth::user()->id,
                                                      ]);
            } catch (\Exception $e) {
              // dd($e);
              DB::rollback();
            }
          }//fin foreach
        }
        
        DB::commit();
        //FIN ATTACHD DOCUMENT

         Flash::success("La Orden de Compra " .$purchaseOrder->segment1  ." ha sido editado con exito!")->important();

        return redirect('/compras/orden');
    }   

    public function delete($id)
    {
/*        $bill = Factura::find($id);
      return view('ventas.factura.delete', compact('bill'));  */
    }
    
    public function destroy($id)
    {
/*        $details = FacturaDetalle::where('customer_trx_id', $id)->get();

        if ($details->count() > 0)
        {                
            foreach ($details as $detail) {
                $detail->delete();
            }
        }  
              
        Factura::destroy($id);

        return redirect()->route('ventas.factura.index');*/
    }

    public function cancel($id)
    {
        $po = Orden::find($id);
        return view('compras.orden.cancel', compact('po'));  
    }

    public function setCancel($id)
    {
        $po = Orden::find($id);

        $po->authorization_status = 'CANCELLED'; //--cancelado

        $po->cancel_flag = 'Y';

        $po->closed_code = 'CANCEL';

        $po->closed_date = Carbon::now();

        $po->save();

        return redirect()->route('compras.orden.index');
    }

    public function approve($id)
    {
        $po = Orden::find($id);

        $po->authorization_status = 'APPROVED';   //aprobado
        
        $po->save();

        return ['message' => 'Orden aprobada'];
    }
    
    public function vendorList()
    {
        $vendors = Proveedor::with('tax')->get();

        
        return $vendors;
    }

    public function print2($id)
    {
        $order = Orden::find($id);
        $company = Entity::first();
        $userSite = UserSite::find(Session::get('site_id'));
        return view('compras.orden.order', compact('order', 'company', 'userSite'));
    }


         public function eliminarDocumento($id)
    {
      $fndAttach = FndAttachedDocuments::find($id);
      $file= $fndAttach->path_file;
      $destination = $file;
      \File::delete($destination);
      $fndAttach->delete();
      return back();
    }

}

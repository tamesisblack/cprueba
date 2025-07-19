<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

 use sisVentas\FndLookup;
use sisVentas\Inv_class_convertion;
use sisVentas\invOnhandQuantitiesDetail;
 use sisVentas\InvMaterialTrx; 
 use sisVentas\Proveedor;
use Illuminate\Support\Facades\Log;
use sisVentas\Http\Requests\ItemFormRequest;
use sisVentas\Item;
use sisVentas\Categoria;
use sisVentas\Locator;
use sisVentas\Uom;
use sisVentas\Labor;
use sisVentas\Site;
use sisVentas\SiteParameters;
use sisVentas\Marca;
use sisVentas\Modelo;
use sisVentas\ItemMma;
use sisVentas\User;
use sisVentas\MarcaItem;
use sisVentas\createby;
use Illuminate\Support\Facades\Validator;
use sisVentas\OnHand;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use sisVentas\Http\Requests;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use sisVentas\Components;
use sisVentas\Http\Controllers\TabSucursalesController;
 

class ItemController extends Controller
{   

    //form: ARITCM1
    public function components(Item $item) 
    {
 
      /*<I> reconocimiento de almacen principal*/
        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();        
        $master_id = $ds_parameters->site_id;
      //  dd($master_id);
        /*<F> reconocimiento de almacen principal*/

      $item->load('components.item');

      $components = Item::where('site_id', $master_id)
                        ->get();
                        //where('type_component', 'Component')
                        

      // dd($components);                
      return view('almacen.item.components', compact('item', 'components'));
      
    }
    
    public function __construct()
    {
        $this->messages = [
            'id.require' => 'El identificador es requerido',
            'id.integer' => 'El identificador no es correcto',
        ];
    }

   public function getAll()
    {
        return Item::where('mtl_transactions_enabled_flag', 1)
            ->where('inventory_item_status_code', 'Active')
            ->where('inventory_item_flag', 1)->get();
    }

	public function generatePDF(){
        $sites = Site::get();

        $items = DB::table('inv_item')->select('inv_item.inv_item_id','inv_item.nombre', 'inv_item.list_price_per_unit', 'inv_sites.name', 'inv_item.site_id')
        ->join('inv_sites', 'inv_sites.id', '=', 'inv_item.site_id')
        ->get();
        
        $route = 'pdfs.includes.items_sites';

        $pdf = \PDF::loadView($route, compact('items','sites'));

        $name_pdf = 'Reporte Items x Sites';
        return $pdf->stream($name_pdf);
    }
	
    //route:    items/sucursal1
    public function index_by_site()
    {
        //$items = Item::orderBy('codigo', 'DESC')->get();
        //return view('almacen.item.index')->with('rsitems', $items);
        $tittle = 'Articulos de Sucursal: ';
        $type_view = 'Site';


        //*****<I> get site unique ****************
        $site_id = 0;

        $ds_tmp1 = Site::where('condicion',1)->get();
        $c = $ds_tmp1->count();      
        If ($c == 1 )
            $site_id = $ds_tmp1[0]->id;
        else {
            $site_id = Session::get('site_id');
            if ($site_id > 0 ) 
                null;
            else{
                $msgerr = 'Seleccione sucursal - InvTrxVal';
                Flash::error($msgerr)->important();
                return view('util.errorsMsg') ;
            }
            $ds_tmp2 = Site::where('id', $site_id )->first();
            $site_name = $ds_tmp2->name;
            $tittle = $tittle .$site_name;
        }
        //*****<F> get site unique **************** 

  

        $rsitems  = Item::where('site_id',$site_id)
                            ->with('categoria')
                            ->get();

        if($site_id > 0)
        { 
            return view('almacen.item.index', compact('rsitems','tittle','type_view'));
        }
         else
        {   $rsitems  = Item::where('organization_id', -1)->get();       
            Flash::error("Debe seleccionar sucursal")->important();
            return view('almacen.item.index', compact('rsitems','tittle','type_view'));
        } 

        
        //dd( $rsitems) ;
        
    }

    //historial de cotizaciones
    //route:    filter_items
    public function filter_in_master()
    {        
        $vendor = Proveedor::select('vendor_name', 'vendor_id')->orderBy('vendor_name', 'ASC')->get();
      
        $categorias = Categoria::orderBy('nombre', 'ASC')->where('condicion', 1)->get();
                    //lists('nombre', 'idcategoria');
 
        $marcaItem = MarcaItem::orderBy('name', 'ASC')->where('enabled', 1)->get();
                //->lists('name', 'id');

        $sucursales = Site::orderBy('name', 'asc')->where('condicion', 1)->get();      
        $sucursales_OLD = Site::orderBy('name', 'ASC')->where('condicion', 1)->lists('name', 'id');
  
        return view('almacen.item.filters')->with('categorias',$categorias)
                                           ->with('sucursales',$sucursales)
                                            ->with('vendors',$vendor)
                                            ->with('marcaItem',$marcaItem)
                                             ;

    }
	
	public function data(Request $request)
    {   
        /*<I> reconocimiento de almacen principal*/
        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();        
        $master_id = $ds_parameters->site_id;
        $ds_site = Site::where('id',$master_id)->first();
        /*<F> reconocimiento de almacen principal*/

        $items = Item::join('inv_categoria', 'inv_categoria.idcategoria', '=', 'inv_item.idcategoria')
        ->leftjoin('brand_item', 'brand_item.id', '=', 'inv_item.brand_id')
        ->leftjoin('inv_sites', 'inv_sites.id', '=', 'inv_item.site_id')
        ->where('site_id',$master_id )        
        ;
        

        if($request->codigo_item != '' && $request->codigo_item != null){
            $items = $items->where('inv_item.codigo', 'LIKE', '%'.$request->codigo_item.'%');
        }

        if($request->name_item != '' && $request->name_item != null){
            $items = $items->where('inv_item.nombre', 'LIKE', '%'.$request->name_item.'%');
        }

        if($request->categoria_id != '' && $request->categoria_id != null){
            $items = $items->where('inv_item.idcategoria', '=', $request->categoria_id);
        }

        if($request->marca_id != '' && $request->marca_id != null){
            $items = $items->where('inv_item.brand_id', '=', $request->marca_id);
        }

        if($request->creado_desde != '' && $request->creado_desde != null){
             //Ultimos 7 dias
            if($request->creado_desde == 1){
                $end_date = Carbon::now();
                $start_date = Carbon::now()->subdays(7);
                $items = $items->wherebetween('inv_item.created_at',[$start_date, $end_date]);
            }
             //Ultimos 15 dias
            if($request->creado_desde == 2){
                $end_date = Carbon::now();
                $start_date = Carbon::now()->subdays(15);
                $items = $items->wherebetween('inv_item.created_at',[$start_date, $end_date]);
            }
            //Ultimos 30 dias
            if($request->creado_desde == 3){
                $end_date = Carbon::now();
                $start_date = Carbon::now()->subdays(30);
                $items = $items->wherebetween('inv_item.created_at',[$start_date, $end_date]);
            }
        }

        if($request->estado_item != '' && $request->estado_item != null){
            $items = $items->where('inv_item.inventory_item_status_code', '=', $request->estado_item);
        }
        
        if($request->site_id != '' && $request->site_id != null){
            $items = $items->where('inv_item.site_id', '=', $request->site_id);
        }

        $items= $items->select('inv_item.*', 'inv_categoria.nombre as category_name', 'brand_item.name as brand_name', 'inv_sites.name as site_name')->get();

        //dd($items);

        $tittle = 'Maestro de articulos';

        return view('almacen.item.filters_result', compact('items','tittle','type_view'));

        /*
        return Datatables::of($items)
            ->editColumn('idcategoria', function ($row) {
                return $row->category_name;
            })
            ->editColumn('brand_id', function ($row) {
                return $row->brand_name;
            })
            ->editColumn('site_id', function ($row) {
                return $row->site_name;
            })
            ->make(true);
            */
    }

    //route:    proc_filter_items
    public function proc_filter_items(Request $request)
    {        
        /*  creado_desde
        <option value="1">Hace 1 semana</option>
        <option value="2">Hace 2 semanas</option>
        <option value="3">Este Mes</option>
        <option value="4">Inicio de los tiempos</option>
        */
        $tittle = 'Maestro de articulos';

        $site_id = $request->get('site_id');
        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();            
        $master_id = $ds_parameters->site_id;
 
        if ($site_id == $master_id || $site_id ==""  ){

            $ds_site = Site::where('id',$master_id)->first();
             
            $rsitems  = Item::where('site_id',$master_id)
                                ->with('categoria')->get();
           dd($rsitems );                     
        }
                            
        $codigo_item = $request->get('codigo_item');
        $desc_item = $request->get('desc_item');
        $categoria_id = $request->get('categoria_id');
        $marca_id = $request->get('marca_id');
        $creado_desde = $request->get('creado_desde');
        $date1 = $mytime = Carbon::now()->format('Y-m-d');

        
    dd($request);

        if($creado_desde == 1){
        $date2 = Carbon::now()->subDays(7)->format('Y-m-d');
        //$date2 =
        dd($date2);
        }
        $estado_item = $request->get('estado_item');

        $subinv_id = $request->get('subinv_id');

        $resultado = Item::where('site_id','=', $site_id)
                            ->get();

        $query = Item::where('1', 1)
                            ->where(function ($query) {
                                $query->where('datefield', '<', $date)
                                    ->orWhereNull('datefield');
                            }
                        )->get();

        $placa=1;
        $mytime = Carbon::now()->format('d.m.Y H-i-s');
       // $mytime->toDateTimeString();
        $varname =  $mytime;
        $pfilename = 'Ordenes consultados_' .$varname ;

  
        return view('almacen.item.index', compact('rsitems','tittle','type_view'));

    }

    public function AsignacionItems()
    {
       
    }   
    //master items
    //route:    items/master
    public function index()
    {
        
        $type_view = 'Master';


        //$items = Item::orderBy('codigo', 'DESC')->get();
        //return view('almacen.item.index')->with('rsitems', $items);

        /*<I> reconocimiento de almacen principal*/
        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();        
        $master_id = $ds_parameters->site_id;
        $ds_site = Site::where('id',$master_id)->first();
        /*<F> reconocimiento de almacen principal*/
 
        $tittle = 'Maestro de articulos - ' . $ds_site->name;

        $rsitems  = Item::where('site_id',$master_id)
                            ->with('categoria')->get();

        if( $master_id  > 0)
        { 
            return view('almacen.item.index', compact('rsitems','tittle','type_view'));
        }
         else
        {           
            Flash::error("No tiene configurado maestro de articulos")->important();
            //return view('almacen.trxvarias.blank', compact('TipoTrx'));
            return view('almacen.item.index', compact('rsitems','tittle','type_view'));
        } 

        
        //dd( $rsitems) ;
        
    }

 
    public function itemview()
    {
        
        $rsitems  = Item::with('categoria')->get();
        return view('almacen.itemview.index', compact('rsitems'));
    }

        public function itemMMAview()
    {
        
        $itemsmma = ItemMma::with('item', 'marca', 'modelo')->get();
        return view('almacen.itemMMAview.index', compact('itemsmma'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre', 'ASC')->where('condicion', 1)->lists('nombre', 'idcategoria');

        $labores = Labor::orderBy('nombrelabor', 'ASC')->lists('nombrelabor', 'idlabor');

        //$marcaItem = MarcaItem::orderBy('name', 'ASC')->where('enabled', 1)->lists('name', 'id');


        $marcaItem =  FndLookup::where('lookup_type', 'MARCA_ITEM')->first();
        $marcaItem = (isset($marcaItem) ? $marcaItem->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : []);

        $colorItem =  FndLookup::where('lookup_type', 'COLOR_ITEM')->first();
        $colorItem = (isset($colorItem) ? $colorItem->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : []);

        $tallaItem =  FndLookup::where('lookup_type', 'TALLA_ITEM')->first();
        $tallaItem = (isset($tallaItem) ? $tallaItem->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : []);

        $vendors = Proveedor::orderBy('vendor_name', 'ASC')
                    //->where('condicion', 1)
                    ->lists('vendor_id', 'vendor_name');

        $locs = Locator::orderBy('concaneted_segments', 'ASC')->where('enabled_flag', 1)->lists('concaneted_segments', 'location_id');

        $tipo_uom = Uom::orderBy('uom_code', 'ASC')->lists('uom_code', 'uom_code');

        $marcas = Marca::all();
        
        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();
        $master_id = $ds_parameters->site_id;
        $profit  = $ds_parameters->perce_profit;

        if( $master_id > 0)
        { 
             return view('almacen.item.create')->with('rsubica', $locs)->with('rscategorias', $categorias)
                    ->with('rstipo_uom', $tipo_uom)->with('vendors', $tipo_uom)
                    ->with('marcas', $marcas)->with('labores', $labores)
                    ->with('rsmarcaItem', $marcaItem)->with('rstallaItem', $tallaItem)->with('rscolorItem', $colorItem)
                    ->with('tProfit', $profit)
                  
					 ;
        }
         else
        {           
            Flash::error("Debe seleccionar sucursal para la transaccion")->important();
            return view('util.blank');
        } 
        
        
    }


    public function store(ItemFormRequest $request)
    {
             
$nombre_foto = null;
        if ($request->file('file_input') != null){
            $mime = $request->file('file_input')->getMimeType();
            if($mime === 'image/jpeg' || $mime === 'image/jpg' || $mime === 'image/png'){
                $size = getimagesize($request->file('file_input'));

                if ($size[0] < 401 && $size[1] < 401){
                    $weight = $_FILES['file_input']['size'];
                    //300000/1024 => 292 KB aprox
                    if ($weight < 300000){

                        $extension = strtolower($request->file('file_input')->getClientOriginalExtension());
                        $name = 'articulo_'.date("Y-m-d_H_i_s").'.'.$extension;
                        $path = base_path() . '\\public\\img_articulos\\';
                        $photo=$name;
                        $request->file('file_input')->move($path, $name);
                        $nombre_foto = $name;
                    }
                }
            }
        }

       
            $request = $request->all();
     //$asig = $request('rdSeleccion');
          // dd($request['rdSeleccion']);
       
       IF ($request['rdSeleccion'] <> '' ) {   
		 $asig = 0;
		// dd($asig);
         IF ($request['rdSeleccion'] == 'Generico' )
            $asig = 2;
         
         IF ($request['rdSeleccion'] == 'Especifico' )
            $asig = 3;
        }
     
    //dd($request['price_buy']);
    ///dd($request);
    //dd($request[0]['rdSeleccion']);


    //dd($request['perce_profit']);
        //$newItem->item_type = 'Kit';
        $request['created_by'] = Auth()->user()->id;
        $request['last_updated_by'] = Auth()->user()->id;
        //
        //return $request;
        $items = new Item($request);
 

        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();
        $master_id = $ds_parameters->site_id;
        $profit  = $ds_parameters->perce_profit;


        if ($request['perce_profit'] == 1 && $profit>0 ) {
            $profit1 = $profit / 100;
            $nprice1 = $profit1 * $request['price_buy'];
            $nprice2 = $nprice1 + $request['price_buy'];
            //dd($nprice2);
            $items->list_price_per_unit = $nprice2;

        }
        
        $loc_id = $items->locator_id;
        $ds_loc_id = Locator::where('location_id',$loc_id)->first();
        //if($ds_loc_id)
            $text_loc = strtoupper($ds_loc_id->description);
        $sub_of_loc_id = $ds_loc_id->subinventory_id;
        //dd($sub_of_loc_id);

        $codigo_inicial = $items->codigo;
        if ( $items->codigo == 'AUTOMATICO' or $items->codigo == 'AUTO' )
        {
            $segment1 = DB::select( DB::raw(" select MAX( CONVERT(codigo,UNSIGNED INTEGER)) AS num FROM inv_item"));

            $numoc = $segment1[0]->num ;
            $numoc  = $numoc + 1  ;
            $codigo = str_pad($numoc, 5, "0", STR_PAD_LEFT) ;
            $items->codigo = $codigo ;
        }

        if ( $items->codigo == 'AUTOMATICO_CATEGORIA' or 
                    $items->codigo == 'AUTO_CATEGORIA' )
        {      
            $cat_id = $items->idcategoria ;
            $ds_cat = Categoria::where ('idcategoria',$cat_id)->first();
            $alias_cat =  $ds_cat->codigo_correletv ;
            $ult_corre =  $ds_cat->ult_correlattivo ;            
            $codigo_correlat = str_pad($ult_corre + 1, 5, "0", STR_PAD_LEFT) ;

            $cod_fin = $alias_cat .'-' .$codigo_correlat;

            $items->codigo = $cod_fin ;
        }
        $items->name_img = $nombre_foto;
        
        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();
        $master_id = $ds_parameters->site_id;

        $items->organization_id = $master_id ;
        $items->site_id = $master_id ;		
        $items->save();
        $item_type_mas = $items->item_type; 
         

        $item_id = $items->inv_item_id;
        $item_type = $items->item_type;
        $stk_ini = $items->stk_initial;
 
        //actualiza correlativo de inv categoria
        if ( $codigo_inicial == 'AUTOMATICO_CATEGORIA' or 
                    $codigo_inicial == 'AUTO_CATEGORIA' )
        {      
            $cat_id = $items->idcategoria ;
             
            $findata = Categoria::find($cat_id);
            $findata->ult_correlattivo = $ult_corre + 1; 
            $findata->save();
            

        }
       
 
        
        Flash::success("Se ha registrado de manera exitosa!")->important();
        return redirect()->route('item/master');
    }

    public function show($id)
    {
        //$vehiculo = Vehiculo::findOrFail($id);

        //return view('asesor.vehiculo.show', compact('vehiculo'));
    }

    //form: INVITM2
	//route:	almacen/item/##/edit
    public function edit($id)
    {
        $items = Item::find($id);
		$sid_item = $items->site_id; //get site id by record item
		//dd($sid_item);
        $type_view = 'Site';
        $is_main = 'N';
        $profit  = 0;
        //*****<I> get site unique ****************
        $site_id = $sid_item; //Session::get('site_id');
		
        //dd($site_id);
        if($site_id > 0)
        { 
            /*<I> reconocimiento de almacen principal*/
            $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();  
                       
            if( $site_id  == $ds_parameters->site_id ){
                $type_view = 'Main';
                $profit  = $ds_parameters->perce_profit;
            }
            else 
                $type_view = 'Site';
     
            /*<F> reconocimiento de almacen principal*/
 
        }
         else
        {   //$rsitems  = Item::where('organization_id', -1)->get();       
            //Flash::error("Debe seleccionar sucursal")->important();
            //return view('almacen.item.index', compact('rsitems','tittle','type_view'));
        } 
        //*****<F> get site unique **************** 

		//--tab Sucursales------------------------------------------
    $categorias = Categoria::orderBy('nombre', 'ASC')->where('condicion', 1)->lists('nombre', 'idcategoria');

        $locs = Locator::orderBy('concaneted_segments', 'ASC')->where('enabled_flag', 1)->lists('concaneted_segments', 'location_id');

        $labores = Labor::orderBy('nombrelabor', 'ASC')->lists('nombrelabor', 'idlabor');

                $marcaItem =  FndLookup::where('lookup_type', 'MARCA_ITEM')->first();
        $marcaItem = (isset($marcaItem) ? $marcaItem->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : []);

        $colorItem =  FndLookup::where('lookup_type', 'COLOR_ITEM')->first();
        $colorItem = (isset($colorItem) ? $colorItem->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : []);

        $tallaItem =  FndLookup::where('lookup_type', 'TALLA_ITEM')->first();
        $tallaItem = (isset($tallaItem) ? $tallaItem->fndLookupValue->pluck('code_value', 'idlvalue')->toArray() : []);


        $tipo_uom = Uom::orderBy('uom_code', 'ASC')->lists('uom_code', 'uom_code');

        

          $vendors = Proveedor::orderBy('vendor_name', 'ASC')
                    //->where('condicion', 1)
                    ->lists('vendor_id', 'vendor_name');


        return view('almacen.item.edit')->with('rsubica', $locs)->with('rscategorias', $categorias)
            ->with('rsitems', $items)->with('type_view', $type_view)
            ->with('tProfit', $profit)
            ->with('labores', $labores) 
            ->with('rstipo_uom', $tipo_uom)->with('vendors', $vendors)->with('rsmarcaItem', $marcaItem);
    }

    //old: ItemFormRequest
    public function update(Request $request, Item $item)
    {
        if ($request->file('file_input') != null){
            $mime = $request->file('file_input')->getMimeType();
            if($mime === 'image/jpeg' || $mime === 'image/jpg' || $mime === 'image/png')
            {  
                $size = getimagesize($request->file('file_input'));
                // dd( $size) ;
                if ($size[0] < 401 && $size[1] < 401){
                    $weight = $_FILES['file_input']['size'];
					//300000/1024 => 292 KB aprox
                    if ($weight < 300000){
                        $extension = strtolower($request->file('file_input')->getClientOriginalExtension());
                        $name = 'articulo_'.date("Y-m-d_H_i_s").'.'.$extension;
                        $path = base_path() . '\\public\\img_articulos\\';
 
                         $photo=$name;
                         $request->file('file_input')->move($path, $name);
                         $nombre_foto = $name;
                    }
                }
            }
        }

        $request = $request->all();
        //dd($request);
       
         
		//<F> TAB SUCURSALES
		
        $request['last_updated_by'] = Auth()->user()->id;
        if(isset($nombre_foto))
            $request['name_img']=$nombre_foto;
      //dd( $request);
 
         

        $item->update($request);
        Flash::success("El articulo ha sido editado con exito!")->important();
        //return redirect()->route('almacen.item.index');
        return redirect()->route('item/master');
    }

    public function export(Request $request, Item $items)
    {
        Excel::create('Lista de items', function ($excel) {

            $excel->sheet('Listado', function ($sheet) {
                //show all fields table database
                $items = Item::orderBy('codigo', 'ASC')->get();
                //blade show a some fields table
                $sheet->loadView('almacen.item.excel.export')->with('items', $items);

                //$sheet->fromArray($items);

            });
        })->export('xls');
    }

    
     //obteniendo unidad de medida
     
    public function cat_item()
    {
        $rules = [
            'id' => 'required|integer',
        ];

        $v = $this->validator(\request()->all(),$rules);

        if ($v->fails())
        {
            return response()->json([
                'success' => false,
                'message' => $v->errors()
            ], 406);
        }

        return Item::where('inv_item_id',\request()->input('id'))->first();
        
        return 'hpla';
    }

    //view information history record
    public function showDataModal($id)
    {
        $data = Item::where('inv_item_id', $id)->first();
        $creator = \sisVentas\User::where('id', $data->created_by)->first();
        $updator = \sisVentas\User::where('id', $data->last_updated_by)->first();
         
        return view('modal.modal_body', compact('data', 'creator', 'updator' ));
    }
    
     private function validator(array $data,$rules)
    {
        return Validator::make($data, $rules,$this->messages);
    }

    //funciones para el modulode facturas/cc
    public function showFA($id)
    {
        $item = Item::find($id);

        return  $item;
    }

    public function indexFA()
    {
       $items =  Item::where('inventory_item_status_code', 'Active')
                ->where('mtl_transactions_enabled_flag', '1')
                ->with('categoria')
                ->orderBy('inv_item_id', 'ASC')
                ->get()
                ->toArray();

        return  $items;     
    }

    //funciones para el modulode compras/Orden
    public function showPO($id)
    {
        $item = Item::find($id);

        return  $item;
    }

    public function indexPO()
    {
       $items =  Item::where('inventory_item_status_code', 'Active')
                ->where('mtl_transactions_enabled_flag', '1')
                ->orderBy('inv_item_id', 'ASC')
                ->get()
                ->toArray();

        return  $items;     
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //usado en pos5/create
    //Llena tabla modal Selecciona una o varios articulos - Todos
    //route: items/search //form SLCH1
    public function findItem(Request $request)
    {
		//dd($request);
		Log::info($request->all());  
		$site_id = $request->psite_id; 
		//dd($site_id);
      
 
        //*****<F> get site unique ****************   
        $result = array();
        if (!$request->ajax()) return redirect('/');
        
        //if there is no barcode and it is inline mode
        if (empty($request->code) && $request->mode == "inline") {
            return;
        }
        //Log::info($request->mode);

        if ($request->mode === 'inline') {
            $item = invOnhandQuantitiesDetail::join('inv_item as i', 'inv_onhand_quantities_detail.item_id', '=', 'i.inv_item_id')
            ->where('i.qb_upc_ean', $request->code)
            ->where('i.site_id', $site_id)
            ->select('inv_item_id', 'nombre as nombre_item', 'stcom as is_stcom', 
                'primary_transaction_quantity as stock_item', 'i.list_price_per_unit as price', 
                'idcategoria', 'primary_uom_code')
            //->take(1)
            ->get();
        } else {
             //ENTRA ACA CUADO ES POR MODAL
            $item_old = invOnhandQuantitiesDetail::join('inv_item as i', 'inv_onhand_quantities_detail.item_id', '=', 'i.inv_item_id')
            ->where('i.qb_upc_ean', $request->code)  
			->where('i.site_id', $site_id)			
            ->orWhere('i.nombre', "like", "%{$request->code}%")
            ->orWhere('i.descripcion', 'like', "%{$request->code}%")
            ->select('inv_item_id', 'nombre as nombre_item', 'stcom as is_stcom','primary_transaction_quantity as stock_item', 'i.list_price_per_unit as price', 'i.qb_upc_ean as ean', 'idcategoria', 'primary_uom_code')
            ->orderby('i.nombre', 'ASC')
            ->paginate(10);
			 

            $item = invOnhandQuantitiesDetail::join('inv_item as i', 'inv_onhand_quantities_detail.item_id', '=', 'i.inv_item_id')
											//->join('inv_onhand_quantities_detail','inv_onhand_quantities_detail.item_id','=','i.inv_item_id')	
											->where('i.site_id', 'inv_onhand_quantities_detail.site_id')		
											->where('i.qb_upc_ean', $request->code)
											->where('inv_onhand_quantities_detail.site_id', $site_id) 
											->where('i.site_id', $site_id)		
											->orWhere(function($query) use ($request) {
												$query->where('i.nombre', 'like', "%{$request->code}%")
														->orWhere('i.codigo', 'like', "%{$request->code}%");
													  //->orWhere('i.descripcion', 'like', "%{$request->code}%");
											})
											
											// Asumiendo que id_local está en esta tabla
											->select('inv_item_id','codigo', 'nombre as nombre_item', 'stcom as is_stcom', 
													'primary_transaction_quantity as stock_item_OLD', 'i.site_id',
													DB::raw('sum(round(inv_onhand_quantities_detail.primary_transaction_quantity,2)) as stock_item'),
													'i.list_price_per_unit as price', 'i.qb_upc_ean as ean', 'idcategoria', 'primary_uom_code')
											->groupBy('inv_onhand_quantities_detail.site_id','inv_onhand_quantities_detail.item_id',
														'inv_onhand_quantities_detail.transaction_uom_code')											 
											->orderby('i.nombre', 'ASC')
											->paginate(10);
						
        } 
        //$item = $item::where('site_id', $site_id);
        //Log::info($item );
        $data_uom = array();

        foreach ($item as $key => $i) {
            if ($i->site_id == $site_id) {
                $data_uom[$key]["cod_item"] = $i->codigo;
                $data_uom[$key]["inv_item_id"] = $i->inv_item_id;
                $data_uom[$key]["nombre_item"] = $i->nombre_item;
                
                //Get stock item by inv_item_id and uom
                /*$stock = invOnhandQuantitiesDetail::where('item_id', '=', $i->inv_item_id)
                ->where('site_id', '=', 4)
                ->where('transaction_uom_code', $i->primary_uom_code)
                ->take(1)
                ->first();
                
                ($stock['primary_transaction_quantity']) ? $stock['primary_transaction_quantity'] : 0; //*/
                $data_uom[$key]["stock_item"] = $i->stock_item;            
                $data_uom[$key]["price"] = $i->price;
                $data_uom[$key]["ean"] = $i->ean;
                //$data_uom[$key]["ean"] = $i->ean;
                $data_uom[$key]["stcom"] = $i->is_stcom;
                $data_uom[$key]["idcategoria"] = $i->idcategoria;
                $data_uom[$key]["primary_uom_code"] = $i->primary_uom_code;
                
                $uom = Uom::select('uom_code', 'iduom', 'description')->whereIn('idclase', static function ($q) use ($i) {
                    $q->select('idclase')->from((new Uom)->getTable())
                    ->where('uom_code', $i->primary_uom_code);
                })->get();
                $data_uom[$key]["uom"] = $uom;
            }
        }

        if ($item) {
            $result = array(
                "status" => 1,
                "type" => "success",
                "message" => "Item localizado",
                "data" => $data_uom             
            );
        } else {
            $result = array(
                "status" => 0,
                "type" => "error",
                "message" => "Item no localizado",
                "data" => array()
            );
        }
        return response()->json($result);
    }

    public function getConvertionRate(Request $request) {
        $CR = Inv_class_convertion::where('from_uom_code', $request->uom)
        ->where('to_uom_code', $request->uom_primary)
        ->select('convertion_rate')
        ->first();


        dd($CR);
        return response()->json($CR);
    }


}

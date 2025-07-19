<?php
 
namespace sisVentas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

use sisVentas\Locator;
use sisVentas\Inv_Onhand_Quantities_Detail;
use DB;

class Item extends Model
{
    protected $table = "inv_item";
    
 	protected $primaryKey = 'inv_item_id';

    public $timestamps=true;

    protected $fillable = ['codigo','nombre','descripcion'
    						,'inventory_item_flag',
                            'stock_enabled_flag',
                            'mtl_transactions_enabled_flag',
                            'idcategoria','import_flag',
							'sub_inv_id', 'organization_id',
                            'locator_id',
                            'primary_uom_code',
                            'last_updated_by',
                            'created_by',
                            'purchasing_item_flag',
                            'allow_item_desc_update_flag',
                            'list_price_per_unit',
                            'price_buy','perce_profit',
                            'itend',
                            'item_type','type_component',
                            'inventory_item_status_code',
                            'inventory_planning_code',
                            'min_minmax_quantity',
                            'max_minmax_quantity',
                            'service_item_flag',
                            'invoiceable_item_flag',
                            'returnable_flag',
                            'reserve_without_stock',
                            'customer_order_enabled_flag',
                             'percentage_of_sale',
                             'qb_upc_ean',
                             'sell_carwash',
                             'item_cost',
							 'item_cost',
                             'sub_item_id',
                             'site_id',
                              'name_img',
                              'labor_id',
                             'show_to_web',  
                             'stk_initial',
                             'stcom' //Validar Stock para productos terminados
							 ];

   
    //2021.08.26
    public function components_item()
    {
        return $this->hasMany(Component::class, 'item_id');
    }
	
	public function components () {
        return $this->hasMany(Components::class, 'header_id');
    }

 
     public function categoria()
    {
        //return $this->belongsTo('sisVentas\Categoria', 'idcategoria', 'idcategoria');
         return $this->belongsTo(Categoria::class, 'idcategoria');
    }
 
      public function ubicacion()
    {        
         return $this->belongsTo(Locator::class, 'locator_id');
    }

	 //YASER - ITEM-MMA
	 public function mma()
	{
		return $this->hasMany(ItemMma::class, 'item_id');
	}

	//despacho de materiales
	 public function locator()
    {
        return $this->belongsTo(Locator::class, 'locator_id','location_id');
    }

    public function validateStock()
    {
        return $this->belongsTo(Inv_Onhand_Quantities_Detail::class,'inv_item_id','item_id');
    }
	
	//recepcion de OC
	    public function polinesall()
    {
        return $this->hasMany('sisVentas\PoLinesAll', 'item_id');
    }

  public function lineas_pendiete_despacho()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id')->where('eam_work_material.enabled','=',1)->whereIn('status_delivered', ['PARTIAL','UNDELIVERED'])->select(DB::raw('eam_material_id as cant_desp'));
         
    }

    //para reporte de consulta de costos por item
    public function StockbyItem ()
    {    
        $site_id = Session::get('site_id');

         return $this->hasMany(OnHand::class,'onhand_quantities_id')->where('inv_onhand_quantities_detail.site_id','=', $site_id )->select(DB::raw(' SUM(primary_transaction_quantity) as cant_stock'));
  
    }
	 
    public function getPrecio($id){
        $data = DB::table('inv_item')->select('list_price_per_unit')->where(function($q){
            $q->where('inv_item_id','=',$this->inv_item_id)
            ->orWhere('sub_item_id','=',$this->inv_item_id);
        })->where('site_id','=',$id)->first();
        return $data != null ? $data->list_price_per_unit : 0;
    }


    public function scopeSearch($query, $date)
    { 
        $codigo_item=array_get($date, 'codigo_item', false);
        $desc_item=array_get($date, 'desc_item', false);
        $site_id=array_get($date, 'site_id', false);
        $categoria_id=array_get($date, 'categoria_id', false);
        $marca_id=array_get($date, 'marca_id', false);
        $creado_modo=array_get($date, 'creado_modo', false);
        $estado_item=array_get($date, 'estado_item', false);
        $subinv_id=array_get($date, 'subinv_id', false);
               
        return $query
            ->join('fnd_lookup_value', 'fnd_lookup_value.idlvalue', '=', 'po_headers_all.id_type_maintenance')
            ->join('inv_sites', 'inv_sites.id', '=', 'po_headers_all.site_id')
            ->join('po_vendor', 'po_vendor.vendor_id', '=', 'po_headers_all.vendor_id')
            ->join('ap_tax_codes_all', 'ap_tax_codes_all.id', '=', 'po_vendor.tax_id')
            ->join('vehiculo', 'vehiculo.id', '=', 'po_headers_all.vehicule_id')
             ->leftjoin('fnd_lookup_value as tipove', 'tipove.idlvalue', '=', 'vehiculo.idtype')
            ->join('po_agents', 'po_agents.agent_id', '=', 'po_headers_all.agent_id')
            ->join('hr_per_people_inf', 'hr_per_people_inf.PERSON_ID', '=', 'po_agents.PERSON_ID')
            ->join('hr_location', 'hr_location.location_id', '=', 'po_headers_all.bill_to_location_id')
   

            ->when($site_id, function ($query) use ($site_id) {
                return $query->where('inv_sites.id', $site_id);
            })
            ->when($numoc, function ($query) use ($numoc) {
                return $query->where('po_headers_all.segment1', $numoc);
            })
            ->when($vendor_id, function ($query) use ($vendor_id) {
                return $query->where('po_headers_all.vendor_id', $vendor_id);
            })
            ->when($agent_id, function ($query) use ($agent_id) {
                return $query->where('po_agents.agent_id', $agent_id);
            })
            ->when($placa, function ($query) use ($placa) {
                return $query->where('vehiculo.placa', $placa);
            })
            ->when($moneda, function ($query) use ($moneda) {
                return $query->where('po_headers_all.currency_code', $moneda);
            })
            ->when($type_mant_id, function ($query) use ($type_mant_id) {
                return $query->where('po_headers_all.id_type_maintenance', $type_mant_id);
            })
            ->when($fecdesde, function ($query) use ($fecdesde, $fechasta) {

                $from = date('Y-m-d'. ' 00:00:00', strtotime($fecdesde) );   
                $to = date('Y-m-d'. ' 23:59:00', strtotime($fechasta) ); 

                return $query->whereBetween('po_headers_all.created_at', [$from, $to]);
            })
            ->select('inv_sites.name as sucursal', 'po_headers_all.segment1 as numorden',   'po_vendor.vendor_name as proveedor', 'ap_tax_codes_all.tax_rate as tax_porc', 'po_headers_all.currency_code as moneda', 'vehiculo.placa as placa', 'hr_per_people_inf.FULL_NAME as comprador', 'hr_location.location_code as facturacion', 'po_headers_all.created_at as fec_creacion',  'po_headers_all.po_header_id as po_header_id','po_headers_all.authorization_status as status_order',
              'tipove.description as descr_tip_veh',
              'fnd_lookup_value.description as descr_tip_mant');
            

            //dd($query  );
            /*
              ->when($fecdesde, function ($query) use ($fecdesde) 
              {
                $fecdesde=\Carbon\Carbon::parse($fecdesde)->format('Y-m-d');
                return $query->where('po_headers_all.created_at', '>=',$fecdesde);
            })
            ->when($fechasta, function ($query) use ($fechasta) {
                $fechasta=\Carbon\Carbon::parse($fechasta)->format('Y-m-d');
                return $query->where('po_headers_all.created_at', '<=', $fechasta);
            })
            */
    }
}

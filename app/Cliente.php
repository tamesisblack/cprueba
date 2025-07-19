<?php

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use DB;

class Cliente extends Model
{
    protected $table = 'cliente';

    public $timestamps= true;

    protected $fillable = ['idcliente', 'first_name', 'second_name', 'first_last_name', 'second_last_name', 'site_id', 'method_created',
    'full_name', 'date_of_birth', 'effective_end_date','sex', 'tipo_documento', 'num_documento',  'type_customer','department_id','province_id',
        'district_id',
        'email_address', 'telef1', 'telef2',  'disccount', 'country', 'address',
        'created_by', 'last_updated_by','updated_at','created_at',
        'contacto','no_atender','motivo_no_atencion'];

    protected $primaryKey = 'idcliente';

  public function vehiculos()
    {
        return $this->hasMany('sisVentas\Vehiculo');
    }
    

    public function historialpuntos()
    {
        return $this->hasMany(PromotionAcumulate::class,'customer_id','idcliente')->orderby('transaction_date','desc');
    }

      public function puntos()
    {
       // return $this->hasMany('sisVentas\PromotionAcumulate');
        return $this->hasMany(PromotionAcumulate::class,'customer_id','idcliente')
                    ->select(DB::raw('sum(quantity_points) as totalpuntos'));
    }

//CODIGO PARA RELACIONAR CON LAS TABLAS

    public function tipo_docOLD()
    {
        return $this->hasOne('App\Tipo_docs');
    }
 
      public function tipo_doc()
    {
        return $this->hasOne(Tipo_docs::class,'idtipo_doc','tipo_documento');
    }

     public function tipo_doc2()
    {
        return $this->hasOne(FndLookupValue::class,'idlvalue','tipo_documento');
    }
  

 
public function getDATEOFBIRTHAttribute($date)
{
    if($date != '0000-00-00'){
    return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
    }
    return '';
}

public function setDATEOFBIRTHAttribute($date)
    {
        if($date == ''){
            $this->attributes['date_of_birth'] = \Carbon\Carbon::parse('0000-00-00')->format('Y-m-d');
        }else{
            $this->attributes['date_of_birth'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
    }
        


public function getEFFECTIVEENDDATEAttribute($date)
{
   return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
}


public function setEFFECTIVEENDDATEAttribute($date)
{
   $this->attributes['effective_end_date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
}


public function getDniAttribute()
{
    return $this->num_documento;
}


	public function ordentrabajo()
    {
        return $this->hasMany(WorkOrder::class,'owner_id','idcliente')->orderBy('created_at','desc');
    }

            
       public function mano_obraActivo_completed()
    { return $this->hasMany(WorkOrder::class,'owner_id','idcliente')
            ->where('eam_work_resource.enabled','=',1)
    ->orderBy('created_at','desc');

        return $this->hasMany(EamResource::class,'wip_entity_id','wip_entity_id')
                ->where('eam_work_resource.enabled','=',1)
                ->where('eam_work_resource.completed','=',1);
    }


    //Module quotation std r/ reports
    
    static function clientsHasQuotesbyDate ($startDate )
    {    
        $from = date('Y-m-d'. ' 00:00:00', strtotime($startDate) );   
        
        $clients = DB::table('cliente as c')
                        ->join('as_cotizacion as ac', 'ac.Idcliente', '=', 'c.idcliente')
                        ->join('as_quotation_details as aqd', 'aqd.header_id', '=', 'ac.Idcotiza')
                        ->join('inv_item as ii', 'ii.inv_item_id', '=', 'aqd.item_id')
                        ->join('ubigeo_peru_districts as upd', 'upd.id', '=', 'ac.district_id')
                        ->where('allow_dispatch', '=', 'Y')
                        ->where('delivery_date', '=', $from )  
                        ->selectRaw('c.idcliente, c.full_name, c.telef2, c.telef1, ac.shipping_address, upd.name as district')
                        ->groupBy('c.idcliente')
                        ->get();
        return $clients;
    }

    static function clientsHasQuotes(){
        $clients = DB::table('cliente as c')
                        ->join('as_cotizacion as ac', 'ac.Idcliente', '=', 'c.idcliente')
                        ->join('as_quotation_details as aqd', 'aqd.header_id', '=', 'ac.Idcotiza')
                        ->join('inv_item as ii', 'ii.inv_item_id', '=', 'aqd.item_id')
                        ->join('ubigeo_peru_districts as upd', 'upd.id', '=', 'ac.district_id')
                        ->where('allow_dispatch', '=', 'Y')
                        ->selectRaw('c.idcliente, c.full_name, c.telef2, c.telef1, ac.shipping_address, upd.name as district')
                        ->groupBy('c.idcliente')
                        ->get();
        return $clients;
    }

    //Get all the orders by client
    static function scopeOrderByClient($idcliente){
        //Query Totales entrega
        $orders = DB::table('as_cotizacion as ac')
                    ->join('as_quotation_details as aqd', 'aqd.header_id', '=', 'ac.Idcotiza')
                    ->join('inv_item as ii', 'ii.inv_item_id', '=', 'aqd.item_id')
                    ->join('cliente as c', 'c.idcliente', '=', 'ac.Idcliente')
                    ->join('ubigeo_peru_districts as upd', 'upd.id', '=', 'ac.district_id')
                    ->where('allow_dispatch', '=', 'Y')
                    ->where('ac.Idcliente', '=', $idcliente)
                    ->selectRaw('ii.nombre, SUM(aqd.quantity) as quantity')
                    ->groupBy('ii.inv_item_id')
                    ->get();

        return $orders;
    }

     static function scopeOrderByClientbyDate($idcliente , $startDate  )
    {
         $from = date('Y-m-d'. ' 00:00:00', strtotime($startDate) );   
        
        //Query Totales entrega
        $orders = DB::table('as_cotizacion as ac')
                    ->join('as_quotation_details as aqd', 'aqd.header_id', '=', 'ac.Idcotiza')
                    ->join('inv_item as ii', 'ii.inv_item_id', '=', 'aqd.item_id')
                    ->join('cliente as c', 'c.idcliente', '=', 'ac.Idcliente')
                    ->join('ubigeo_peru_districts as upd', 'upd.id', '=', 'ac.district_id')
                    ->where('allow_dispatch', '=', 'Y')
                    ->where('ac.Idcliente', '=', $idcliente)
                    ->where('delivery_date', '=', $from )  
                    ->selectRaw('ii.nombre, SUM(aqd.quantity) as quantity')
                    ->groupBy('ii.inv_item_id')
                    ->get();

        return $orders;
    }

}

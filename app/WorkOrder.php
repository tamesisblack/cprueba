<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use DB;

class WorkOrder extends Model
{

    protected $table = "eam_work_orders";
    
    protected $primaryKey='wip_entity_id';

    public $timestamps=true;

    protected $fillable = 
    [ 
         'wip_entity_name', 'status_type', 'work_order_type', 'parent_wip_entity_name', 'receipt_id',
         'scheduled_start_date', 'cause_id','previous_meter','actual_meter',
         'object_id',  'owner_id', 'description','scheduled_completion_date', 'priority', 'work_order_type', 'failure_id','assignment_id','site_id',
         'rebuild_source','solution','failure_date','comments', 'last_updated_by', 'created_by','invoiced_flag'
    ];

      public function getDescuentoAttribute()      
      {
        return $this->hasOne(InterfaceDisccount::class, 'customer_trx_id','customer_trx_id')->sum('value_disscount');
       
      }
 


     public function ordenrecepcion()
    {
        return $this->hasOne(AsRecepcion::class,'id','receipt_id');
    }

    //////Total payment
      //Pago de OT
    public function total1Sum()
    {
        return $this->total2->SUM('total') + $this->total1->SUM('price') - $this->adelanto->SUM('amount') ;
        
    }

    public function total1Sumformato()
    {
        return number_format ($this->total2->SUM('total') + $this->total1->SUM('price') - $this->adelanto->SUM('amount') ,2);
        
    }


    public function getCMonedaAttribute()      
    {
    
        return $this->sucursal->currency_code;
     
    }

    public function getFMonedaAttribute()      
    {
    
        return $this->sucursal->currency->format_country;
     
    }

    //////total de descuento aplicado
    public function totalDsctoApplied()
    {
        return $this->hasOne(InterfaceDisccount::class,'wip_entity_id','wip_entity_id')
                    ->where('dcs_interface_apply_dscto.status','=','Pending');
                    //->where('eam_work_resource.enabled','=',1);
      
    }

    //PARA FACTURACION ELECTRONICA
        public function tptalIFV()
    {
        return $rset->total2->SUM('total') ;
    }  


    //FIN PARA FACTURACION ELECTRONICA

  
    public function sucursal()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }

    ////contar items SOLICITADOS ACTIVOS   
    public function contarItemActivo()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id')
				->where('eam_work_material.enabled','=',1)
				->whereIn('status_delivered',['UNDELIVERED','PARTIAL'])
				->select(DB::raw('wip_entity_id as cantidad'));
    }  

     public function cliente()
    {
        return $this->hasOne(Cliente::class,'idcliente','owner_id');
    }

//para traer descuento
         public function DsctoPendiente()
    {
        return $this->hasOne(InterfaceDisccount::class,'wip_entity_id','wip_entity_id') ;
    }
 
    public function asesor()
    {
        return $this->hasOne(Personal::class,'PERSON_ID','assignment_id');
    }


    public function getScheduledStartDateAttribute($date)
    {
        if($date != '0000-00-00'){
            return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
        }
        return '';
    }

    public function cotizacion()
    {
        return $this->hasOne(AsCotizacion::class,'Idcotiza','parent_wip_entity_name');
    }

    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class,'id','object_id');
    }

        public function setScheduledStartDateAttribute($date)
    {
        if($date == ''){
            $this->attributes['scheduled_start_date'] = \Carbon\Carbon::parse('0000-00-00')->format('Y-m-d');
        }else{
            $this->attributes['scheduled_start_date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
    }

    public function getScheduledCompletionDateAttribute($date)
    {
        if($date != '0000-00-00'){
            return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
        }
        return ''; 
    }

        public function setScheduledCompletionDateAttribute($date)
    {
        if($date == ''){
            $this->attributes['scheduled_completion_date'] = \Carbon\Carbon::parse('0000-00-00')->format('Y-m-d');
        }else{
            $this->attributes['scheduled_completion_date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
    }    

   

    public function getFailureDateAttribute($date)
    {
        if($date != '0000-00-00'){
            return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
        }
        return ''; 
    }

        public function setFailureDateAttribute($date)
    {
        if($date == ''){
            $this->attributes['failure_date'] = \Carbon\Carbon::parse('0000-00-00')->format('Y-m-d');
        }else{
            $this->attributes['failure_date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
    }   

	//////Lineas PENDIENTES por despachar
    public function lineas_pendiete_despacho()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id')->where('eam_work_material.enabled','=',1)->whereIn('status_delivered', ['PARTIAL','UNDELIVERED'])->select(DB::raw('eam_material_id as cant_desp'));
         
    }

    
    //para calculo de totales
    //TOTAL ADELANTO
    public function adelanto()
    {
        return $this->hasMany(CcPrepaymentOT::class,'wip_entity_id')->where('cc_prepayment_ot.status_type','=','Validado')->where('type','=','PREPAYMENT');
    }

    //TOTAL CREDITO
    public function credito()
    {
        return $this->hasMany(CcPrepaymentOT::class,'wip_entity_id')->where('cc_prepayment_ot.status_type','=','Validado')->where('type','=','CREDIT');
    }
    //TOTAL LIQUIDACION
    public function liquidacion()
    {
        return $this->hasMany(CcPrepaymentOT::class,'wip_entity_id')->where('cc_prepayment_ot.status_type','=','Validado')->where('type','=','PAYING');
    }

    //////total de recyrsos
    public function total1()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id')->where('eam_work_resource.completed','=',1)->where('eam_work_resource.enabled','=',1);
      
    }

    //////total de materiales DESPACHADOS     
    public function total2()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id')->where('eam_work_material.enabled','=',1)->select(DB::raw('eam_work_material.quantity_delivered *  eam_work_material.unit_price as total'));
    }

    //////total de materiales SOLICITADOS ACTIVOS   
    public function totalMatSolicitado()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id')->where('eam_work_material.enabled','=',1)->select(DB::raw('eam_work_material.quantity *  eam_work_material.unit_price as total'));
    }    

	//despacho de materiales
	public function materials()
    {
        return $this->hasMany(Material::class,'wip_entity_id');
    }

    public function despacholabor()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id')->where('eam_work_resource.enabled','=',1)->where('eam_work_resource.completed','=',1);
    }



    //********* F1 information foe reports ***************
    public function repuestos()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id','wip_entity_id');
    }
 
    public function repuestos_activos()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id','wip_entity_id')->where('eam_work_material.enabled','=',1)->orderBy('orden', 'asc');
    }

    /*Used by
        -Reporte Historial EECC
    */
    public function repuestos_activo_despachado()
    {
        return $this->hasMany(EamMaterial::class,'wip_entity_id','wip_entity_id')
                    ->where('eam_work_material.enabled','=',1)
                    ->where('eam_work_material.quantity_delivered','>',0);;
    }

    public function mano_obra()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id','wip_entity_id');
    }
 
     public function mano_obraActivo()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id','wip_entity_id')->where('eam_work_resource.enabled','=',1)->orderBy('orden', 'asc');
    }

         public function mano_obraActivo_completed()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id','wip_entity_id')
                ->where('eam_work_resource.enabled','=',1)
                ->where('eam_work_resource.completed','=',1);
    }

    //reporte OT - Datos Generales de OT
    public function causa()
    {
        return $this->hasOne(FndLookupValue::class,'idlvalue','cause_id');
    }
  

    public function prioridad()
    {
        return $this->hasOne(FndLookupValue::class,'idlvalue','priority');
    }

     public function falla()
    {
        return $this->hasOne(FndLookupValue::class,'idlvalue','failure_id');
    }

    public function permanencia()
    {

        if ($this->retirement_date != null) {

            $date = Carbon::now();
            $date2 = Carbon::parse($this->retirement_date);

            if($date->diffInDays($date) > 0) {
                return true;
            }
        }

        return true;
    }
 

        public function LaborAsignadas()
    {
        return $this->hasMany(EamResourceAssigment::class,'wip_entity_id')->where('eam_work_resource_assigment.enabled','=',1)->where('eam_work_resource_assigment.assigment_id','>',0);
    }


        public function LaborCompletada()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id')->where('eam_work_resource.enabled','=',1)->where('eam_work_resource.completed','=',1);
    }


    public function LaborPendienteCompletar()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id')->where('eam_work_resource.enabled','=',1)->where('eam_work_resource.completed','=',0);
    }

    // cantidad de labores
    public function laboresgeneral()
    {
        return $this->hasMany(EamResource::class,'wip_entity_id')->where('eam_work_resource.enabled','=',1);
    }

    public function laboresasignada()
    {
        return $this->hasMany(EamResourceAssigment::class,'wip_entity_id')->where('eam_work_resource_assigment.enabled','=',1);
    }

  
     public function attachedDocuments()
    {
      return $this->hasMany(FndAttachedDocuments::class, 'pk1_value');
    }

     public function asignaciones()
    {
        return $this->hasMany(EamWorkResourceAssigment::class,'wip_entity_id','wip_entity_id');
    }

    ////SCOPE FILTER WO

    public function scopeSearchLines($query, $date)
    {
        $placa=array_get($date, 'placa', false);
        $sucursal=array_get($date, 'sucursal', false);
        $numot=array_get($date, 'numot', false);
        //$numcotiz=array_get($date, 'numcotiz', false);
        $idcliente=array_get($date, 'idcliente', false);
        $asesor=array_get($date, 'PERSON_ID', false);

        return $query
            ->join('inv_sites', 'inv_sites.id', '=', 'eam_work_orders.site_id')
            ->join('cliente', 'cliente.idcliente', '=', 'eam_work_orders.owner_id')
            ->join('hr_per_people_inf', 'hr_per_people_inf.PERSON_ID', '=', 'eam_work_orders.assignment_id')
            ->leftjoin('vehiculo', 'vehiculo.id', '=', 'eam_work_orders.object_id')
            ->leftjoin('eam_work_resource as f', 'f.wip_entity_id', '=', 'eam_work_orders.wip_entity_id')
            ->leftjoin('eam_work_material as g', 'g.wip_entity_id', '=', 'eam_work_orders.wip_entity_id')
            ->when($placa, function ($query) use ($placa) {
                return $query->where('eam_work_orders.object_id', $placa);
            })
            ->when($numot, function ($query) use ($numot) {
                return $query->where('eam_work_orders.wip_entity_name', $numot);
            })
            ->when($sucursal, function ($query) use ($sucursal) {
                return $query->where('inv_sites.id', $sucursal);
            })
            ->when($idcliente, function ($query) use ($idcliente) {
                return $query->where('cliente.idcliente', $idcliente);
            })
            ->when($asesor, function ($query) use ($asesor) {
                return $query->where('hr_per_people_inf.PERSON_ID', $asesor);
            })
            ->select('eam_work_orders.wip_entity_id as id', 
                    'eam_work_orders.wip_entity_name as numero', 
                    'inv_sites.name as sucursal',
                    'cliente.full_name as cliente', 
                    'cliente.telef2 as telefono', 
                    'vehiculo.placa as placa', 
                    'hr_per_people_inf.FULL_NAME as asesor', 
                    'eam_work_orders.created_at as fec_creacion',
                     DB::raw('SUM(f.price) as tot_mo'),
                     DB::raw('SUM(g.unit_price * g.quantity) as tot_rep' )
                 )
            ; 
 
    }


    public function scopeSearch($query, $date)
    {
        $placa=array_get($date, 'placa', false);
        $sucursal=array_get($date, 'sucursal', false);
        $numot=array_get($date, 'numot', false);
        //$numcotiz=array_get($date, 'numcotiz', false);
        $idcliente=array_get($date, 'idcliente', false);
        $asesor=array_get($date, 'PERSON_ID', false);
        
        return $query
            ->join('inv_sites', 'inv_sites.id', '=', 'eam_work_orders.site_id')
            ->join('cliente', 'cliente.idcliente', '=', 'eam_work_orders.owner_id')
            ->join('hr_per_people_inf', 'hr_per_people_inf.PERSON_ID', '=', 'eam_work_orders.assignment_id')
            ->leftjoin('vehiculo', 'vehiculo.id', '=', 'eam_work_orders.object_id')
            ->leftjoin('eam_work_resource as f', 'f.wip_entity_id', '=', 'eam_work_orders.wip_entity_id')
            ->leftjoin('eam_work_material as g', 'g.wip_entity_id', '=', 'eam_work_orders.wip_entity_id')
            ->when($placa, function ($query) use ($placa) {
                return $query->where('eam_work_orders.object_id', $placa);
            })
            ->when($numot, function ($query) use ($numot) {
                return $query->where('eam_work_orders.wip_entity_name', $numot);
            })
            ->when($sucursal, function ($query) use ($sucursal) {
                return $query->where('inv_sites.id', $sucursal);
            })
            ->when($idcliente, function ($query) use ($idcliente) {
                return $query->where('cliente.idcliente', $idcliente);
            })
            ->when($asesor, function ($query) use ($asesor) {
                return $query->where('hr_per_people_inf.PERSON_ID', $asesor);
            })
            ->select('eam_work_orders.wip_entity_id as id', 
                    'eam_work_orders.wip_entity_name as numero', 
                    'inv_sites.name as sucursal',
                    'f.resource_name as servicio',
                    'g.item_descripcion as material',
                    'cliente.full_name as cliente', 
                    'cliente.telef2 as telefono', 
                    'vehiculo.placa as placa', 
                    'hr_per_people_inf.FULL_NAME as asesor', 
                    'eam_work_orders.created_at as fec_creacion',
                     DB::raw('SUM(f.price) as tot_mo'),
                     DB::raw('SUM(g.unit_price * g.quantity) as tot_rep' )
                 )
            ->groupBy('eam_work_orders.wip_entity_id');
 
    }

 
}
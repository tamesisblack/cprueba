<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Labor extends Model
{
    protected $table='labor';

    protected $primaryKey='idlabor';

    public $timestamps=true;

    protected $fillable =[
    	'nombrelabor',
    	'subtotal','cost_staff',
    	'duration', 'show_to_web',
        'apply_count', 'name_img',
        'equivalence',
        'category_work',
        'category_work_id',
        'frec_id','site_id',
    	'ivg',
    	'condicion',
        'has_promotion'
    ];

    public function detallelabor()
    {
        return $this->hasMany(Labormma::class,'idlabor','idlabor');
    } 

    public function frecuencia()
    {
        return $this->hasOne(OpePeriodos::class,'id','frec_id');
    } 


    public function sucursal()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }

    public function sucursalMain()
    {
        $ds_parameters = SiteParameters::where('is_main_site_id','Y')->first();
        $master_id = $ds_parameters->site_id;
        $sname = Site::where('id', $master_id);
        return  $sname;
    }


    public function tipCategoria()
    {
        return $this->hasOne(FndLookupValue::class,'idlvalue','category_work_id');
    }



}

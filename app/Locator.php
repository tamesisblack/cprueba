<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Locator extends Model
{
    protected $table='inv_item_locator';

    protected $primaryKey='location_id';

    public $timestamps=true;


    protected $fillable =[
    	'subinventory_id',
        'description',
        'concaneted_segments',
        'segment1',
        'segment2',
        'segment3',
        'segment4',
    	'enabled_flag',
        'last_updated_by',
        'created_by'

    ];

    protected $guarded =[

    ];


    public function subinventario()
    {
        return $this->hasOne(Warehouse::class,'id','subinventory_id');
    }






}

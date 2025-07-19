<?php

//namespace App;/

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = "hr_per_people_inf";
    
    protected $fillable = ['FIRST_NAME', 'SECOND_NAME', 'first_LAST_NAME', 'SECOND_LAST_NAME', 'FULL_NAME',
            'DATE_OF_BIRTH', 'SEX', 'idtipo_doc', 'allow_register_app', 'colour_hex_app',
			'EMPLOYEE_NUMBER', 'EFFECTIVE_START_DATE', 'EFFECTIVE_END_DATE', 'condicion','asesor',
        'idposition', 'EMAIL_ADDRESS', 'TELEF1', 'TELEF2', 'SALARY', 'SOLD_MIN', 'DISCCOUNT', 'COUNTRY', 'ADDRESS','asesor',
        'created_by', 'last_updated_by' ];

    protected $primaryKey = 'PERSON_ID';

//CODIGO PARA RELACIONAR CON LAS TABLAS

    //Dev: JY
    public function personal_works()
    {
        return $this->hasMany(PersonalWorks::class, 'PERSON_ID');
    }
    //****

    public function tipo_doc()
    {
        return $this->hasOne('App\Tipo_docs');
    }

    public function position()
    {
        return $this->hasOne('App\Position');
    }

    public function ventas()
    {
        return $this->hasMany('App\Per_ventas');
    }

    public function getAmountAttribute()
    {
        $amount = Per_ventas::where('personal_id', $this->id)->where('status', 'v')->sum('amount');
        if ($amount != null) {
            return $amount;
        }
        return 0;
    }

    public function getDATEOFBIRTHAttribute($date)
{
   return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
}

public function getEFFECTIVESTARTDATEAttribute($date)
{
   return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
}

public function getEFFECTIVEENDDATEAttribute($date)
{
   return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
}

public function setDATEOFBIRTHAttribute($date)
{
   $this->attributes['DATE_OF_BIRTH'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
}

public function setEFFECTIVESTARTDATEAttribute($date)
{
   $this->attributes['EFFECTIVE_START_DATE'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
}

public function setEFFECTIVEENDDATEAttribute($date)
{
   $this->attributes['EFFECTIVE_END_DATE'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
}


}

<?php

namespace sisVentas;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users';

    protected $primaryKey='id';
    
    protected $fillable = [
        'name', 'email', 'password','route_default','idposition','person_id','type','effective_end_date','created_by','last_updated_by'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userSite()
    {
        return $this->hasMany(UserSite::class,'IDUSUARIO','id');
    }

    
    public function persona()
    {
        return $this->hasOne(Personal::class,'PERSON_ID','person_id');
    }

    public function geteffectiveenddateAttribute($date)
	{
	   return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
	}


	public function seteffectiveenddateAttribute($date)
	{
	   $this->attributes['effective_end_date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
	}

    protected $appends = ['permisos_user'];

    public function getPermisosUserAttribute()
    {
        return UserPermisos::where('id_user',auth()->id())->first();
    }
}

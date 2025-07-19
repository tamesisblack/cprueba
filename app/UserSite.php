<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class UserSite extends Model
{
    protected $table = 'fnd_usersite';

    protected $primaryKey = 'IDUSERSITE';

    protected $fillable = ['IDUSUARIO', 'IDSITE', 'FEC_INI', 'FEC_FIN', 'ULTACTPOR', 'CREPOR',];


//RELACIONES
    public function usuario()
{
    return $this->belongsTo(User::class, 'IDUSUARIO');
}

    public function sucursal()
{
    return $this->belongsTo(Site::class, 'IDSITE');
}


}

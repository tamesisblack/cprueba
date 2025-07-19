<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    protected $table = 'fnd_login';

    public $fillable = ['IDUSUARIO', 'HRAINICIO', 'HRAFIN', 'IDTERMINAL', 'created_by'];

    public $primaryKey = 'IDLOGUEO';

 }

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos_usuarios';
    protected $primaryKey = 'perus_id';
    protected $fillable = ['perus_detalle'];
    public $timestamps = false;

    public function tipos()
    {
        return $this->hasMany(Tipo::class, 'perus_id', 'perus_id');
    }
}

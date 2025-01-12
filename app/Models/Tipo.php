<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos_usuarios';
    protected $primaryKey = 'tipus_id';
    protected $fillable = ['perus_id', 'tipus_detalles'];
    public $timestamps = false;

    public function permisos()
    {
        return $this->belongsTo(Permiso::class, 'perus_id', 'perus_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'tipus_id', 'tipus_id');
    }
}

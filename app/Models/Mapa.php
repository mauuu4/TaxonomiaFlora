<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    protected $table = 'tax_mapas';
    protected $primaryKey = 'mapa_id';
    protected $fillable = ['mapa_nombre', 'mapa_url'];

    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class, 'ubi_mapa_id', 'mapa_id');
    }
}

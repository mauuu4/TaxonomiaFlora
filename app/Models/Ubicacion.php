<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'tax_ubicaciones';
    protected $primaryKey = 'ubi_id';

    protected $fillable = [
        // 'ubi_mapa_id',
        'ubi_esp_id',        
        'ubi_longitud',
        'ubi_latitud',
        'ubi_region',
        'ubi_descripcion',
    ];

    public function especie()
    {
        return $this->belongsTo(Especie::class, 'ubi_esp_id', 'esp_id');
    }
}

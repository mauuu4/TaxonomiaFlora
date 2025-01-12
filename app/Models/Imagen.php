<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'tax_imagenes';
    protected $primaryKey = 'img_id';

    protected $fillable = [
        'img_ruta', 
        'img_descripcion', 
        'img_esp_id'];

    public function especie()
    {
        return $this->belongsTo(Especie::class, 'img_esp_id', 'esp_id');
    }
}

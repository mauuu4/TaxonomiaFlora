<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    protected $table = 'TAX_ESPECIES';
    protected $primaryKey = 'esp_id';

    protected $fillable = [
        'esp_gene_id',
        'esp_nombre_cientifico', 
        'esp_nombre_comun', 
        'esp_descripcion', 
    ];

    protected function espNombreCientifico(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return strtolower($value);
            },
            get: function ($value) {
                return ucfirst($value);
            }
        );
    }

    public function getRouteKeyName()
    {
        return 'esp_nombre_cientifico';
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'esp_gene_id', 'gene_id');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'img_esp_id', 'esp_id');
    }

    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class, 'ubi_esp_id', 'esp_id');
    }

    public function registros()
    {
        return $this->hasMany(Registro::class, 'esp_id', 'esp_id');
    }
}

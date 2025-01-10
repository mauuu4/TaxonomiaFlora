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

    protected $fillable = [
        'esp_gene_id',
        'esp_nombre_cientifico', 
        'esp_nombre_comun', 
        'esp_descripcion', 
    ];

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'esp_gene_id', 'gene_id');
    }

    //get route key name
    public function getRouteKeyName()
    {
        return 'esp_nombre_cientifico';
    }
}

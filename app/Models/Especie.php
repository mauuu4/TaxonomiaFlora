<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table = 'TAX_ESPECIES';
    protected $primaryKey = 'esp_id';

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
}

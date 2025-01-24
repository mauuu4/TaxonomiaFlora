<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'tax_generos';
    protected $primaryKey = 'gene_id';
    
    protected $fillable = ['gene_nombre', 'gene_fam_id'];

    public function setGeneNombreAttribute($value)
    {
        $this->attributes['gene_nombre'] = ucfirst($value);
    }

    public function getGeneNombreAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function familia()
    {
        return $this->belongsTo(Familia::class, 'gene_fam_id', 'fam_id');
    }

    public function especies()
    {
        return $this->hasMany(Especie::class, 'esp_gene_id', 'gene_id');
    }
}

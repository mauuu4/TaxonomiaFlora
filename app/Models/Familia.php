<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = 'tax_familias';
    protected $primaryKey = 'fam_id';

    protected $fillable = ['fam_nombre', 'fam_reino_id'];

    public function setFamNombreAttribute($value)
    {
        $this->attributes['fam_nombre'] = ucfirst($value);
    }

    public function getFamNombreAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function reino()
    {
        return $this->belongsTo(Reino::class, 'fam_reino_id', 'reino_id');
    }

    public function generos()
    {
        return $this->hasMany(Genero::class, 'gene_fam_id', 'fam_id');
    }
}

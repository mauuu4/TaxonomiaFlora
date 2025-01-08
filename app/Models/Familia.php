<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = 'TAX_FAMILIAS';
    protected $primaryKey = 'fam_id';

    protected $fillable = ['fam_nombre', 'fam_reino_id'];
    
    public function reino()
    {
        return $this->belongsTo(Reino::class, 'fam_reino_id', 'reino_id');
    }

    public function generos()
    {
        return $this->hasMany(Genero::class, 'gene_fam_id', 'fam_id');
    }
}

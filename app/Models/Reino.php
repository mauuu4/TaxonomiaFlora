<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reino extends Model
{
    protected $table = 'tax_reinos';
    protected $primaryKey = 'reino_id';

    protected $fillable = ['reino_nombre'];

    public function familias()
    {
        return $this->hasMany(Familia::class, 'fam_reino_id', 'reino_id');
    }
}

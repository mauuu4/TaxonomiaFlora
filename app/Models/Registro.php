<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'tax_registros';
    protected $primaryKey = 'regis_id';

    protected $fillable = [
        'esp_id', 
        'user_id',
        'regis_estado',
    ];

    public function especie()
    {
        return $this->belongsTo(Especie::class, 'esp_id', 'esp_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    public function validaciones()
    {
        return $this->hasMany(Validacion::class, 'valid_regis_id', 'regis_id');
    }
}

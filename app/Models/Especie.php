<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    protected $table = 'tax_especies';
    protected $primaryKey = 'esp_id';

    protected $fillable = [
        'esp_gene_id',
        'esp_nombre_cientifico', 
        'esp_nombre_comun', 
        'esp_descripcion', 
        'esp_estado_valid'
    ];

    public function setEspNombreCientificoAttribute($value)
    {
        $this->attributes['esp_nombre_cientifico'] = ucfirst(strtolower($value));       
    }
    
    public function getEspNombreCientificoAttribute($value)
    {
        return ucfirst($value);
    }
 
    public function setEspNombreComunAttribute($value)
    {
        $this->attributes['esp_nombre_comun'] = ucfirst(strtolower($value));
    }


    public function getEspNombreComunAttribute($value)
    {
        return ucfirst($value);
    }

    public function setEspDescripcionAttribute($value)
    {
        $this->attributes['esp_descripcion'] = ucfirst(strtolower($value));
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

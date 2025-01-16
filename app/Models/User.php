<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tipus_id',
        'user_nombre',
        'user_apellido',
        'user_email',
        'user_password',
        'user_telefono',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'user_password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_password' => 'hashed',
        ];
    }

    protected function userNombre(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return ucfirst($value);
        });
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function registros()
    {
        return $this->hasMany(Registro::class, 'user_id', 'user_id');
    }

    /**
     * Relación muchos a muchos con Role.
     */
    public function roles()
    {
        return $this->belongsTo(Tipo::class, 'tipus_id', 'tipus_id');
    }

    /**
     * Verificar si el usuario tiene un rol específico.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('tipus_detalles', $roleName)->exists();
    }
}

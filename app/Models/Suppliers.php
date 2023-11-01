<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $table = '';

    protected $fillable = [
        'nombre_compañia',
        'nombre_contacto',
        'titulo_contacto',
        'direccion',
        'cuidad',
        'region',
        'codigo_postal',
        'pais',
        'telefono'
    ];
    
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at', 'fax','pagina_principal'
    ];

    public function products(){
        return $this -> hasMany(Products::class);
    }
}

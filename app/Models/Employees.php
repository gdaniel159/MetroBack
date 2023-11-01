<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'nombre', 'apellido', 'titulo', 'titulo_de_cortesia',
        'fecha_nacimiento',
        'fecha_contrato',
        'direccion',
        'ciudad',
        'region',
        'codigo_postal',
        'pais',
        'telefono',
        'foto',
        'notas',
        'reportes'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'extension', 'foto_path'
    ];

    protected $primaryKey = 'id';

    public function employees_territories()
    {
        return $this->hasMany(Employees_territories::class);
    }
}

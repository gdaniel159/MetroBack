<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'nombre_compañia',
        'nombre_contacto',
        'titulo_contacto',
        'direccion',
        'cuidad',
        'region',
        'codigo_postal',
        'pais',
        'telefono',
        'fax',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at','fax'
    ];

    public function customers_customers_demo()
    {
        return $this->hasMany(Customer_Customer::class);
    }
}

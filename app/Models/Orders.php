<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'fecha_orden',
        'fecha_requirimiento',
        'fecha_envio',
        'vio_envia',
        'transporte',
        'nombre_envio',
        'envio_direccion',
        'envio_region',
        'envio_codigo_postal',
        'envio_pais',
        'customers_id',
        'employee_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $primaryKey = 'id';

    public function shippers()
    {
        return $this->hasMany(Shippers::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }

    public function employees()
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }
    public function orders_details()
    {
        return $this->hasMany(Orders_details::class);
    }
}

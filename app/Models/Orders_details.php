<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_details extends Model
{
    use HasFactory;

    protected $table = 'orders_details';

    protected $fillable = [
        'precio_unitario',
        'cantidad',
        'estado',
        'producto_id',
        'order_id'
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function products(){
        return $this -> belongsTo(Products::class,'products_id');
    }
    
    public function orders(){
        return $this -> belongsTo(Orders::class,'orders_id');
    }
}

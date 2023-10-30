<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaModel extends Model
{
    use HasFactory;

    protected $table = 'orders_details';

    protected $fillable = [
        'precio_unitario',
        'cantidad',
        'estado',
        'producto_id',
        'orders_id'
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function products(){
        return $this -> belongsTo(Modelo::class,'producto_id');
    }
    
    public function orders(){
        return $this -> belongsTo(OrdersModel::class,'orders_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nombre_producto',
        'cantidad_unidad',
        'nombre_categoria',
        'precio_unidad',
        'unidades_stock',
        'unidades_orden',
        'reorden_nivel',
        'estado',

        'categoria_id',
        'supplier_id',
    ];
    

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function categories(){
        return $this -> belongsTo(CategoriesModel::class,'categoria_id');
    }
    
    public function suppliers(){
        return $this -> belongsTo(SuppliersModel::class,'supplier_id');
    }

    public function order_details(){
        return $this ->hasMany(Orders_detailsModel::class);
    }
}
